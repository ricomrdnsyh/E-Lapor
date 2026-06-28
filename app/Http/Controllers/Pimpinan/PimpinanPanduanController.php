<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panduan;

class PimpinanPanduanController extends Controller
{
    public function index()
    {
        $panduans = Panduan::whereIn('target_audience', ['pimpinan', 'semua'])
                           ->orderByDesc('created_at')
                           ->get();
                           
        return view('pimpinan.panduan.index', compact('panduans'));
    }
}
