<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function beranda(Request $request)
    {
        $baseQuery = Laporan::query();
        $totalLaporan = (clone $baseQuery)->count();

        $stats = [
            'total'    => $totalLaporan,
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'diproses' => (clone $baseQuery)->where('status', 'diproses')->count(),
            'selesai'  => (clone $baseQuery)->where('status', 'selesai')->count(),
            'ditolak'  => (clone $baseQuery)->where('status', 'ditolak')->count(),
        ];

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

        $kategoris = Kategori::with('unit')->get();
        $kategoriAkademik = $kategoris->filter(fn($k) => $k->unit && (
            stripos($k->unit->nama_unit, 'Fakultas') !== false ||
            stripos($k->unit->nama_unit, 'Pascasarjana') !== false
        ));
        $kategoriNonAkademik = $kategoris->filter(fn($k) => !$k->unit || (
            stripos($k->unit->nama_unit, 'Fakultas') === false &&
            stripos($k->unit->nama_unit, 'Pascasarjana') === false
        ));
        $kategoriAkademikUnik = $kategoriAkademik->unique('nama_kategori')->values();
        $unitAkademik = $kategoriAkademik->pluck('unit')->unique('id_unit')->sortBy('id_unit');

        return view('landing.beranda', compact('totalLaporan', 'laporanPerKategori', 'stats', 'kategoriAkademik', 'kategoriNonAkademik', 'kategoriAkademikUnik', 'unitAkademik'));
    }
}
