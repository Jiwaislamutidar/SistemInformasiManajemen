<?php

namespace App\Http\Controllers\Adminit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaDataMasterController extends Controller
{
    public function index()
    {
        return view('adminit.keloladatamaster');
    }
}