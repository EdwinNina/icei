<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['aula','piso','estado'];

    public function getCursoCompletoAttribute(){
        return "Aula " . Str::ucfirst($this->aula) . " - Piso {$this->piso}";
    }

    public function planificacionModulos()
    {
        return $this->hasMany(PlanificacionModulo::class);
    }
}
