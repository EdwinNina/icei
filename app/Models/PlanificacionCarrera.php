<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionCarrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'costo_carrera','costo_modulo','gestion','observaciones','estado', 'codigo',
        'modalidad_id','horario_id','docente_id','carrera_id'
    ];

    public function scopeFiltroDocente($query,$docente){

        if($docente === ''){ return;}

        return $query->where('docente_id', $docente);

    }

    //filtros con scope
    public function scopeBusqueda($query, $busqueda){
        if($busqueda === ''){return;}

        return $query->whereHas('carrera', function($q) use($busqueda){
            $q->where('titulo', 'like', "%{$busqueda}%");
        });
    }

    public function scopeFiltro($query, $estado){
        if($estado === ''){return;}

        return $query->where('estado',$estado);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

    public function planificacionModulos()
    {
        return $this->hasMany(PlanificacionModulo::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
