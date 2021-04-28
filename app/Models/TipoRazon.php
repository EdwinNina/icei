<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRazon extends Model
{
    protected $fillable = ['nombre','descripcion','estado'];

    use HasFactory;

    public function registroEconomico()
    {
        return $this->hasOne(RegistroEconomico::class);
    }
}
