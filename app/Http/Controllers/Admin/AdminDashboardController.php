<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $baseQuery = Laporan::query();

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'diproses' => (clone $baseQuery)->where('status', 'diproses')->count(),
            'selesai' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'ditolak' => (clone $baseQuery)->where('status', 'ditolak')->count(),
        ];

        $meta = [
            'total_unit' => Unit::count(),
            'total_user' => User::count(),
        ];

        return view('admin.dashboard.index', compact('stats', 'meta', 'user'));
    }
}
