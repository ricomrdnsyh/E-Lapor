<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AdminHistoryLaporanController extends Controller
{
    public function index()
    {
        return view('admin.history-laporan.index');
    }

    public function getHistoryLaporan()
    {
        $query = HistoryLaporan::with(['laporan.kategori', 'user.unit'])
            ->select(['id_history', 'laporan_id', 'user_id', 'status', 'catatan', 'created_at'])
            ->orderByDesc('id_history');

        return DataTables::of($query)
            ->addColumn('kode_tiket', function ($row) {
                return $row->laporan?->kode_tiket ?? '-';
            })
            ->addColumn('judul_laporan', function ($row) {
                return $row->laporan?->judul_laporan ?? '-';
            })
            ->addColumn('kategori', function ($row) {
                return $row->laporan?->kategori?->nama_kategori ?? '-';
            })
            ->addColumn('nama_pelapor', function ($row) {
                return $row->laporan?->nama_pelapor ?: '-';
            })
            ->addColumn('unit_penangan', function ($row) {
                return $row->user?->unit?->nama_unit ?? $row->user?->nama ?? '-';
            })
            ->editColumn('status', function ($row) {
                return match ($row->status) {
                    'menunggu' => '<span class="badge text-white bg-warning">Menunggu</span>',
                    'diproses' => '<span class="badge text-white bg-info">Diproses</span>',
                    'selesai' => '<span class="badge text-white bg-success">Selesai</span>',
                    'ditolak' => '<span class="badge text-white bg-danger">Ditolak</span>',
                    default => '<span class="badge text-white bg-secondary">Tidak Diketahui</span>',
                };
            })
            ->editColumn('catatan', function ($row) {
                return $row->catatan ? Str::limit($row->catatan, 80) : '-';
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_history . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_history . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . '</div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $history = HistoryLaporan::with(['laporan.kategori.unit', 'user.unit'])->findOrFail($id);

        return response()->json([
            'history' => $history,
            'created_at_formatted' => $history->created_at
                ? $history->created_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('DD MMMM YYYY, HH:mm')
                : '-',
            'updated_at_formatted' => $history->updated_at
                ? $history->updated_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('DD MMMM YYYY, HH:mm')
                : '-',
        ]);
    }

    public function edit(string $id)
    {
        $history = HistoryLaporan::with(['laporan.kategori.unit', 'user.unit'])->findOrFail($id);

        return response()->json([
            'history' => $history,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan' => 'nullable|string|max:2000',
        ], [
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
            'catatan.max' => 'Catatan maksimal 2000 karakter',
        ]);

        $history = HistoryLaporan::findOrFail($id);
        $history->update([
            'status' => $request->status,
            'catatan' => $request->filled('catatan') ? $request->catatan : null,
        ]);

        $history->laporan()->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.history-laporan.index')->with('success', 'History laporan berhasil diperbarui.');
    }
}
