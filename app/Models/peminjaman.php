<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    
    // Definisi atribut-atribut yang dapat diisi
    protected $fillable = ['bukuID', 'userID', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    // Relasi dengan model Buku
    public function buku()
    {
        return $this->belongsTo(buku::class, 'bukuID');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($peminjaman) {
            // Cek jika tanggal kembali plus 7 hari lebih kecil atau sama dengan hari ini
            if ($peminjaman->tanggal_kembali && Carbon::parse($peminjaman->tanggal_kembali)->addDays(2)->lte(Carbon::now()) && $peminjaman->status !== 'dikembalikan') {
                // Perbarui status menjadi 'dikembalikan'
                $peminjaman->status = 'dikembalikan';
                $peminjaman->save();
            }
        });
    }
}
