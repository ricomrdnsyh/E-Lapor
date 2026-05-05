<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.laporan.index', compact('kategoris'));
    }

    public function getLaporan(Request $request)
    {
        $query = Laporan::with('kategori')
            ->select(['id_laporan', 'kode_tiket', 'kategori_id', 'judul_laporan', 'nama_pelapor', 'status', 'tgl_kejadian'])
            ->orderByDesc('id_laporan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($query)
            ->addColumn('kategori_name', function ($row) {
                return $row->kategori->nama_kategori ?? '-';
            })
            ->editColumn('tgl_kejadian', function ($row) {
                return $row->tgl_kejadian->locale('id')->isoFormat('DD MMMM YYYY, HH:mm');
            })
            ->editColumn('status', function ($row) {
                return match ($row->status) {
                    'menunggu'  => '<span class="badge text-white bg-warning">Menunggu</span>',
                    'diproses'  => '<span class="badge text-white bg-info">Diproses</span>',
                    'selesai'   => '<span class="badge text-white bg-success">Selesai</span>',
                    'ditolak'   => '<span class="badge text-white bg-danger">Ditolak</span>',
                    default     => '<span class="badge text-white bg-secondary">Tidak Diketahui</span>'
                };
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_laporan . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_laporan . '"
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
        $laporan = Laporan::with(['kategori', 'user'])->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    public function edit(string $id)
    {
        $laporan   = Laporan::with('kategori.unit')->findOrFail($id);
        $kategoris = Kategori::with('unit')->get();
        return response()->json([
            'laporan'   => $laporan,
            'kategoris' => $kategoris
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id'       => 'required|exists:kategori,id_kategori',
            'judul_laporan'     => 'required|string|max:255',
            'tgl_kejadian'      => 'required|date_format:Y-m-d H:i',
            'lokasi_kejadian'   => 'required|string|max:150',
            'deskripsi_laporan' => 'required|string|max:2000',
            'nama_pelapor'      => 'nullable|string|max:100',
            'email_pelapor'     => 'nullable|email|max:100',
            'no_telp_pelapor'   => 'nullable|string|max:15',
            'tipe_pelapor'      => 'nullable|string|in:Dosen,Mahasiswa,Tenaga Pendidik,Masyarakat/Umum',
            'is_anonymous'      => 'required|in:t,y',
            'status'            => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->only([
            'kategori_id',
            'judul_laporan',
            'tgl_kejadian',
            'lokasi_kejadian',
            'deskripsi_laporan',
            'nama_pelapor',
            'email_pelapor',
            'no_telp_pelapor',
            'tipe_pelapor',
            'is_anonymous',
            'status'
        ]));

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }
}
