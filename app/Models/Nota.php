<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota_1', 'nota_2', 'nota_final', 'estado', 'estudiante_id', 'planificacion_modulo_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function planificacionModulo()
    {
        return $this->belongsTo(PlanificacionModulo::class, 'planificacion_modulo_id');
    }

}
