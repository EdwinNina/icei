<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['carnet','nombre','paterno','materno','email','celular','codigo','expedido'];

    protected $table = 'estudiantes';


    public function grado()
    {
        return $this->hasOne(GradoAcademico::class);
    }

    public function familiares()
    {
        return $this->hasOne(Familiar::class);
    }

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class);
    }
}
