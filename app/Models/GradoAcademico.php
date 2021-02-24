<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoAcademico extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id','grado','profesion','carrera','universidad'];

    protected $table = 'grado_academicos';
}
