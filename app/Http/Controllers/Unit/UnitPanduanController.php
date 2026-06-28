<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panduan;

class UnitPanduanController extends Controller
{
    public function index()
    {
        $panduans = Panduan::whereIn('target_audience', ['unit', 'semua'])
                           ->orderByDesc('created_at')
                           ->get();
                           
        return view('unit.panduan.index', compact('panduans'));
    }
}
