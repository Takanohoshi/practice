<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\koleksi;
use App\Models\peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {

        // Dapatkan id pengguna yang saat ini terautentikasi
        $userId = Auth::id();

        // Dapatkan daftar peminjaman yang terkait dengan pengguna tertentu
        $peminjamans = peminjaman::where('userID', $userId)->with('buku')->get();

        // Tambahkan informasi apakah tombol harus dinonaktifkan berdasarkan status peminjaman
        foreach ($peminjamans as $peminjaman) {
            $peminjaman->disableButton = $peminjaman->status == 'dikembalikan';
        }

        return view('pinjam', compact('peminjamans'));
    }

        public function store(Request $request, $id)
    {
        $book = buku::findOrFail($id); // Pastikan buku tersedia
    
        // Membuat record peminjaman baru
        $pinjam = new Peminjaman();
        $pinjam->bukuID = $book->id;
        $pinjam->userID = auth()->id();
        $pinjam->tanggal_pinjam = now();
        $pinjam->tanggal_kembali = now()->addDays(2); // Ini akan diatur sesuai kemauan
    
        // Cek apakah tanggal kembali sama dengan tanggal pinjam
        if ($pinjam->tanggal_pinjam->toDateString() === $pinjam->tanggal_kembali->toDateString()) {
            $pinjam->status = 'dikembalikan'; 
        } else {
            $pinjam->status = 'dipinjam';
        }
    
        $pinjam->save();

        //menambahkan buku ke koleksi
        $koleksii = new koleksi();
        $koleksii->bukuID = $book->id;
        $koleksii->userID = auth()->id();
        $koleksii->save();
        
        return redirect()->route('home')->with('success', 'Buku berhasil dipinjam!');
    }

    public function update($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Lakukan logika pengembalian, misalnya mengubah status
        $peminjaman->update([
            'status' => 'dikembalikan',
            // Tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
