<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ulasan extends Model
{
    use HasFactory;
    protected $table = 'ulasanbuku';

    protected $fillable = [
        'bookID',
        'usersID',
        'ulasan',
        'rating',
    ];

    public function buku()
    {
        return $this->belongsTo(buku::class, 'bookID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
