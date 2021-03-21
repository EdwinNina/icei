<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','descripcion','requisitos','cargaHoraria','portada','categoria_id'];

    protected $table = 'carreras';


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function planificacion()
    {
        return $this->hasOne(Planificaciones::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class);
    }
}
