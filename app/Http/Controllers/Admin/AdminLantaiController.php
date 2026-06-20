<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\Lantai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminLantaiController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::all();
        return view('admin.lantai.index', compact('gedungs'));
    }

    public function getLantai()
    {
        $query = Lantai::with('gedung')->select(['id_lantai', 'nama_lantai', 'gedung_id'])->orderByDesc('id_lantai');

        return DataTables::of($query)
            ->addColumn('nama_gedung', function ($row) {
                return $row->gedung->nama_gedung ?? '-';
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_lantai . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_lantai . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_lantai . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->filterColumn('nama_gedung', function($query, $keyword) {
                $query->whereHas('gedung', function($q) use ($keyword) {
                    $q->where('nama_gedung', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $lantai = Lantai::with('gedung')->findOrFail($id);
        return view('admin.lantai.show', compact('lantai'));
    }

    public function edit(string $id)
    {
        $lantai = Lantai::findOrFail($id);
        return response()->json($lantai);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lantai' => 'required|string|max:50',
            'gedung_id'   => 'required|exists:gedung,id_gedung',
        ]);

        Lantai::create([
            'nama_lantai' => $request->nama_lantai,
            'gedung_id'   => $request->gedung_id,
        ]);

        return redirect()->route('admin.lantai.index')->with('success', 'Data lantai berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lantai' => 'required|string|max:50',
            'gedung_id'   => 'required|exists:gedung,id_gedung',
        ]);

        $lantai = Lantai::findOrFail($id);
        $lantai->update([
            'nama_lantai' => $request->nama_lantai,
            'gedung_id'   => $request->gedung_id,
        ]);

        return redirect()->route('admin.lantai.index')->with('success', 'Data lantai berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $lantai = Lantai::findOrFail($id);
        $lantai->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data lantai berhasil dihapus.',
        ]);
    }
}
