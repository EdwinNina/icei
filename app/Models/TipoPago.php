<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $fillable = ['nombre','descripcion'];

    protected $table = 'tipo_pagos';

    use HasFactory;
}
