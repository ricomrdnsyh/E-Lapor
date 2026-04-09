<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class UnitDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total' => Laporan::where('kategori_id', function ($q) {
                $q->select('id_kategori')
                    ->from('kategori')
                    ->where('unit_id', Auth::user()->unit_id);
            })->count(),
            'menunggu' => Laporan::where('status', 'menunggu')
                ->where('kategori_id', function ($q) {
                    $q->select('id_kategori')
                        ->from('kategori')
                        ->where('unit_id', Auth::user()->unit_id);
                })->count(),
            'diproses' => Laporan::where('status', 'diproses')
                ->where('kategori_id', function ($q) {
                    $q->select('id_kategori')
                        ->from('kategori')
                        ->where('unit_id', Auth::user()->unit_id);
                })->count(),
            'selesai' => Laporan::where('status', 'selesai')
                ->where('kategori_id', function ($q) {
                    $q->select('id_kategori')
                        ->from('kategori')
                        ->where('unit_id', Auth::user()->unit_id);
                })->count(),
        ];

        return view('unit.dashboard.index', compact('stats'));
    }
}
