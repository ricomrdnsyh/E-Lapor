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
        $totalLaporan = Laporan::count();

        $laporanPerKategoriRaw = Kategori::select('kategori.id_kategori', 'kategori.nama_kategori')
            ->leftJoin('laporan', 'laporan.kategori_id', '=', 'kategori.id_kategori')
            ->groupBy('kategori.id_kategori', 'kategori.nama_kategori')
            ->selectRaw('COUNT(laporan.id_laporan) as jumlah_laporan')
            ->orderByDesc('jumlah_laporan')
            ->get();

        $akademikTotal = 0;
        $laporanPerKategori = collect();

        foreach ($laporanPerKategoriRaw as $kategori) {
            if (stripos($kategori->nama_kategori, 'Akademik') !== false) {
                $akademikTotal += $kategori->jumlah_laporan;
            } else {
                $laporanPerKategori->push($kategori);
            }
        }

        if ($akademikTotal > 0 || $laporanPerKategoriRaw->contains(fn($k) => stripos($k->nama_kategori, 'Akademik') !== false)) {
            $laporanPerKategori->prepend((object) [
                'nama_kategori'  => 'Akademik',
                'jumlah_laporan' => $akademikTotal,
            ]);
        }

        $laporanPerKategori = $laporanPerKategori->sortByDesc('jumlah_laporan')->values();

        return view('landing.beranda', compact('totalLaporan', 'laporanPerKategori'));
    }
}
