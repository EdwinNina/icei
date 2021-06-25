<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'fecha_congelacion_inicio' => 'datetime',
        'fecha_congelacion_fin' => 'datetime',
    ];

    //scopes de busqueda
    public function scopeBusqueda($query, $busqueda){
        if($busqueda === ''){
            return;
        }

        return $query->whereHas('estudiante', function($q) use($busqueda){
            $q->where('nombre', 'like', "%" . $busqueda . "%")
                ->orWhere('paterno', 'like', "%" . $busqueda . "%");
        });
    }

    public function scopeFiltro($query, $carrera, $modulo, $horario, $modalidad, $congelacion){
        if($congelacion === ''){
            return;
        }

        return $query->where([
            ['modulo_id', $modulo],
            ['congelacion', $congelacion],
            ])->whereHas('planificacionCarrera', function($q) use($horario,$carrera,$modalidad){
                $q->where([
                    ['carrera_id','=', $carrera],
                    ['horario_id','=', $horario],
                    ['modalidad_id','=', $modalidad],
                ]);
            });
    }

    //relaciones Eloquent
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class,'estudiante_id');
    }

    public function planificacionCarrera()
    {
        return $this->belongsTo(PlanificacionCarrera::class,'planificacion_carrera_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class,'modulo_id');
    }

    public function pagosInscripcion()
    {
        return $this->morphMany(RegistroEconomico::class, 'economicable');
    }

    public function tipoPlanPago()
    {
        return $this->belongsTo(TipoPlanPago::class,'tipo_plan_pago_id');
    }

    public function certificado()
    {
        return $this->hasOne(Certificado::class);
    }
}
