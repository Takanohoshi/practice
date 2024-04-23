<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\koleksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporannController;
use App\Models\peminjaman;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/regquest', [RegisController::class, 'regquestt']);
Route::post('/regquest', [RegisController::class, 'register']);

Route::get('/regmin', [RegisController::class, 'regminn']);
Route::post('/regmin', [RegisController::class, 'register']);


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('post', [LoginController::class, 'poslog'])->name('poslog');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('guestdash', function () {
        return view('guest.index');
    });
    Route::get('/koleksibuku', [koleksiController::class, 'index'])->name('koleksibuku');

    Route::middleware('admin')->group(function () {
        Route::get('admindash', function () {
            return view('admin.index');
        });

        Route::resource('dashboard/datauser', UserController::class)->except('show')->middleware('admin');
        Route::resource('dashboard/kategori', KategoriController::class)->except('show')->middleware('admin');
        Route::resource('dashboard/databuku', BukuController::class)->except('show')->middleware('admin');
        Route::resource('dashboard/laporan', LaporanController::class)->except('show')->middleware('admin');
    });

    Route::middleware('petugas')->group(function () {
    Route::get('petugasdash', function () {
        return view('petugas.index');
    });
    Route::resource('dashboard/databukuu', BukuuController::class)->except('show')->middleware('petugas');
    Route::resource('dashboard/laporann', LaporannController::class)->except('show')->middleware('petugas');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('guestdash', [HomeController::class, 'indexx'])->name('home');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');

Route::post('/pinjam/store/{id}', [peminjamanController::class, 'store'])->name('pinjam.store');
Route::put('/pinjam/{id}/kembalikan', [peminjamanController::class, 'update'])->name('peminjaman.update');
Route::get('/pinjam', [peminjamanController::class, 'index']);
Route::post('/ulasan/{id}', [UlasanController::class, 'store'])->name('ulasan.store');