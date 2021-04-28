<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dias', 'hora_inicio', 'hora_fin', 'turno'];

    protected $table = 'horarios';

    protected $casts = [
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];

    public function getHorarioCompletoAttribute()
    {
        $dias = Str::title($this->dias);
        return "{$dias} / " . $this->hora_inicio->format('H:i') ." - " . $this->hora_fin->format('H:i');
    }

    public function planificacionCarrera()
    {
        return $this->hasMany(PlanificacionCarrera::class);
    }
}
