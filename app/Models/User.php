<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\Like;
use App\Models\Album;
use App\Models\Komentar;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama_lengkap',
        'no_telepon',
        'bio',
        'foto_profile',
        'role',
        'alamat',
        'email',
        'password',
    ];

    //relasi ke foto sudah umpan balik
    public function foto()
    {
        return $this->hasMany(Foto::class, 'users_id', 'id');
    }
    //relasi ke album sudah umpan balik
    public function album()
    {
        return $this->hasMany(Album::class, 'users_id', 'id');
    }
    //relasi ke komentar sudah umpan balik
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'users_id', 'id');
    }
    //relasi ke like sudah umpan balik
    public function like()
    {
        return $this->hasOne(Like::class, 'users_id', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
