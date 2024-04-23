<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoribuku';
    protected $fillable = [
        'name',
    ];

        // Definisi relasi many-to-many dengan model buku
        public function buku()
        {
            return $this->belongsToMany(buku::class, 'kategoribuku_relasi','kategoriID', 'bukuID');
        }
}
