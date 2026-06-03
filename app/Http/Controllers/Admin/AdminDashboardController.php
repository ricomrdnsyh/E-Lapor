<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Unit;
use App\Models\User;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $baseQuery = Laporan::query();

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'diproses' => (clone $baseQuery)->where('status', 'diproses')->count(),
            'selesai' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'ditolak' => (clone $baseQuery)->where('status', 'ditolak')->count(),
        ];

        $meta = [
            'total_unit' => Unit::count(),
            'total_user' => User::count(),
        ];

        // 2. Tipe pelapor (4 kategori tetap)
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

        // 3. Tren bulanan (12 bulan terakhir)
        $trenBulanan = Laporan::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Fill missing months
        $bulanData = [];
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i)->format('Y-m');
            $found = $trenBulanan->firstWhere('bulan', $bulan);
            $bulanData[] = [
                'bulan' => Carbon::now()->subMonths($i)->translatedFormat('M Y'),
                'jumlah' => $found ? $found->jumlah : 0,
            ];
        }

        // 4. Laporan per kategori
        $laporanPerKategori = Kategori::select('kategori.nama_kategori')
            ->leftJoin('laporan', 'laporan.kategori_id', '=', 'kategori.id_kategori')
            ->groupBy('kategori.id_kategori', 'kategori.nama_kategori')
            ->selectRaw('COUNT(laporan.id_laporan) as jumlah_laporan')
            ->orderByDesc('jumlah_laporan')
            ->get();

        // 5. Rahasia vs Anonim
        $totalLaporan = Laporan::count();
        $anonimCount = Laporan::where('is_anonymous', 'y')->count();
        $anonimData = [
            'rahasia' => max(0, $totalLaporan - $anonimCount),
            'anonim'  => $anonimCount,
        ];

        $units = Unit::where('status', 'aktif')->has('kategoris')->orderBy('nama_unit')->get();

        return view('admin.dashboard.index', compact(
            'stats', 'meta', 'user', 'tipePelapor', 'bulanData', 'laporanPerKategori', 'anonimData', 'totalLaporan', 'units'
        ));
    }

    public function getUnitChartData(Request $request)
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

        // Scope kategori: milik unit + ditetapkan ke user unit tersebut (sama seperti UnitDashboardController::scopeKategoriIds)
        $unitKategoriIds = Kategori::where('unit_id', $unitId)
            ->pluck('id_kategori')
            ->toArray();

        $userKategoriIds = DB::table('kategori_user')
            ->join('users', 'kategori_user.user_id', '=', 'users.id')
            ->where('users.unit_id', $unitId)
            ->pluck('kategori_user.kategori_id')
            ->toArray();

        $scopeKategoriIds = array_unique(array_merge($unitKategoriIds, $userKategoriIds));

        // Base query — sama persis dengan UnitDashboardController::laporanUnitQuery()
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

        // Kategori — sama persis dengan logika UnitDashboardController
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

        // Sub Kategori — sama persis dengan logika UnitDashboardController
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
