<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','version','temario','cargaHoraria','carrera_id','portada'];

    protected $table = 'modulos';

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

}
