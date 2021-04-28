<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEconomico extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'registro_economicos';

    protected $casts = [
        'fecha_pago' => 'datetime'
    ];


    public function tipoDePago()
    {
        return $this->belongsTo(TipoPago::class,'tipo_pago_id');
    }

    public function tipoDeRazon()
    {
        return $this->belongsTo(TipoRazon::class,'tipo_razon_id');
    }

    public function economicable()
    {
        return $this->morphTo();
    }
}
