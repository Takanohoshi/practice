<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Proses autentikasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function poslog(Request $request)
    {
        // Validasi inputan pengguna
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Mengumpulkan informasi login
        $info = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Mencoba untuk melakukan login
        if (Auth::attempt($info)) {
            $request->session()->regenerate();

            // Mengarahkan pengguna sesuai levelnya
            if (Auth::user()->level == 'admin') {
                return redirect('admindash')->with('loginberhasil', 'Login berhasil!!');
            } elseif (Auth::user()->level == 'petugas') {
                return redirect('petugasdash')->with('loginberhasil', 'Login berhasil!!');
            } elseif (Auth::user()->level == 'guest') {
                return redirect('guestdash')->with('loginberhasil', 'Login berhasil!!');
            }
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return redirect('/login')->with('loginError', 'Login gagal!, silahkan cek email atau password anda ');
        }
    }
}
