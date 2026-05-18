<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FungsiRuangan;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminRuanganController extends Controller
{
    public function index()
    {
        $lantais = Lantai::with('gedung')->get();
        $fungsiRuangans = FungsiRuangan::all();
        return view('admin.ruangan.index', compact('lantais', 'fungsiRuangans'));
    }

    public function getRuangan()
    {
        $query = Ruangan::with(['lantai.gedung', 'fungsiRuangan'])
            ->select(['id_ruangan', 'nama_ruangan', 'lantai_id', 'jenis_ruangan']);

        return DataTables::of($query)
            ->addColumn('nama_lantai', function ($row) {
                return $row->lantai->nama_lantai ?? '-';
            })
            ->addColumn('nama_gedung', function ($row) {
                return $row->lantai->gedung->nama_gedung ?? '-';
            })
            ->addColumn('nama_fungsi', function ($row) {
                return $row->fungsiRuangan->nama_fungsi ?? '-';
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_ruangan . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_ruangan . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_ruangan . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $ruangan = Ruangan::with(['lantai.gedung', 'fungsiRuangan'])->findOrFail($id);
        return response()->json([
            'nama_ruangan' => $ruangan->nama_ruangan,
            'nama_lantai' => $ruangan->lantai->nama_lantai ?? '-',
            'nama_gedung' => $ruangan->lantai->gedung->nama_gedung ?? '-',
            'nama_fungsi' => $ruangan->fungsiRuangan->nama_fungsi ?? '-',
        ]);
    }

    public function edit(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return response()->json($ruangan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan'  => 'required|string|max:100',
            'lantai_id'     => 'required|exists:lantai,id_lantai',
            'jenis_ruangan' => 'required|exists:fungsi_ruangan,id_fungsi',
        ]);

        Ruangan::create([
            'nama_ruangan'  => $request->nama_ruangan,
            'lantai_id'     => $request->lantai_id,
            'jenis_ruangan' => $request->jenis_ruangan,
        ]);

        return redirect()->route('admin.ruangan.index')->with('success', 'Data ruangan berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ruangan'  => 'required|string|max:100',
            'lantai_id'     => 'required|exists:lantai,id_lantai',
            'jenis_ruangan' => 'required|exists:fungsi_ruangan,id_fungsi',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update([
            'nama_ruangan'  => $request->nama_ruangan,
            'lantai_id'     => $request->lantai_id,
            'jenis_ruangan' => $request->jenis_ruangan,
        ]);

        return redirect()->route('admin.ruangan.index')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data ruangan berhasil dihapus.',
        ]);
    }
}
