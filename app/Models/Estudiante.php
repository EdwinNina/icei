<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['carnet','nombre','paterno','materno','email','celular','codigo','expedido'];

    protected $table = 'estudiantes';

    public function getNombreCompletoAttribute(){
        return Str::ucfirst($this->paterno) . ' ' . Str::ucfirst($this->materno) . ' ' . Str::title($this->nombre);
    }

    public function usuario(){
        return $this->morphOne(UsuarioGeneral::class, 'generable');
    }

    public function grado()
    {
        return $this->hasOne(GradoAcademico::class);
    }

    public function familiares()
    {
        return $this->hasOne(Familiar::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class);
    }


}
