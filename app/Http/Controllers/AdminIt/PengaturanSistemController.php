<?php

namespace App\Http\Controllers\Adminit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanSistemController extends Controller
{
    public function index()
    {
        return view('adminit.pengaturansistem');
    }
}