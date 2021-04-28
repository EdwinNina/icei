<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function usuario(){
        return $this->morphOne(UsuarioGeneral::class, 'generable');
    }

    public function planificacionCarrera(){
        return $this->hasOne(PlanificacionCarrera::class);
    }

    public function perfil(){
        return $this->hasOne(PerfilDocente::class);
    }

    public function getNombreCompletoAttribute(){
        return Str::title($this->nombre) .' '. Str::ucfirst($this->paterno) .' '. Str::ucfirst($this->materno);
    }
}
