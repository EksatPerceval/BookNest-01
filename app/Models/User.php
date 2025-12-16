<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'id_user', 'id_user');
    }

    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'favorites', 'id_user', 'id_buku', 'id_user', 'id_buku');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
