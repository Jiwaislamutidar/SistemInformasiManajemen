<?php

namespace App\Http\Controllers\Adminit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LihatLogAktivitasController extends Controller
{
    public function index()
    {
        return view('adminit.lihatlogaktivitas');
    }
}