<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori()
    {
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

        return view('landing.kategori', compact('kategoriAkademik', 'kategoriNonAkademik', 'kategoriAkademikUnik', 'unitAkademik'));
    }
}
