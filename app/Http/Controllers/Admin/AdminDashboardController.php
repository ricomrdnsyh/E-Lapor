<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Unit;
use App\Models\User;
use App\Models\Kategori;
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
        $fixedTipes = ['Dosen', 'Mahasiswa', 'Tenaga Pendidik', 'Lainnya'];
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

        return view('admin.dashboard.index', compact(
            'stats', 'meta', 'user', 'tipePelapor', 'bulanData', 'laporanPerKategori', 'anonimData', 'totalLaporan'
        ));
    }
}
