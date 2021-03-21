<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class,'estudiante_id');
    }

    public function planPago()
    {
        return $this->belongsTo(TipoPlanPago::class,'tipo_plan_pago_id');
    }

    public function planificacionCarrera()
    {
        return $this->belongsTo(PlanificacionCarrera::class,'planificacion_carrera_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class,'modulo_id');
    }

    public function pagoInscripcion()
    {
        return $this->hasOne(InscripcionEconomico::class);
    }

}
