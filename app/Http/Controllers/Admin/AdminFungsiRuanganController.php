<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FungsiRuangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminFungsiRuanganController extends Controller
{
    public function index()
    {
        return view('admin.fungsi-ruangan.index');
    }

    public function getFungsiRuangan()
    {
        $query = FungsiRuangan::select(['id_fungsi', 'nama_fungsi']);

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_fungsi . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_fungsi . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_fungsi . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $fungsiRuangan = FungsiRuangan::findOrFail($id);
        return view('admin.fungsi-ruangan.show', compact('fungsiRuangan'));
    }

    public function edit(string $id)
    {
        $fungsiRuangan = FungsiRuangan::findOrFail($id);
        return response()->json($fungsiRuangan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fungsi' => 'required|string|max:50',
        ]);

        FungsiRuangan::create([
            'nama_fungsi' => $request->nama_fungsi,
        ]);

        return redirect()->route('admin.fungsi-ruangan.index')->with('success', 'Data fungsi ruangan berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_fungsi' => 'required|string|max:50',
        ]);

        $fungsiRuangan = FungsiRuangan::findOrFail($id);
        $fungsiRuangan->update([
            'nama_fungsi' => $request->nama_fungsi,
        ]);

        return redirect()->route('admin.fungsi-ruangan.index')->with('success', 'Data fungsi ruangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $fungsiRuangan = FungsiRuangan::findOrFail($id);
        $fungsiRuangan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data fungsi ruangan berhasil dihapus.',
        ]);
    }
}
