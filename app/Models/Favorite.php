<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'id_user',
        'id_buku'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'id_buku', 'id_buku');
    }
}
