<?php
namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UnitDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $baseQuery = $this->laporanKategoriQuery($user->kategori_id);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'diproses' => (clone $baseQuery)->where('status', 'diproses')->count(),
            'selesai' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'ditolak' => (clone $baseQuery)->where('status', 'ditolak')->count(),
        ];

        return view('unit.dashboard.index', compact('stats', 'user'));
    }

    private function laporanKategoriQuery(?int $kategoriId): Builder
    {
        return Laporan::query()->where('kategori_id', $kategoriId);
    }
}
