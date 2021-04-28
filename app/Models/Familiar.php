<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familiar extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','paterno','materno','celular','estudiante_id'];

    public function getNombreCompletoAttribute(){
        return Str::ucfirst($this->paterno) . ' ' . Str::ucfirst($this->materno) . ' ' . Str::title($this->nombre);
    }
}
