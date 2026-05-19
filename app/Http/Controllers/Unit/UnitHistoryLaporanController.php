<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\HistoryLaporan;
use App\Models\LogStatusLaporan;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UnitHistoryLaporanController extends Controller
{
    public function index()
    {
        return view('unit.history-laporan.index');
    }

    public function getHistoryLaporan(Request $request)
    {
        $query = $this->historyLaporanQuery()
            ->select([
                'id_history',
                'laporan_id',
                'user_id',
                'status',
                'lampiran_file',
                'catatan',
                'created_at'
            ])
            ->orderByDesc('id_history');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

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
            ->editColumn('status', function ($row) {
                return $this->formatStatusBadge($row->status ?? $row->laporan?->status);
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
            ->rawColumns(['status', 'lampiran_file', 'action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $history = $this->findOwnedHistoryOrFail($id);

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
        $history = $this->findOwnedHistoryOrFail($id);

        return response()->json([
            'history' => $history,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            'status'        => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan'       => 'nullable|string|max:2000',
            'lampiran_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ];

        if ($request->status === 'selesai') {
            $rules['lampiran_file'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:5120';
        }

        $request->validate($rules, [
            'status.required'           => 'Status harus dipilih',
            'status.in'                 => 'Status tidak valid',
            'catatan.max'               => 'Catatan maksimal 2000 karakter',
            'lampiran_file.required'    => 'Lampiran bukti wajib diunggah saat laporan selesai',
            'lampiran_file.mimes'       => 'Lampiran harus berupa jpg, jpeg, png, pdf',
            'lampiran_file.max'         => 'Ukuran lampiran maksimal 5 MB',
        ]);

        $history = $this->findOwnedHistoryOrFail($id);
        $lampiranFile = $history->lampiran_file;

        if ($request->hasFile('lampiran_file')) {
            $file           = $request->file('lampiran_file');
            $filename       = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/history-laporan'), $filename);
            $lampiranFile   = $filename;
        }

        $history->update([
            'user_id'       => Auth::id(),
            'status'        => $request->status,
            'lampiran_file' => $lampiranFile,
            'catatan'       => $request->filled('catatan') ? $request->catatan : null,
        ]);

        LogStatusLaporan::create([
            'history_id'    => $history->id_history,
            'user_id'       => Auth::id(),
            'status'        => $request->status,
            'catatan'       => $request->filled('catatan') ? $request->catatan : null,
        ]);

        $history->laporan()->update([
            'status' => $request->status,
        ]);

        // Kirim notifikasi email ke pelapor
        try {
            $laporan = $history->laporan;
            if ($laporan) {
                app(EmailNotificationService::class)->notifyLaporanUpdate(
                    $laporan,
                    $request->status,
                    $request->catatan
                );
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('[EmailNotif] Error update unit: ' . $e->getMessage());
        }

        return redirect()->route('unit.history-laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    private function historyLaporanQuery()
    {
        return HistoryLaporan::with(['laporan.kategori', 'user'])
            ->whereHas('laporan', function ($query) {
                $query->where('kategori_id', Auth::user()->kategori_id);
            });
    }

    private function findOwnedHistoryOrFail(string $id): HistoryLaporan
    {
        return $this->historyLaporanQuery()
            ->with(['laporan.kategori.unit', 'laporan.ruangan.lantai.gedung', 'user.unit'])
            ->findOrFail($id);
    }

    private function formatStatusBadge(?string $status): string
    {
        if (!$status) {
            return '<span class="badge text-white bg-dark">-</span>';
        }

        return match ($status) {
            'menunggu'  => '<span class="badge text-white bg-warning">Menunggu</span>',
            'diproses'  => '<span class="badge text-white bg-info">Diproses</span>',
            'selesai'   => '<span class="badge text-white bg-success">Selesai</span>',
            'ditolak'   => '<span class="badge text-white bg-danger">Ditolak</span>',
            default     => '<span class="badge text-white bg-secondary">Tidak Diketahui</span>',
        };
    }
}
