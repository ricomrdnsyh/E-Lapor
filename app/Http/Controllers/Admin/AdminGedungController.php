<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminGedungController extends Controller
{
    public function index()
    {
        return view('admin.gedung.index');
    }

    public function getGedung()
    {
        $query = Gedung::select(['id_gedung', 'nama_gedung', 'deskripsi']);

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_gedung . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_gedung . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_gedung . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('admin.gedung.show', compact('gedung'));
    }

    public function edit(string $id)
    {
        $gedung = Gedung::findOrFail($id);
        return response()->json($gedung);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:30',
            'deskripsi'   => 'nullable|string|max:100',
        ]);

        Gedung::create([
            'nama_gedung' => $request->nama_gedung,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->route('admin.gedung.index')->with('success', 'Data gedung berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:30',
            'deskripsi'   => 'nullable|string|max:100',
        ]);

        $gedung = Gedung::findOrFail($id);
        $gedung->update([
            'nama_gedung' => $request->nama_gedung,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->route('admin.gedung.index')->with('success', 'Data gedung berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data gedung berhasil dihapus.',
        ]);
    }
}
