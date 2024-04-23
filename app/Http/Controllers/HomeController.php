<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('home', compact('buku'));
    }

    public function indexx()
    {
        $buku = Buku::all();
        return view('guest.index', compact('buku'));
    }

    public function detail($id)
    {
        // Mengambil data buku berdasarkan ID yang diberikan
        $buku = Buku::findOrFail($id);

        // Mendapatkan informasi pengguna yang saat ini terautentikasi
        $user = auth()->user();

        // Mendapatkan ulasan yang terkait dengan buku yang dipilih
        $ulasan = Ulasan::where('bookID', $id)->get();

        // Inisialisasi status peminjaman dengan 'dikembalikan'
        $statusPeminjaman = 'dikembalikan';
    
        // Memeriksa apakah ada pengguna yang terautentikasi
        if ($user) {
            // Mendapatkan peminjaman aktif pengguna untuk buku yang dipilih
            $peminjamanAktif = Peminjaman::where('bukuID', $id)
                                ->where('userID', $user->id)
                                ->whereIn('status', ['dipinjam', 'dikembalikan'])
                                ->latest()
                                ->first();
            // Jika ada peminjaman aktif dan statusnya 'dipinjam', maka status peminjaman diubah
            if ($peminjamanAktif && $peminjamanAktif->status == 'dipinjam') {
                $statusPeminjaman = 'dipinjam';
            }
        }
    
        // Mengembalikan tampilan 'detail' dengan membawa data buku, status peminjaman, dan ulasan
        return view('detail', compact('buku', 'statusPeminjaman', 'ulasan'));
    }
}