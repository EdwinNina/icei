<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['carnet','nombre','paterno','materno','email','celular','expedido'];

    protected $table = 'docentes';

    protected static function boot(){
        parent::boot();

        static::created( function($docente) {
            $docente->perfil()->create();
        });
    }

    public function perfil(){
        return $this->hasOne(PerfilDocente::class);
    }

    public function carreras()
    {
        return $this->hasMany(Carrera::class);
    }

}
