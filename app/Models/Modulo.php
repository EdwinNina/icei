<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','version','temario','cargaHoraria','carrera_id','portada'];

    protected $table = 'modulos';

    //mutadores
    public function getTituloCompletoAttribute()
    {
        return Str::upper($this->version) . " - " . Str::title($this->titulo);
    }

    //filtros con scope
    public function scopeBusqueda($query, $busqueda){
        if($busqueda === ''){return;}

        return $query->where('titulo', 'like', "%{$busqueda}%");
    }

    public function scopeFiltro($query, $carrera){
        if($carrera === ''){return;}

        return $query->where('carrera_id',$carrera);
    }

    //relaciones Eloquent
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }


    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class);
    }

    public function planificaciones()
    {
        return $this->hasMany(PlanificacionModulo::class);
    }
}
