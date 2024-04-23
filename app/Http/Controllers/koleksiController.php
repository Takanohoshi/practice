<?php

namespace App\Http\Controllers;

use App\Models\koleksi;
use Illuminate\Http\Request;

class koleksiController extends Controller
{
    public function index()
    {
        $userID = auth()->user()->id;
        $koleksii = koleksi::where('userID', $userID)->get();
        return view('koleksibuku', compact('koleksii'));
    }
}
