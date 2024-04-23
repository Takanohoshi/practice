<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Melakukan logout dari guard 'web'
        Auth::guard('web')->logout();
        // Menginvalidasi sesi pengguna
        $request->session()->invalidate();
        // Mereset token sesi
        $request->session()->regenerateToken();
        // Mengarahkan pengguna ke halaman utama
        return redirect('/');
    }
}
