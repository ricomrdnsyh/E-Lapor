<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Unit;
use App\Services\ClientSSO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        $units = Unit::with('kategoris')->where('status', 'aktif')->get();
        return view('admin.users.index', compact('units'));
    }

    public function getUsers()
    {
        $query = User::with('unit', 'kategoris')->select(['id', 'nama', 'username', 'role', 'unit_id', 'telegram_id'])->orderByDesc('id');

        return DataTables::of($query)
            ->editColumn('role', function ($row) {
                $badgeClass = match ($row->role) {
                    'admin' => 'bg-success',
                    'pimpinan' => 'bg-primary',
                    default => 'bg-info',
                };
                return '<span class="badge text-white ' . $badgeClass . '">' . ucfirst($row->role) . '</span>';
            })
            ->addColumn('unit_info', function ($row) {
                if ($row->role === 'admin') return '<span class="text-muted">-</span>';
                if (!$row->unit) return '-';
                $kategoris = $row->kategoris->pluck('nama_kategori')->implode(', ');
                $unit = e($row->unit->nama_unit);
                return $kategoris
                    ? $unit . ' <small class="text-muted">(' . e($kategoris) . ')</small>'
                    : $unit;
            })
            ->editColumn('telegram_id', function ($row) {
                return $row->telegram_id ?: '-';
            })
            ->addColumn('action', function ($row) {
                $showBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-info text-center btn-show"
                                data-id="' . $row->id . '"
                                data-bs-toggle="tooltip" title="Detail" data-bs-title="Detail">
                                <i class="fa fa-file-alt"></i>
                            </a>';

                $editBtn = '<a href="javascript:void(0)"
                                class="btn btn-sm btn-light btn-active-light-warning text-center btn-edit"
                                data-id="' . $row->id . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                $deleteBtn = '<a href="javascript:void(0)" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-light btn-active-light-danger text-center" data-bs-toggle="tooltip" title="Hapus" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></a>';

                return '<div class="text-center">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
            })
            ->rawColumns(['role', 'unit_info', 'action'])
            ->make(true);
    }

    public function getKaryawanApi(ClientSSO $client)
    {
        try {
            $karyawan = $client->getKaryawanFromApi();
            return response()->json(['success' => true, 'data' => $karyawan]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $user = User::with('unit', 'kategoris')->findOrFail($id);

        return response()->json([
            'user' => $user,
            'created_at_formatted' => $user->created_at
                ? $user->created_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('DD MMMM YYYY, HH:mm') : '-',
            'updated_at_formatted' => $user->updated_at
                ? $user->updated_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('DD MMMM YYYY, HH:mm') : '-',
        ]);
    }

    public function edit(string $id)
    {
        $user = User::with('kategoris', 'unit')->findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:100',
            'username'     => 'required|string|max:100|unique:users',
            'telegram_id'  => 'nullable|string|max:50',
            'password'     => 'required|string|min:6',
            'role'         => 'required|in:admin,unit,pimpinan',
            'unit_id'      => 'required_if:role,unit|required_if:role,pimpinan|nullable|exists:unit,id_unit',
            'kategori_ids' => 'nullable|array',
            'kategori_ids.*' => 'exists:kategori,id_kategori',
        ], [
            'nama.required'          => 'Nama harus diisi',
            'username.required'      => 'Username harus diisi',
            'username.unique'        => 'Username sudah terdaftar',
            'password.required'      => 'Password harus diisi',
            'password.min'           => 'Password minimal 6 karakter',
            'role.required'          => 'Role harus dipilih',
            'unit_id.required_if'    => 'Unit harus dipilih untuk role unit/pimpinan',
            'unit_id.exists'         => 'Unit tidak ditemukan',
            'kategori_ids.*.exists'  => 'Kategori tidak ditemukan',
        ]);

        $user = User::create([
            'nama'         => $request->nama,
            'username'     => $request->username,
            'telegram_id'  => $request->telegram_id ?: null,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'unit_id'      => in_array($request->role, ['unit', 'pimpinan']) ? $request->unit_id : null,
        ]);

        if (in_array($request->role, ['unit', 'pimpinan']) && $request->filled('kategori_ids')) {
            $user->kategoris()->sync($request->kategori_ids);
        }

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama'         => 'required|string|max:100',
            'username'     => 'required|string|max:100|unique:users,username,' . $id,
            'telegram_id'  => 'nullable|string|max:50',
            'password'     => 'nullable|string|min:6',
            'role'         => 'required|in:admin,unit,pimpinan',
            'unit_id'      => 'required_if:role,unit|required_if:role,pimpinan|nullable|exists:unit,id_unit',
            'kategori_ids' => 'nullable|array',
            'kategori_ids.*' => 'exists:kategori,id_kategori',
        ], [
            'nama.required'          => 'Nama harus diisi',
            'username.required'      => 'Username harus diisi',
            'username.unique'        => 'Username sudah terdaftar',
            'password.min'           => 'Password minimal 6 karakter',
            'role.required'          => 'Role harus dipilih',
            'unit_id.required_if'    => 'Unit harus dipilih untuk role unit/pimpinan',
            'unit_id.exists'         => 'Unit tidak ditemukan',
            'kategori_ids.*.exists'  => 'Kategori tidak ditemukan',
        ]);

        $data = [
            'nama'         => $request->nama,
            'username'     => $request->username,
            'telegram_id'  => $request->telegram_id ?: null,
            'role'         => $request->role,
            'unit_id'      => in_array($request->role, ['unit', 'pimpinan']) ? $request->unit_id : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if (in_array($request->role, ['unit', 'pimpinan']) && $request->filled('kategori_ids')) {
            $user->kategoris()->sync($request->kategori_ids);
        } else {
            $user->kategoris()->sync([]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data user berhasil dihapus.',
        ]);
    }
}
