<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminSubKategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::with('unit')->get();
        $units = Unit::all();
        return view('admin.sub-kategori.index', compact('kategoris', 'units'));
    }

    public function getSubKategori(Request $request)
    {
        $query = SubKategori::with(['kategori.unit', 'unit'])->select(['id_sub', 'kategori_id', 'nama_sub', 'unit_id'])->orderByDesc('id_sub');

        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('unit_id', $request->unit_id);
            });
        }

        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($query)
            ->addColumn('nama_kategori', function ($row) {
                return $row->kategori->nama_kategori ?? '-';
            })
            ->addColumn('nama_kategori_unit', function ($row) {
                return $row->kategori->unit->nama_unit ?? '-';
            })
            ->addColumn('nama_unit_sub', function ($row) {
                return $row->unit->nama_unit ?? '-';
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_sub . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_sub . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_sub . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->filterColumn('nama_kategori', function($query, $keyword) {
                $query->whereHas('kategori', function($q) use ($keyword) {
                    $q->where('nama_kategori', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('nama_kategori_unit', function($query, $keyword) {
                $query->whereHas('kategori.unit', function($q) use ($keyword) {
                    $q->where('nama_unit', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('nama_unit_sub', function($query, $keyword) {
                $query->whereHas('unit', function($q) use ($keyword) {
                    $q->where('nama_unit', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $subKategori = SubKategori::with(['kategori.unit', 'unit'])->findOrFail($id);
        return response()->json([
            'nama_sub' => $subKategori->nama_sub,
            'nama_kategori' => $subKategori->kategori->nama_kategori ?? '-',
            'nama_kategori_unit' => $subKategori->kategori->unit->nama_unit ?? '-',
            'nama_unit_sub' => $subKategori->unit->nama_unit ?? '-',
        ]);
    }

    public function edit(string $id)
    {
        $subKategori = SubKategori::findOrFail($id);
        return response()->json($subKategori);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sub'    => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'unit_id'     => 'nullable|exists:unit,id_unit',
        ]);

        SubKategori::create([
            'nama_sub'    => $request->nama_sub,
            'kategori_id' => $request->kategori_id,
            'unit_id'     => $request->unit_id,
        ]);

        return redirect()->route('admin.sub-kategori.index')->with('success', 'Data sub kategori berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_sub'    => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'unit_id'     => 'nullable|exists:unit,id_unit',
        ]);

        $subKategori = SubKategori::findOrFail($id);
        $subKategori->update([
            'nama_sub'    => $request->nama_sub,
            'kategori_id' => $request->kategori_id,
            'unit_id'     => $request->unit_id,
        ]);

        return redirect()->route('admin.sub-kategori.index')->with('success', 'Data sub kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $subKategori = SubKategori::findOrFail($id);
        $subKategori->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data sub kategori berhasil dihapus.',
        ]);
    }
}
