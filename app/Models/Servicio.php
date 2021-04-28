<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'fecha_entrega' => 'datetime',
        'fecha_recepcion' => 'datetime',
    ];

    //relaciones Eloquent
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class,'estudiante_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class,'docente_id');
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaServicio::class,'categoria_servicio_id');
    }

    public function pagosServicios()
    {
        return $this->morphMany(RegistroEconomico::class, 'economicable');
    }
}
