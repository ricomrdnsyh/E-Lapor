<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporController extends Controller
{
    public function index(Request $request)
    {
        return view('landing.lapor');
    }
}
