<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','descripcion','requisitos','cargaHoraria','portada','docente_id','categoria_id'];

    protected $table = 'carreras';

    public function docente()
    {
        return $this->belongsTo(Docente::class,'docente_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }
}
