<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = ['cover', 'judul','penulis','penerbit', 'tahunterbit', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsToMany(kategori::class, 'kategoribuku_relasi', 'bukuID', 'kategoriID');
        return $this->belongsToMany(kategori::class)->detach();
    }

}
