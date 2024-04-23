<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class koleksi extends Model
{
    use HasFactory;
    protected $table = 'koleksipribadi';
    protected $fillable = [
        'bukuID',
        'userID',
    ];

    public function buku()
    {
        return $this->belongsTo(buku::class, 'bukuID');
    }
}
