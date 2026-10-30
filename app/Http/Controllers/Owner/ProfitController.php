<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function index()
    {
        return view('owner.profit');
    }
}