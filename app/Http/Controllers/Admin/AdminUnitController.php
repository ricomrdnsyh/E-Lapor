<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminUnitController extends Controller
{
    public function index()
    {
        return view('admin.unit.index');
    }

    public function getUnit()
    {
        $query = Unit::select(['id_unit', 'nama_unit', 'singkatan']);

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_unit . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id_unit . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_unit . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.unit.show', compact('unit'));
    }

    public function edit(string $id)
    {
        $unit = Unit::findOrFail($id);
        return response()->json($unit);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:100',
            'singkatan' => 'required|string',
        ]);

        Unit::create([
            'nama_unit' => $request->nama_unit,
            'singkatan' => $request->singkatan,
        ]);

        return redirect()->route('admin.unit.index')->with('success', 'Data unit berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:100',
            'singkatan' => 'required|string',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update([
            'nama_unit' => $request->nama_unit,
            'singkatan' => $request->singkatan,
        ]);

        return redirect()->route('admin.unit.index')->with('success', 'Data unit berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data unit berhasil dihapus.',
        ]);
    }
}
