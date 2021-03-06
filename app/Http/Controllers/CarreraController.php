<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Categoria;
use App\Models\Docente;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CarreraController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::select('nombre','id')->get();
        $docentes = Docente::select('nombre','paterno','materno','id')->get();

        return view('admin.carreras.create', compact('categorias','docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'requisitos' => 'required',
            'cargaHoraria' => 'required',
            'portada' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            'categoria_id' => 'required',
            'docente_id' => 'required',
        ]);

        $subject = new Carrera();
        $subject->titulo = $request->titulo;
        $subject->descripcion = $request->descripcion;
        $subject->requisitos = $request->requisitos;
        $subject->cargaHoraria = $request->cargaHoraria;
        $subject->categoria_id = $request->categoria_id;
        $subject->docente_id = $request->docente_id;

        if($request->hasFile('portada')){
            $path = 'storage/carreraPortadas';
            $photo = $request->file('portada');
            $namePhoto = time() . '.' . $photo->extension();
            $photo->move(public_path($path), $namePhoto);
        }
        $subject->portada = $namePhoto;
        $subject->save();

        return redirect()->route('admin.carreras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        return view('admin.carreras.show', compact('carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrera $carrera)
    {
        $categorias = Categoria::select('nombre','id')->get();
        $docentes = Docente::select('nombre','id')->get();

        return view('admin.carreras.edit', compact('categorias','docentes', 'carrera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrera $carrera)
    {
        if($request->hasFile('portada')){

            $request->validate([
                'titulo' => 'required',
                'requisitos' => 'required',
                'cargaHoraria' => 'required',
                'portada' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
                'categoria_id' => 'required',
                'docente_id' => 'required',
            ]);

            $path = public_path() . '/storage/carreraPortadas/' . $request->oldCover;
            if(File::exists($path)){
                File::delete($path);
            }
            $carrera->titulo = $request->titulo;
            $carrera->descripcion = $request->descripcion;
            $carrera->cargaHoraria = $request->cargaHoraria;
            $carrera->categoria_id = $request->categoria_id;
            $carrera->docente_id = $request->docente_id;

            $path = 'storage/carreraPortadas';
            $photo = $request->file('portada');
            $namePhoto = time() . '.' . $photo->extension();
            $photo->move(public_path($path), $namePhoto);

            $carrera->portada = $namePhoto;
            $carrera->save();
        }else{
            $carrera->titulo = $request->titulo;
            $carrera->descripcion = $request->descripcion;
            $carrera->cargaHoraria = $request->cargaHoraria;
            $carrera->categoria_id = $request->categoria_id;
            $carrera->docente_id = $request->docente_id;
            $carrera->save();
        }
        return redirect()->route('admin.carrera.index');
    }
}
