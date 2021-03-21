<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionCarrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'costo_carrera','costo_modulo','gestion','observaciones','estado', 'codigo',
        'modalidad_id','horario_id','docente_id','carrera_id'
    ];


    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

}
