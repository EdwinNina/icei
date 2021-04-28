<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionTaller extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio','fecha_fin','costo','duracion','carga_horaria','requisitos','docente_id','horario_id','taller_id','modalidad_id','estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime'
    ];


    //filtros con scope
    public function scopeBusqueda($query, $busqueda){
        if($busqueda === ''){return;}

        return $query->whereHas('taller', function($q) use($busqueda){
            $q->where('nombre', 'like', "%{$busqueda}%");
        });
    }

    public function scopeFiltro($query, $estado){
        if($estado === ''){return;}

        return $query->where('estado',$estado);
    }


    public function taller()
    {
        return $this->belongsTo(Taller::class, 'taller_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'modalidad_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(InscripcionTaller::class);
    }
}
