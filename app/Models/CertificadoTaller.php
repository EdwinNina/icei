<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoTaller extends Model
{
    use HasFactory;

    protected $fillable = [
        'impresion',
        'fecha_impresion',
        'solicitado',
        'fecha_solicitado',
        'entregado',
        'fecha_entregado',
        'estudiante_id',
        'estado',
        'copias',
        'planificacion_taller_id',
        'inscripcion_taller_id',
    ];

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
        return $this->belongsTo(InscripcionTaller::class,'inscripcion_taller_id');
    }

    public function planificacionTaller()
    {
        return $this->belongsTo(PlanificacionTaller::class, 'planificacion_taller_id');
    }

}
