<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planificaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'modalidad','costo_carrera','costo_modulo','gestion','fecha_inicio','fecha_fin','carrera_id'
    ];

    protected $table = 'planificaciones';

    public function carrera()
    {
        return $this->belongsTo(Carrera::class,'carrera_id');
    }
}
