<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoCarrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_certificado',
        'total_pagado',
        'saldo',
        'impresion',
        'fecha_impresion',
        'solicitado',
        'fecha_solicitado',
        'entregado',
        'fecha_entregado',
        'estudiante_id',
        'estado',
        'carrera_id',
        'estudiante_id',
        'planificacion_carrera_id'
    ];

    public function scopeFiltroFecha($query, $fecha_de, $fecha_hasta){
        if($fecha_hasta === ''){ return;}

        return $query->whereBetween('fecha_entregado', [$fecha_de, $fecha_hasta]);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function planificacionCarrera()
    {
        return $this->belongsTo(PlanificacionCarrera::class, 'planificacion_carrera_id');
    }

    public function pagosCertificadoFinal()
    {
        return $this->morphMany(RegistroEconomico::class, 'economicable');
    }
}
