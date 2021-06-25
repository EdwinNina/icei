<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','slug','descripcion','requisitos','cargaHoraria','portada','categoria_id'];

    protected $table = 'carreras';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function certificado()
    {
        return $this->hasMany(CertificadoCarrera::class);
    }

    public function planificacionCarrera()
    {
        return $this->hasMany(PlanificacionCarrera::class);
    }
}
