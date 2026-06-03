<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Unit;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        $units = Unit::where('status', 'aktif')->has('kategoris')->orderBy('nama_unit')->get();
        $globalData = $this->globalStats();

        return view('landing.statistik', array_merge($globalData, compact('units')));
    }

    private function globalStats()
    {
        $totalLaporan = Laporan::count();

        $fixedTipes = ['Dosen', 'Mahasiswa', 'Tenaga Pendidik', 'Masyarakat/Umum'];
        $tipePelaporRaw = Laporan::select('tipe_pelapor')
            ->selectRaw('COUNT(*) as jumlah')
            ->whereIn('tipe_pelapor', $fixedTipes)
            ->groupBy('tipe_pelapor')
            ->get()
            ->keyBy('tipe_pelapor');

        $tipePelapor = collect($fixedTipes)->map(function ($tipe) use ($tipePelaporRaw) {
            return (object) [
                'tipe_pelapor' => $tipe,
                'jumlah'       => $tipePelaporRaw->get($tipe)?->jumlah ?? 0,
            ];
        });

        $trenBulanan = Laporan::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanData = [];
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i)->format('Y-m');
            $found = $trenBulanan->firstWhere('bulan', $bulan);
            $bulanData[] = [
                'bulan' => Carbon::now()->subMonths($i)->translatedFormat('M Y'),
                'jumlah' => $found ? $found->jumlah : 0,
            ];
        }

        $laporanPerKategori = Kategori::select('kategori.nama_kategori')
            ->leftJoin('laporan', 'laporan.kategori_id', '=', 'kategori.id_kategori')
            ->groupBy('kategori.id_kategori', 'kategori.nama_kategori')
            ->selectRaw('COUNT(laporan.id_laporan) as jumlah_laporan')
            ->orderByDesc('jumlah_laporan')
            ->get();

        $anonimCount = Laporan::where('is_anonymous', 'y')->count();
        $anonimData = [
            'rahasia' => max(0, $totalLaporan - $anonimCount),
            'anonim'  => $anonimCount,
        ];

        return compact('totalLaporan', 'tipePelapor', 'bulanData', 'laporanPerKategori', 'anonimData');
    }

    public function getData(Request $request)
    {
        $unitId = $request->input('unit_id');

        if (!$unitId) {
            return response()->json([
                'kategoriLabels' => [],
                'kategoriValues' => [],
                'subLabels'      => [],
                'subValues'      => []
            ]);
        }

        $unitKategoriIds = Kategori::where('unit_id', $unitId)
            ->pluck('id_kategori')
            ->toArray();

        $userKategoriIds = DB::table('kategori_user')
            ->join('users', 'kategori_user.user_id', '=', 'users.id')
            ->where('users.unit_id', $unitId)
            ->pluck('kategori_user.kategori_id')
            ->toArray();

        $scopeKategoriIds = array_unique(array_merge($unitKategoriIds, $userKategoriIds));

        $baseQuery = Laporan::where(function ($q) use ($unitId, $scopeKategoriIds) {
            $hasFilter = false;

            if ($unitId) {
                $hasFilter = true;
                $q->whereHas('units', function ($q2) use ($unitId) {
                    $q2->where('unit_id', $unitId);
                });
            }

            if (!empty($scopeKategoriIds)) {
                $hasFilter = true;
                $q->orWhereIn('kategori_id', $scopeKategoriIds);
            }

            if (!$hasFilter) {
                $q->whereRaw('0=1');
            }
        });

        $kategoriCountsRaw = (clone $baseQuery)
            ->selectRaw('kategori_id, count(*) as total')
            ->whereNotNull('kategori_id')
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        $allKategoriIds = array_unique(array_merge(
            $scopeKategoriIds,
            array_keys($kategoriCountsRaw->toArray())
        ));

        $kategoriData = collect();
        if (!empty($allKategoriIds)) {
            $kategoriData = Kategori::whereIn('id_kategori', $allKategoriIds)
                ->get()
                ->map(function ($kat) use ($kategoriCountsRaw) {
                    return ['nama' => $kat->nama_kategori, 'total' => (int) ($kategoriCountsRaw[$kat->id_kategori] ?? 0)];
                })
                ->groupBy('nama')
                ->map(function ($items) {
                    return ['nama' => $items->first()['nama'], 'total' => $items->sum('total')];
                })
                ->sortByDesc('total')
                ->values();
        }

        $subKategoriCountsRaw = (clone $baseQuery)
            ->selectRaw('sub_kategori_id, count(*) as total')
            ->whereNotNull('sub_kategori_id')
            ->groupBy('sub_kategori_id')
            ->pluck('total', 'sub_kategori_id');

        $subKategoriData = SubKategori::whereIn('kategori_id', $scopeKategoriIds)
            ->orWhere('unit_id', $unitId)
            ->get()
            ->map(function ($sub) use ($subKategoriCountsRaw) {
                return ['nama' => $sub->nama_sub, 'total' => (int) ($subKategoriCountsRaw[$sub->id_sub] ?? 0)];
            })
            ->groupBy('nama')
            ->map(function ($items) {
                return ['nama' => $items->first()['nama'], 'total' => $items->sum('total')];
            })
            ->sortByDesc('total')
            ->values();

        return response()->json([
            'kategoriLabels' => $kategoriData->pluck('nama'),
            'kategoriValues' => $kategoriData->pluck('total'),
            'subLabels'      => $subKategoriData->pluck('nama'),
            'subValues'      => $subKategoriData->pluck('total'),
        ]);
    }
}
