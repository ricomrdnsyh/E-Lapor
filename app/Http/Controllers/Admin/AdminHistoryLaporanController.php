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
            ->select([
                'id_history',
                'laporan_id',
                'user_id',
                'status_sebelumnya',
                'status_baru',
                'lampiran_file',
                'catatan',
                'created_at'
            ])
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
                return $row->user?->nama ?? '-';
            })
            ->editColumn('status_sebelumnya', function ($row) {
                return $this->formatStatusBadge($row->status_sebelumnya);
            })
            ->editColumn('status_baru', function ($row) {
                return $this->formatStatusBadge($row->status_baru);
            })
            ->editColumn('lampiran_file', function ($row) {
                if (!$row->lampiran_file) {
                    return '-';
                }

                return '<a href="' . asset('uploads/history-laporan/' . $row->lampiran_file) . '" target="_blank" class="btn btn-sm btn-light-primary">Lihat File</a>';
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
            ->rawColumns(['status_sebelumnya', 'status_baru', 'lampiran_file', 'action'])
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
            'status_baru' => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan' => 'nullable|string|max:2000',
            'lampiran_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
        ], [
            'status_baru.required' => 'Status harus dipilih',
            'status_baru.in' => 'Status tidak valid',
            'catatan.max' => 'Catatan maksimal 2000 karakter',
            'lampiran_file.mimes' => 'Lampiran harus berupa jpg, jpeg, png, pdf, doc, docx, xls, atau xlsx',
            'lampiran_file.max' => 'Ukuran lampiran maksimal 5 MB',
        ]);

        $history = HistoryLaporan::findOrFail($id);
        $statusSebelumnya = $history->laporan->status;
        $lampiranFile = $history->lampiran_file;

        if ($request->hasFile('lampiran_file')) {
            $file = $request->file('lampiran_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/history-laporan'), $filename);
            $lampiranFile = $filename;
        }

        $history->update([
            'status_sebelumnya' => $statusSebelumnya,
            'status_baru' => $request->status_baru,
            'lampiran_file' => $lampiranFile,
            'catatan' => $request->filled('catatan') ? $request->catatan : null,
        ]);

        $history->laporan()->update([
            'status' => $request->status_baru,
        ]);

        return redirect()->route('admin.history-laporan.index')->with('success', 'History laporan berhasil diperbarui.');
    }

    private function formatStatusBadge(?string $status): string
    {
        if (!$status) {
            return '<span class="badge text-white bg-dark">-</span>';
        }

        return match ($status) {
            'menunggu' => '<span class="badge text-white bg-warning">Menunggu</span>',
            'diproses' => '<span class="badge text-white bg-info">Diproses</span>',
            'selesai' => '<span class="badge text-white bg-success">Selesai</span>',
            'ditolak' => '<span class="badge text-white bg-danger">Ditolak</span>',
            default => '<span class="badge text-white bg-secondary">Tidak Diketahui</span>',
        };
    }
}
