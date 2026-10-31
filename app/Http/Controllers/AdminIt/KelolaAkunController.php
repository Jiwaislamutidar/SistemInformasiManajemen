<?php

namespace App\Http\Controllers\AdminIt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaAkunController extends Controller
{
    public function index()
    {
        return view('adminit.kelolaakun');
    }
}