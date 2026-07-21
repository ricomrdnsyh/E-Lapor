<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('admin.kategori.index', compact('units'));
    }

    public function getKategori(Request $request)
    {
        $query = Kategori::with('unit')->select(['id_kategori', 'nama_kategori', 'unit_id'])->orderByDesc('id_kategori');

        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->where('unit_id', $request->unit_id);
        }

        return DataTables::of($query)
            ->addColumn('nama_unit', function ($row) {
                return $row->unit->nama_unit ?? '-';
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_kategori . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_kategori . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_kategori . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->filterColumn('nama_unit', function($query, $keyword) {
                $query->whereHas('unit', function($q) use ($keyword) {
                    $q->where('nama_unit', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $kategori = Kategori::with('unit')->findOrFail($id);
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'unit_id'       => 'required|exists:unit,id_unit',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'unit_id'       => $request->unit_id,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'unit_id'       => 'required|exists:unit,id_unit',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'unit_id'       => $request->unit_id,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data kategori berhasil dihapus.',
        ]);
    }
}
