<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionModulo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function planificacionCarrera()
    {
        return $this->belongsTo(PlanificacionCarrera::class);
    }
    public function aula()
    {
        return $this->belongsTo(Aula::class,'aula_id');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function detalleNota()
    {
        return $this->hasOne(DetalleNota::class);
    }

}
