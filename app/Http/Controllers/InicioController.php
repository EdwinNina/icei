<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class InicioController extends Controller
{

    public function index()
    {
        return view('inicio.index');
    }

    public function cursos(){
        $carreras = Carrera::where('estado',1)->get();
        return view('inicio.cursos', compact('carreras'));
    }

    public function detalleCurso(Carrera $carrera){
        return view('inicio.detalle-curso', compact('carrera'));
    }
}
