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
        $units = Unit::where('status', 'aktif')->orderBy('nama_unit')->get();
        $kategoris = Kategori::select('nama_kategori')->distinct()->get()->sortBy('nama_kategori', SORT_NATURAL | SORT_FLAG_CASE);
        return view('admin.statistik_unit.index', compact('units', 'kategoris'));
    }

    public function getData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $hasDates = $startDate && $endDate;
        $baseQuery = Laporan::query();

        if ($hasDates) {
            $baseQuery->whereDate('created_at', '>=', $startDate)
                      ->whereDate('created_at', '<=', $endDate);
        }

        if (!$hasDates) {
            $summary = ['total' => 0, 'menunggu' => 0, 'proses' => 0, 'selesai' => 0, 'ditolak' => 0];
            $labels = [];
            $values = [];
            $tableData = [];
        } else {

            $kategoriId = $request->input('kategori_id');
            $unitChartQuery = clone $baseQuery;

            $unitsQuery = Unit::where('status', 'aktif')->orderBy('nama_unit');

            if ($kategoriId && $kategoriId !== 'all') {
                // Filter laporannya
                $unitChartQuery->whereHas('kategori', function($q) use ($kategoriId) {
                    $q->where('nama_kategori', $kategoriId);
                });
                
                // Filter unit yang ditampilkan (hanya unit yang memiliki kategori ini)
                $unitsQuery->whereHas('kategoris', function($q) use ($kategoriId) {
                    $q->where('nama_kategori', $kategoriId);
                });
            }

            $units = $unitsQuery->get();

            $labels = [];
            $values = [];
            $tableData = [];

            foreach ($units as $unit) {
                // Query untuk grafik unit (terpengaruh filter kategori)
                $unitQueryForChart = (clone $unitChartQuery)->whereHas('units', function ($q) use ($unit) {
                    $q->where('unit.id_unit', $unit->id_unit);
                });
                $countChart = $unitQueryForChart->count();
                
                $labels[] = $unit->singkatan ?: $unit->nama_unit;
                $values[] = $countChart;

                // Query untuk tabel (tidak terpengaruh filter kategori, hanya tanggal)
                $unitQuery = (clone $baseQuery)->whereHas('units', function ($q) use ($unit) {
                    $q->where('unit.id_unit', $unit->id_unit);
                });

                $jumlahLaporan = $unitQuery->count();
                
                $tableData[] = [
                    'nama_unit' => $unit->nama_unit,
                    'singkatan' => $unit->singkatan,
                    'total'     => $jumlahLaporan,
                    'menunggu'  => (clone $unitQuery)->where('status', 'menunggu')->count(),
                    'proses'    => (clone $unitQuery)->whereIn('status', ['diproses', 'proses'])->count(),
                    'selesai'   => (clone $unitQuery)->where('status', 'selesai')->count(),
                    'ditolak'   => (clone $unitQuery)->where('status', 'ditolak')->count(),
                ];
            }
        }

        $unitId = $request->input('unit_id');

        $kategoriListQuery = Kategori::select('nama_kategori')->distinct();
        if ($unitId && $unitId !== 'all') {
            $kategoriListQuery->where('unit_id', $unitId);
        }
        $kategoris = $kategoriListQuery->get()->sortBy('nama_kategori', SORT_NATURAL | SORT_FLAG_CASE);
        $katLabels = [];
        $katValues = [];
        
        $kategoriQuery = clone $baseQuery;
        if ($unitId && $unitId !== 'all') {
            $kategoriQuery->whereHas('units', function ($q) use ($unitId) {
                $q->where('unit.id_unit', $unitId);
            });
        }

        foreach ($kategoris as $kat) {
            $katLabels[] = $kat->nama_kategori;
            $katValues[] = (clone $kategoriQuery)->whereHas('kategori', function ($q) use ($kat) {
                $q->where('nama_kategori', $kat->nama_kategori);
            })->count();
        }

        return response()->json([
            'labels' => $labels,
            'values' => $values,
            'tableData' => $tableData,
            'katLabels' => $katLabels,
            'katValues' => $katValues,
        ]);
    }

    public function getKategoriData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $unitId = $request->input('unit_id');

        $baseQuery = Laporan::query();
        if ($startDate && $endDate) {
            $baseQuery->whereDate('created_at', '>=', $startDate)
                      ->whereDate('created_at', '<=', $endDate);
        }

        if ($unitId && $unitId !== 'all') {
            $baseQuery->whereHas('units', function ($q) use ($unitId) {
                $q->where('unit.id_unit', $unitId);
            });
        }

        $kategoriListQuery = Kategori::select('nama_kategori')->distinct();
        if ($unitId && $unitId !== 'all') {
            $kategoriListQuery->where('unit_id', $unitId);
        }
        $kategoris = $kategoriListQuery->get()->sortBy('nama_kategori', SORT_NATURAL | SORT_FLAG_CASE);
        $katLabels = [];
        $katValues = [];
        
        foreach ($kategoris as $kat) {
            $katLabels[] = $kat->nama_kategori;
            $katValues[] = (clone $baseQuery)->whereHas('kategori', function ($q) use ($kat) {
                $q->where('nama_kategori', $kat->nama_kategori);
            })->count();
        }

        return response()->json([
            'katLabels' => $katLabels,
            'katValues' => $katValues,
        ]);
    }

    public function getUnitData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $kategoriId = $request->input('kategori_id');

        $baseQuery = Laporan::query();
        if ($startDate && $endDate) {
            $baseQuery->whereDate('created_at', '>=', $startDate)
                      ->whereDate('created_at', '<=', $endDate);
        }

        if ($kategoriId && $kategoriId !== 'all') {
            $baseQuery->whereHas('kategori', function($q) use ($kategoriId) {
                $q->where('nama_kategori', $kategoriId);
            });
        }

        $unitsQuery = Unit::where('status', 'aktif')->orderBy('nama_unit');
        if ($kategoriId && $kategoriId !== 'all') {
            $unitsQuery->whereHas('kategoris', function($q) use ($kategoriId) {
                $q->where('nama_kategori', $kategoriId);
            });
        }
        $units = $unitsQuery->get();
        $labels = [];
        $values = [];

        foreach ($units as $unit) {
            $jumlahUnit = (clone $baseQuery)->whereHas('units', function ($q) use ($unit) {
                $q->where('unit.id_unit', $unit->id_unit);
            })->count();
                
            $labels[] = $unit->singkatan ?: $unit->nama_unit;
            $values[] = $jumlahUnit;
        }

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
