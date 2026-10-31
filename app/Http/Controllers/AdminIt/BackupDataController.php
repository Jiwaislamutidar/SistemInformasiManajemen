<?php

namespace App\Http\Controllers\Adminit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupDataController extends Controller
{
    public function index()
    {
        return view('adminit.backupdata');
    }
}