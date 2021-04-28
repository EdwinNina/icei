<?php

namespace App\Http\Controllers;

use App\Models\AnterioresEstudiantes;
use Illuminate\Http\Request;

class AnterioresEstudiantesController extends Controller
{
    public function index(){
        $estudiantes = AnterioresEstudiantes::paginate();

        return view('admin.anterioresEstudiantes.index',compact('estudiantes'));
    }
}
