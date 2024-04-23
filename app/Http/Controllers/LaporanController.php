<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index ()
    {
        $dataPeminjaman = peminjaman::with(['user', 'buku'])->get();
        return view('admin.laporan.index', ['dataPeminjaman' => $dataPeminjaman]);
    }
}
