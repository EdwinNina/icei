<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnterioresEstudiantes extends Model
{
    use HasFactory;

    protected $fillable = [
        'paterno','materno','nombre','carrera','modulo','nota','docente','fecha_inicio','fecha_fin'
    ];

}
