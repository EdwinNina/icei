<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionTaller extends Model
{
    use HasFactory;

    protected $fillable = ['total_costo','total_pagado','saldo','estudiante_id','planificacion_taller_id','estado'];

    //scopes
    public function scopeBusqueda($query, $busqueda){
        if($busqueda === ''){
            return;
        }

        return $query->whereHas('estudiante', function($q) use($busqueda){
            $q->where('nombre', 'like', "%{$busqueda}%")->orWhere('paterno', 'like', "%{$busqueda}%");
        });
    }

    //relaciones eloquent
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class,'estudiante_id');
    }

    public function planificacionTaller()
    {
        return $this->belongsTo(PlanificacionTaller::class,'planificacion_taller_id');
    }

    public function pagosInscripcionTaller()
    {
        return $this->morphMany(RegistroEconomico::class, 'economicable');
    }

    public function certificado()
    {
        return $this->hasOne(CertificadoTaller::class, 'inscripcion_taller_id');
    }
}
