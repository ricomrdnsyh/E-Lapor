<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlurController extends Controller
{
    public function alur()
    {
        return view('landing.alur');
    }
}
