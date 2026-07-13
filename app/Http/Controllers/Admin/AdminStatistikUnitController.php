<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Unit;
use App\Models\Laporan;
use Illuminate\Http\Request;

class AdminStatistikUnitController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::select('nama_kategori')->distinct()->orderBy('nama_kategori')->get();
        return view('admin.statistik_unit.index', compact('kategoris'));
    }

    public function getData(Request $request)
    {
        $namaKategori = $request->input('nama_kategori');

        if (!$namaKategori) {
            return response()->json([
                'labels' => [],
                'values' => [],
                'tableData' => []
            ]);
        }

        // Ambil unit aktif yang HANYA memiliki kategori tersebut
        $units = Unit::where('status', 'aktif')
            ->whereHas('kategoris', function ($q) use ($namaKategori) {
                $q->where('nama_kategori', $namaKategori);
            })
            ->orderBy('nama_unit')
            ->get();

        $labels = [];
        $values = [];
        $tableData = [];

        foreach ($units as $unit) {
            // Hitung jumlah laporan untuk unit ini dan nama kategori yang dipilih
            $jumlahLaporan = Laporan::whereHas('kategori', function ($q) use ($namaKategori) {
                    $q->where('nama_kategori', $namaKategori);
                })
                ->whereHas('units', function ($q) use ($unit) {
                    $q->where('unit.id_unit', $unit->id_unit);
                })
                ->count();

            $labels[] = $unit->singkatan ?: $unit->nama_unit;
            $values[] = $jumlahLaporan;
            $tableData[] = [
                'nama_unit' => $unit->nama_unit,
                'singkatan' => $unit->singkatan,
                'total'     => $jumlahLaporan
            ];
        }

        // Ambil data laporan per sub kategori
        $subKategoris = SubKategori::whereHas('kategori', function($q) use ($namaKategori) {
            $q->where('nama_kategori', $namaKategori);
        })->select('nama_sub')->distinct()->orderBy('nama_sub')->get();

        $subLabels = [];
        $subValues = [];

        foreach ($subKategoris as $sub) {
            $jumlahSub = Laporan::whereHas('kategori', function ($q) use ($namaKategori) {
                    $q->where('nama_kategori', $namaKategori);
                })
                ->whereHas('subKategori', function ($q) use ($sub) {
                    $q->where('nama_sub', $sub->nama_sub);
                })
                ->count();
                
            $subLabels[] = $sub->nama_sub;
            $subValues[] = $jumlahSub;
        }

        return response()->json([
            'labels' => $labels,
            'values' => $values,
            'tableData' => $tableData,
            'subLabels' => $subLabels,
            'subValues' => $subValues
        ]);
    }
}
