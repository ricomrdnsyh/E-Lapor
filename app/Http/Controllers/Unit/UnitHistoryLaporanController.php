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
        $user = Auth::user();
        $kategoriIds = $user->kategoris()->pluck('kategori.id_kategori')->toArray();

        if (!empty($kategoriIds)) {
            $categories = \App\Models\Kategori::whereIn('id_kategori', $kategoriIds)->get();
        } else {
            $categories = \App\Models\Kategori::where('unit_id', $user->unit_id)->get();
        }

        return view('unit.history-laporan.index', compact('categories'));
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

        if ($request->filled('kategori_id')) {
            $query->whereHas('laporan', function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori_id);
            });
        }

        if ($request->filled('sub_kategori_id')) {
            $query->whereHas('laporan', function ($q) use ($request) {
                $q->where('sub_kategori_id', $request->sub_kategori_id);
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
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
            ->addColumn('sub_kategori', function ($row) {
                return $row->laporan?->subKategori?->nama_sub ?? '-';
            })
            ->addColumn('nama_pelapor', function ($row) {
                return $row->laporan?->nama_pelapor ?: '-';
            })
            ->addColumn('unit_penangan', function ($row) {
                if ($row->user) {
                    return $row->user->nama . ' - ' . ($row->user->unit?->singkatan ?? '-');
                }
                return '-';
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

                $editBtn = '<a href="' . route('unit.history-laporan.edit', $row->id_history) . '"
                                class="btn btn-sm btn-light btn-active-light-warning text-center"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . '</div>';
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
            ->filterColumn('nama_pelapor', function($query, $keyword) {
                $query->whereHas('laporan', function($q) use ($keyword) {
                    $q->where('nama_pelapor', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('kategori', function($query, $keyword) {
                $query->whereHas('laporan.kategori', function($q) use ($keyword) {
                    $q->where('nama_kategori', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('sub_kategori', function($query, $keyword) {
                $query->whereHas('laporan.subKategori', function($q) use ($keyword) {
                    $q->where('nama_sub', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['status', 'lampiran_file', 'action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $history = $this->findOwnedHistoryOrFail($id);

        $timeline = \App\Models\LogStatusLaporan::with(['user.unit', 'historyLaporan'])
            ->whereHas('historyLaporan', function ($q) use ($history) {
                $q->where('laporan_id', $history->laporan_id);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($log) {
                return [
                    'status' => $log->status,
                    'catatan' => $log->catatan,
                    'lampiran_file' => $log->status === 'selesai' ? $log->historyLaporan?->lampiran_file : null,
                    'created_at_formatted' => $log->created_at ? $log->created_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') : '',
                    'time_formatted' => $log->created_at ? $log->created_at->copy()->setTimezone('Asia/Jakarta')->format('H:i') : '',
                    'user_nama' => $log->user ? $log->user->nama : null,
                    'unit_nama' => $log->user && $log->user->unit ? ($log->user->unit->singkatan ?: $log->user->unit->nama_unit) : null,
                ];
            });

        return response()->json([
            'history' => $history,
            'timeline' => $timeline,
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

        return view('unit.history-laporan.edit', compact('history'));
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
        $user = Auth::user();
        $kategoriIds = $user->kategoris()->pluck('kategori.id_kategori')->toArray();

        return HistoryLaporan::with(['laporan.kategori', 'user.unit'])
            ->whereHas('laporan', function ($laporanQuery) use ($user, $kategoriIds) {
                if ($user->unit_id) {
                    $laporanQuery->whereHas('units', function ($query) use ($user) {
                        $query->where('unit_id', $user->unit_id);
                    });
                } else {
                    $laporanQuery->whereRaw('0=1');
                }

                if (!empty($kategoriIds)) {
                    $laporanQuery->whereIn('kategori_id', $kategoriIds);
                }
            });
    }

    private function findOwnedHistoryOrFail(string $id): HistoryLaporan
    {
        return $this->historyLaporanQuery()
            ->with(['laporan.kategori.unit', 'laporan.subKategori', 'laporan.ruangan.lantai.gedung', 'user.unit'])
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
