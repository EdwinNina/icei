<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilDocente extends Model
{
    use HasFactory;

    protected $fillable = ['profesion','biografia','website','foto','curriculum','docente_id'];

    protected $table = 'perfil_docentes';

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

}
