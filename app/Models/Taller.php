<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $fillable = ['nombre','descripcion','estado'];

    use HasFactory;

    public function planificacionTalleres()
    {
        return $this->hasMany(PlanificacionTaller::class);
    }
}
