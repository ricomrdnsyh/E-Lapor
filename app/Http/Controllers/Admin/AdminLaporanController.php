<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::with('unit')->get();
        $units = Unit::has('kategoris')->get();
        return view('admin.laporan.index', compact('kategoris', 'units'));
    }

    public function getLaporan(Request $request)
    {
        $query = Laporan::with(['kategori', 'subKategori', 'units'])
            ->select(['id_laporan', 'kode_tiket', 'kategori_id', 'sub_kategori_id', 'judul_laporan', 'nama_pelapor', 'status', 'tgl_kejadian', 'created_at'])
            ->orderByDesc('id_laporan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('sub_kategori_id')) {
            $query->where('sub_kategori_id', $request->sub_kategori_id);
        }

        if ($request->filled('unit_id')) {
            $query->whereHas('units', function ($q) use ($request) {
                $q->where('unit_id', $request->unit_id);
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        return DataTables::of($query)
            ->addColumn('kategori_name', function ($row) {
                return $row->kategori->nama_kategori ?? '-';
            })
            ->addColumn('unit_tujuan', function ($row) {
                if ($row->units->isNotEmpty()) {
                    return $row->units->pluck('nama_unit')->join(', ');
                }
                return '-';
            })
            ->addColumn('sub_kategori', function ($row) {
                return $row->subKategori->nama_sub ?? '-';
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
            ->filterColumn('kategori_name', function($query, $keyword) {
                $query->whereHas('kategori', function($q) use ($keyword) {
                    $q->where('nama_kategori', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('unit_tujuan', function($query, $keyword) {
                $query->whereHas('units', function($q) use ($keyword) {
                    $q->where('nama_unit', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('sub_kategori', function($query, $keyword) {
                $query->whereHas('subKategori', function($q) use ($keyword) {
                    $q->where('nama_sub', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $laporan = Laporan::with(['kategori', 'subKategori', 'user', 'ruangan.lantai.gedung'])->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    public function edit(string $id)
    {
        $laporan   = Laporan::with(['kategori.unit', 'subKategori', 'ruangan.lantai.gedung'])->findOrFail($id);
        $kategoris = Kategori::with('unit')->get();
        $subKategoris = SubKategori::where('kategori_id', $laporan->kategori_id)->get();
        return response()->json([
            'laporan'      => $laporan,
            'kategoris'    => $kategoris,
            'subKategoris' => $subKategoris
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'unit_id'           => 'required|exists:unit,id_unit',
            'kategori_id'       => 'required|exists:kategori,id_kategori',
            'sub_kategori_id'   => 'nullable|exists:sub_kategori,id_sub',
            'judul_laporan'     => 'required|string|max:255',
            'tgl_kejadian'      => 'required|date_format:Y-m-d H:i',
            'deskripsi_laporan' => 'required|string|max:2000',
            'lampiran_file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'nama_pelapor'      => 'required_if:is_anonymous,t|nullable|string|max:100',
            'email_pelapor'     => 'required_if:is_anonymous,t|nullable|email|max:100',
            'no_telp_pelapor'   => 'required_if:is_anonymous,t|nullable|string|max:15',
            'tipe_pelapor'      => 'required_if:is_anonymous,t|nullable|string|in:Dosen,Mahasiswa,Tenaga Pendidik,Masyarakat/Umum',
            'email_anonim'      => 'nullable|email|max:100',
            'ruangan_id'        => 'nullable|exists:ruangan,id_ruangan',
            'is_anonymous'      => 'required|in:t,y',
            'status'            => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $laporan = Laporan::findOrFail($id);

        $nama_pelapor       = $validated['nama_pelapor'] ?? null;
        $email_pelapor      = $validated['email_pelapor'] ?? null;
        $no_telp_pelapor    = $validated['no_telp_pelapor'] ?? null;
        $tipe_pelapor       = $validated['tipe_pelapor'] ?? null;

        if ($validated['is_anonymous'] === 'y') {
            $nama_pelapor       = 'Anonymous';
            $email_pelapor      = !empty($validated['email_anonim']) ? $validated['email_anonim'] : 'Anonymous';
            $no_telp_pelapor    = 'Anonymous';
            $tipe_pelapor       = null;
        }

        $data = [
            'kategori_id'       => $validated['kategori_id'],
            'sub_kategori_id'   => $validated['sub_kategori_id'] ?? null,
            'judul_laporan'     => $validated['judul_laporan'],
            'tgl_kejadian'      => $validated['tgl_kejadian'],
            'deskripsi_laporan' => $validated['deskripsi_laporan'],
            'nama_pelapor'      => $nama_pelapor,
            'email_pelapor'     => $email_pelapor,
            'no_telp_pelapor'   => $no_telp_pelapor,
            'tipe_pelapor'      => $tipe_pelapor,
            'is_anonymous'      => $validated['is_anonymous'],
            'status'            => $validated['status'],
            'ruangan_id'        => $validated['ruangan_id'] ?? null,
        ];

        if ($request->hasFile('lampiran_file')) {
            $file     = $request->file('lampiran_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/laporan'), $filename);
            $data['lampiran_file'] = $filename;
        }

        $laporan->update($data);

        // Sync unit relationship
        $unitIds = [$validated['unit_id']];
        $subKategori = SubKategori::find($validated['sub_kategori_id'] ?? null);
        if ($subKategori && $subKategori->unit_id && $subKategori->unit_id != $validated['unit_id']) {
            $unitIds[] = $subKategori->unit_id;
        }
        $laporan->units()->sync(array_unique($unitIds));

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }
}
