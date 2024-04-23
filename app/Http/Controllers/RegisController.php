<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisController extends Controller
{

    /**
     * Menampilkan halaman registrasi untuk tamu.
     *
     * @return \Illuminate\View\View
     */
    public function regquestt()
    {
        return view('reguest');
    }

    /**
     * Menampilkan halaman registrasi untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function regminn()
    {
        return view('regmin');
    }

    /**
     * Proses registrasi user berdasarkan jenis registrasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
            // Validasi email unique
            $request->validate([
                'email' => 'unique:users,email'
            ]);

        if ($request->is('regquest')) {
            // Logika untuk tamu
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->namalengkap = $request->input('namalengkap');
            $user->alamat = $request->input('alamat');
            $user->level = 'guest';
            $user->save();
            
            // Login user
            Auth::login($user);
            
            return redirect('guestdash');
        } elseif ($request->is('regmin')) {
            // Logika untuk admin
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->namalengkap = $request->input('namalengkap');
            $user->alamat = $request->input('alamat');
            $user->level = 'admin';
            $user->save();
            
            // Login user
            Auth::login($user);
            
            return redirect('admindash');
        }
    }
}
