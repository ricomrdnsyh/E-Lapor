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
        $baseQuery = $this->laporanUnitQuery();

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'diproses' => (clone $baseQuery)->where('status', 'diproses')->count(),
            'selesai' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'ditolak' => (clone $baseQuery)->where('status', 'ditolak')->count(),
        ];

        return view('unit.dashboard.index', compact('stats', 'user'));
    }

    private function laporanUnitQuery(): Builder
    {
        $user = Auth::user();
        $kategoriIds = $user->kategoris()->pluck('kategori.id_kategori')->toArray();

        return Laporan::where(function ($q) use ($user, $kategoriIds) {
            $hasFilter = false;

            if ($user->unit_id) {
                $hasFilter = true;
                $q->whereHas('units', function ($q2) use ($user) {
                    $q2->where('unit_id', $user->unit_id);
                });
            }

            if (!empty($kategoriIds)) {
                $hasFilter = true;
                $q->orWhereIn('kategori_id', $kategoriIds);
            }

            if (!$hasFilter) {
                $q->whereRaw('0=1');
            }
        });
    }
}
