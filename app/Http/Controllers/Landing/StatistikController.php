<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        // 1. Total laporan
        $totalLaporan = Laporan::count();

        // 2. Tipe pelapor
        $tipePelapor = Laporan::select('tipe_pelapor')
            ->selectRaw('COUNT(*) as jumlah')
            ->whereNotNull('tipe_pelapor')
            ->where('tipe_pelapor', '!=', '')
            ->groupBy('tipe_pelapor')
            ->orderByDesc('jumlah')
            ->get();

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

        // 5. Anonim vs Terbuka
        $anonimCount = Laporan::where('is_anonymous', 'y')->count();
        $anonimData = [
            'anonim'  => $anonimCount,
            'terbuka' => max(0, $totalLaporan - $anonimCount),
        ];

        return view('landing.statistik', compact(
            'totalLaporan',
            'tipePelapor',
            'bulanData',
            'laporanPerKategori',
            'anonimData'
        ));
    }
}
