<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use App\Models\Komentar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Foto extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_foto',
        'deskripsi',
        'lokasi_foto',
        'album_id',
        'users_id',
    ];
    protected $table = 'foto';

    //nilai balik ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    //nilai balik ke album
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }


    //nilai ke komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'foto_id', 'id');
        return $this->hasMany(Komentar::class)->cascadeDelete();
    }
    //nilai ke like
    public function like()
    {
        return $this->hasMany(Like::class, 'foto_id', 'id');
        return $this->hasMany(Like::class)->cascadeDelete();
    }
}
