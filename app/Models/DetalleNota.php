<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNota extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function planificacionMódulo()
    {
        return $this->belongsTo(PlanificacionModulo::class);
    }
}
