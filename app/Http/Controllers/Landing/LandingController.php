<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function beranda()
    {
        return view('landing.beranda');
    }

    public function createLaporan()
    {
        return view('landing.laporan');
    }
}
