<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanSsoTracking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminLaporanSsoTrackingController extends Controller
{
    public function index()
    {
        return view('admin.laporan-sso-tracking.index');
    }

    public function getData(Request $request)
    {
        $query = LaporanSsoTracking::with('laporan')
            ->select('laporan_sso_trackings.*')
            ->orderByDesc('id');

        return DataTables::of($query)
            ->addColumn('kode_tiket', function ($row) {
                return $row->laporan->kode_tiket ?? '-';
            })
            ->addColumn('judul_laporan', function ($row) {
                return $row->laporan->judul_laporan ?? '-';
            })
            ->addColumn('status_laporan', function ($row) {
                if (!$row->laporan) return '-';
                
                return match ($row->laporan->status) {
                    'menunggu'  => '<span class="badge text-white bg-warning">Menunggu</span>',
                    'diproses'  => '<span class="badge text-white bg-info">Diproses</span>',
                    'selesai'   => '<span class="badge text-white bg-success">Selesai</span>',
                    'ditolak'   => '<span class="badge text-white bg-danger">Ditolak</span>',
                    default     => '<span class="badge text-white bg-secondary">Tidak Diketahui</span>'
                };
            })
            ->editColumn('created_at', function ($row) {
                if ($row->created_at) {
                    $date = $row->created_at->setTimezone('Asia/Jakarta')->locale('id');
                    return $date->translatedFormat('d F Y, H:i:s');
                }
                return '-';
            })
            ->filterColumn('kode_tiket', function($query, $keyword) {
                $query->whereHas('laporan', function($q) use ($keyword) {
                    $q->where('kode_tiket', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('judul_laporan', function($query, $keyword) {
                $query->whereHas('laporan', function($q) use ($keyword) {
                    $q->where('judul_laporan', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['status_laporan'])
            ->make(true);
    }
}
