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

        $carreras = Carrera::get();
        return view('inicio.cursos', compact('carreras'));
    }

    public function detalleCurso($id){
        $carrera = Carrera::find($id)->first();
        return view('inicio.detalle-curso', compact('carrera'));
    }
}
