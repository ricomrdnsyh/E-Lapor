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
        $kategoriId = $request->input('kategori_id');

        if (!$unitId) {
            return response()->json([
                'kategoriLabels' => [],
                'kategoriValues' => [],
                'kategoriList'   => [],
                'subLabels'      => [],
                'subValues'      => []
            ]);
        }

        $unitKategoriIds = Kategori::where('unit_id', $unitId)
            ->pluck('id_kategori')
            ->toArray();

        $scopeKategoriIds = $unitKategoriIds;

        $baseQuery = Laporan::where(function ($q) use ($unitId) {
            if ($unitId) {
                $q->whereHas('units', function ($q2) use ($unitId) {
                    $q2->where('unit_id', $unitId);
                });
            } else {
                $q->whereRaw('0=1');
            }
        });

        $kategoriCountsRaw = (clone $baseQuery)
            ->selectRaw('kategori_id, count(*) as total')
            ->whereNotNull('kategori_id')
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        $allKategoriIds = $scopeKategoriIds;

        $kategoriData = collect();
        if (!empty($allKategoriIds)) {
            $kategoriData = Kategori::whereIn('id_kategori', $allKategoriIds)
                ->get()
                ->map(function ($kat) use ($kategoriCountsRaw) {
                    return ['id' => $kat->id_kategori, 'nama' => $kat->nama_kategori, 'total' => (int) ($kategoriCountsRaw[$kat->id_kategori] ?? 0)];
                })
                ->groupBy('nama')
                ->map(function ($items) {
                    return ['id' => $items->first()['id'], 'nama' => $items->first()['nama'], 'total' => $items->sum('total')];
                })
                ->sortByDesc('total')
                ->values();
        }

        $subKategoriBaseQuery = clone $baseQuery;
        if ($kategoriId) {
            $subKategoriBaseQuery->where('kategori_id', $kategoriId);
        }

        $subKategoriCountsRaw = (clone $subKategoriBaseQuery)
            ->selectRaw('sub_kategori_id, count(*) as total')
            ->whereNotNull('sub_kategori_id')
            ->groupBy('sub_kategori_id')
            ->pluck('total', 'sub_kategori_id');

        $subKategoriQuery = SubKategori::whereIn('kategori_id', $scopeKategoriIds)
            ->orWhere('unit_id', $unitId);
            
        if ($kategoriId) {
            $subKategoriQuery = SubKategori::where('kategori_id', $kategoriId);
        }

        $subKategoriData = $subKategoriQuery
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
            'kategoriList'   => $kategoriData->map(function($item) { return ['id' => $item['id'], 'nama' => $item['nama']]; }),
            'subLabels'      => $subKategoriData->pluck('nama'),
            'subValues'      => $subKategoriData->pluck('total'),
        ]);
    }
}
