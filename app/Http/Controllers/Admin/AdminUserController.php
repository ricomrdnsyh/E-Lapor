<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kategori;
use App\Services\ClientSSO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::with('unit')->get();
        return view('admin.users.index', compact('kategoris'));
    }

    public function getUsers()
    {
        $query = User::with('kategori.unit')->select(['id', 'nama', 'username', 'role', 'kategori_id', 'telegram_id'])->orderByDesc('id');

        return DataTables::of($query)
            ->editColumn('role', function ($row) {
                $badgeClass = $row->role === 'admin' ? 'bg-success' : 'bg-info';
                return '<span class="badge text-white ' . $badgeClass . '">' . ucfirst($row->role) . '</span>';
            })
            ->editColumn('kategori_id', function ($row) {
                if (!$row->kategori) return '-';
                $kategori = $row->kategori->nama_kategori;
                $unit = $row->kategori->unit->nama_unit ?? '';
                return $kategori . ($unit ? ' <small class="text-muted">(' . $unit . ')</small>' : '');
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
            ->rawColumns(['role', 'kategori_id', 'action'])
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
        $user = User::with('kategori.unit')->findOrFail($id);

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
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:100',
            'username'     => 'required|string|max:100|unique:users',
            'telegram_id'  => 'nullable|string|max:50',
            'password'     => 'required|string|min:6',
            'role'         => 'required|in:admin,unit',
            'kategori_id'  => 'required_if:role,unit|nullable|exists:kategori,id_kategori',
        ], [
            'nama.required'          => 'Nama harus diisi',
            'username.required'      => 'Username harus diisi',
            'username.unique'        => 'Username sudah terdaftar',
            'password.required'      => 'Password harus diisi',
            'password.min'           => 'Password minimal 6 karakter',
            'role.required'          => 'Role harus dipilih',
            'kategori_id.required_if' => 'Kategori harus dipilih untuk role unit',
            'kategori_id.exists'     => 'Kategori tidak ditemukan',
        ]);

        $kategoriId = $request->role === 'unit' ? $request->kategori_id : null;

        User::create([
            'nama'         => $request->nama,
            'username'     => $request->username,
            'telegram_id'  => $request->telegram_id ?: null,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'kategori_id'  => $kategoriId,
        ]);

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
            'role'         => 'required|in:admin,unit',
            'kategori_id'  => 'required_if:role,unit|nullable|exists:kategori,id_kategori',
        ], [
            'nama.required'          => 'Nama harus diisi',
            'username.required'      => 'Username harus diisi',
            'username.unique'        => 'Username sudah terdaftar',
            'password.min'           => 'Password minimal 6 karakter',
            'role.required'          => 'Role harus dipilih',
            'kategori_id.required_if' => 'Kategori harus dipilih untuk role unit',
            'kategori_id.exists'     => 'Kategori tidak ditemukan',
        ]);

        $data = [
            'nama'         => $request->nama,
            'username'     => $request->username,
            'telegram_id'  => $request->telegram_id ?: null,
            'role'         => $request->role,
            'kategori_id'  => $request->role === 'unit' ? $request->kategori_id : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

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
