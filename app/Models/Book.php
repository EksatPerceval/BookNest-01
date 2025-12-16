<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul',
        'penulis',
        'tahun',
        'kategori',
        'file_pdf',
        'cover',
        'deskripsi',
        'isi_buku',
        'views'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori', 'id_kategori');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'id_buku', 'id_buku');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'id_buku', 'id_user', 'id_buku', 'id_user');
    }

    public function isFavoritedBy($userId)
    {
        return $this->favorites()->where('id_user', $userId)->exists();
    }
}
