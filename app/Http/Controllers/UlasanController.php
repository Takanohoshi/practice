<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        $buku = buku::all();
        $ulasan = Ulasan::where('bookID', $buku->id)->get();

        return view('detail', compact('buku', 'ulasan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'ulasan' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Simpan ulasan ke dalam database
        $ulasan = new ulasan();
        $ulasan->bookID = $id;
        $ulasan->userID = auth()->user()->id;
        $ulasan->ulasan = $request->ulasan;
        $ulasan->rating = $request->rating;
        $ulasan->save();

        return redirect()->route('detail', ['id' => $id])->with('success', 'Ulasan berhasil disimpan.');
    }
}
