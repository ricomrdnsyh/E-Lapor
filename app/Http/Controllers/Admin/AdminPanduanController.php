<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panduan;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminPanduanController extends Controller
{
    public function index()
    {
        return view('admin.panduan.index');
    }

    public function getPanduan()
    {
        $query = Panduan::select(['id_panduan', 'judul', 'file', 'target_audience', 'created_at'])->orderByDesc('id_panduan');

        return DataTables::of($query)
            ->editColumn('target_audience', function ($row) {
                if ($row->target_audience == 'semua') {
                    return '<span class="badge bg-success text-white">Semua</span>';
                } elseif ($row->target_audience == 'unit') {
                    return '<span class="badge bg-info text-white">Unit</span>';
                } else {
                    return '<span class="badge bg-warning text-white">Pimpinan</span>';
                }
            })
            ->editColumn('file', function ($row) {
                $url = asset('storage/' . $row->file);
                return '<a href="'.$url.'" target="_blank" class="text-danger" data-bs-toggle="tooltip" title="Lihat PDF"><i class="fa fa-file-pdf fs-1"></i></a>';
            })
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="javascript:void(0)" class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit me-2" data-id="' . $row->id_panduan . '" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>';
                
                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_panduan . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $editBtn . $deleteBtn . '</div>';
            })
            ->rawColumns(['target_audience', 'file', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:10240',
            'target_audience' => 'required|in:unit,pimpinan,semua',
        ]);

        $filePath = $request->file('file')->store('panduan', 'public');

        Panduan::create([
            'judul' => $request->judul,
            'file' => $filePath,
            'target_audience' => $request->target_audience,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Panduan berhasil ditambahkan.'
        ]);
    }

    public function show(string $id)
    {
        $panduan = Panduan::findOrFail($id);
        return response()->json($panduan);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:10240',
            'target_audience' => 'required|in:unit,pimpinan,semua',
        ]);

        $panduan = Panduan::findOrFail($id);

        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($panduan->file)) {
                Storage::disk('public')->delete($panduan->file);
            }
            $filePath = $request->file('file')->store('panduan', 'public');
            $panduan->file = $filePath;
        }

        $panduan->judul = $request->judul;
        $panduan->target_audience = $request->target_audience;
        $panduan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Panduan berhasil diperbarui.'
        ]);
    }

    public function destroy(string $id)
    {
        $panduan = Panduan::findOrFail($id);

        if (Storage::disk('public')->exists($panduan->file)) {
            Storage::disk('public')->delete($panduan->file);
        }

        $panduan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Panduan berhasil dihapus.'
        ]);
    }
}
