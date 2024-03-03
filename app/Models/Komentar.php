<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto_id',
        'users_id',
        'isi_komentar',
    ];
    protected $table = 'komentar';

    //nilai balik ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    //nilai balik ke foto
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id', 'id');
    }
}
