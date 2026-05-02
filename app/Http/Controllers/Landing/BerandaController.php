<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function beranda(Request $request)
    {
        // Total laporan
        $totalLaporan = Laporan::count();

        // Laporan per kategori
        $laporanPerKategori = Kategori::select('kategori.id_kategori', 'kategori.nama_kategori')
            ->leftJoin('laporan', 'laporan.kategori_id', '=', 'kategori.id_kategori')
            ->groupBy('kategori.id_kategori', 'kategori.nama_kategori')
            ->selectRaw('COUNT(laporan.id_laporan) as jumlah_laporan')
            ->orderByDesc('jumlah_laporan')
            ->get();

        return view('landing.beranda', compact('totalLaporan', 'laporanPerKategori'));
    }
}
