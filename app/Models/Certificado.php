<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFiltroFecha($query, $fecha_de, $fecha_hasta){
        if($fecha_hasta === ''){ return;}

        return $query->whereBetween('fecha_entregado', [$fecha_de, $fecha_hasta]);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class,'estudiante_id');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class,'inscripcion_id');
    }

    public function planificacionModulo()
    {
        return $this->belongsTo(PlanificacionModulo::class, 'planificacion_modulo_id');
    }

    public function nota()
    {
        return $this->belongsTo(Nota::class, 'nota_id');
    }

}
