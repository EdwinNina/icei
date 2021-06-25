<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioGeneral extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function generable()
    {
        return $this->morphTo();
    }

    public function meGusta(){
        return $this->belongsToMany(Carrera::class, 'likes_usuarios');
    }

}
