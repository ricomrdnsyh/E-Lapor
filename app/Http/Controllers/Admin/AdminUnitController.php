<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Services\ClientSSO;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class AdminUnitController extends Controller
{
    public function index()
    {
        return view('admin.unit.index');
    }

    public function getUnit()
    {
        $query = Unit::select(['id_unit', 'nama_unit', 'singkatan', 'status'])->orderByDesc('id_unit');

        return DataTables::of($query)
            ->editColumn('status', function ($row) {
                if ($row->status == 'aktif') {
                    return '<span class="badge text-white bg-success">Aktif</span>';
                } elseif ($row->status == 'nonaktif') {
                    return '<span class="badge text-white bg-danger">Nonaktif</span>';
                } else {
                    return '<span class="badge bg-secondary">' . $row->status . '</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id_unit . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id_unit . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $deleteBtn . '</div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function show(Request $request, string $id)
    {
        $unit = Unit::findOrFail($id);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($unit);
        }

        return view('admin.unit.show', compact('unit'));
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

    public function syncFromApi(ClientSSO $client)
    {
        try {
            $items = $client->getUnitFromApi();

            $created   = 0;
            $updated   = 0;
            $unchanged = 0;

            foreach ($items as $item) {
                $status = $item['status'] ?? 'active';

                if ($status === 'active') {
                    $status = 'aktif';
                } elseif ($status === 'inactive') {
                    $status = 'nonaktif';
                }

                $data = [
                    'nama_unit' => $item['lembaga'],
                    'singkatan' => $item['singkatan'] ?? null,
                    'status'    => $status,
                ];

                $unit = Unit::where('id_unit', $item['id_lembaga'])->first();

                if (! $unit) {
                    Unit::create(array_merge([
                        'id_unit' => $item['id_lembaga'],
                    ], $data));

                    $created++;
                } else {
                    $unit->fill($data);

                    if ($unit->isDirty()) {
                        $unit->save();
                        $updated++;
                    } else {
                        $unchanged++;
                    }
                }
            }

            $totalApi = count($items);

            $message = "Sinkron data unit selesai. "
                . "Baru: {$created}, diupdate: {$updated}, tidak berubah: {$unchanged}. "
                . "Total data dari API: {$totalApi}.";

            return redirect()->route('admin.unit.index')->with('success', $message);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('admin.unit.index')->with('failed', 'Sinkron data unit gagal: ' . $e->getMessage());
        }
    }
}
