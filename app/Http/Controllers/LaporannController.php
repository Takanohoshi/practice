<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;

class LaporannController extends Controller
{
    public function index ()
    {
        $dataPeminjaman = peminjaman::with(['user', 'buku'])->get();
        return view('petugas.laporann.index', ['dataPeminjaman' => $dataPeminjaman]);
    }
}
