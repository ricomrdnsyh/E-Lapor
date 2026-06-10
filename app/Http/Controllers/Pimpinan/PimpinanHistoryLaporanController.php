<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\HistoryLaporan;
use App\Models\Kategori;
use App\Models\LogStatusLaporan;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PimpinanHistoryLaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategoriIds = $user->kategoris()->pluck('kategori.id_kategori')->toArray();
        $unitKategoriIds = Kategori::where('unit_id', $user->unit_id)->pluck('id_kategori')->toArray();
        $scopeIds = array_unique(array_merge($kategoriIds, $unitKategoriIds));
        $categories = Kategori::whereIn('id_kategori', $scopeIds)->get();

        $gedungs = Gedung::all();

        return view('pimpinan.history-laporan.index', compact('categories', 'gedungs'));
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

        if ($request->filled('gedung_id')) {
            $query->whereHas('laporan.ruangan.lantai', function ($q) use ($request) {
                $q->where('gedung_id', $request->gedung_id);
            });
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

                return '<div class="text-center">' . $showBtn . '</div>';
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

    private function historyLaporanQuery()
    {
        $user = Auth::user();
        $kategoriIds = $user->kategoris()->pluck('kategori.id_kategori')->toArray();

        return HistoryLaporan::with(['laporan.kategori', 'user.unit'])
            ->where(function ($q) use ($user, $kategoriIds) {
                $hasFilter = false;

                if ($user->unit_id) {
                    $hasFilter = true;
                    $q->whereHas('laporan.units', function ($query) use ($user) {
                        $query->where('unit_id', $user->unit_id);
                    });
                }

                if (!empty($kategoriIds)) {
                    $hasFilter = true;
                    $q->orWhereHas('laporan', function ($query) use ($kategoriIds) {
                        $query->whereIn('kategori_id', $kategoriIds);
                    });
                }

                if (!$hasFilter) {
                    $q->whereRaw('0=1');
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
