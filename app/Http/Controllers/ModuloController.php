<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ModuloController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::select('titulo','id')->get();

        return view('admin.modulos.create', compact('carreras'));
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
            'version' => 'required',
            'temario' => 'required',
            'cargaHoraria' => 'required|numeric',
            'portada' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            'carrera' => 'required',
        ]);

        $modulo = new Modulo();
        $modulo->titulo = $request->titulo;
        $modulo->version = $request->version;
        $modulo->temario = $request->temario;
        $modulo->cargaHoraria = $request->cargaHoraria;
        $modulo->carrera_id = $request->carrera;

        if($request->hasFile('portada')){
            $path = 'storage/moduloPortadas';
            $photo = $request->file('portada');
            $namePhoto = time() . '.' . $photo->extension();
            $photo->move(public_path($path), $namePhoto);
        }
        $modulo->portada = $namePhoto;
        $modulo->save();

        return redirect()->route('admin.modulos.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        $carreras = Carrera::select('titulo','id')->get();

        return view('admin.modulos.edit', compact('carreras', 'modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo)
    {

        if($request->hasFile('portada')){
            $request->validate([
                'portada' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            ]);
            $path = public_path() . '/storage/moduloPortadas/' . $request->oldCover;
            if(File::exists($path)){
                File::delete($path);
            }
            $modulo->titulo = $request->titulo;
            $modulo->version = $request->version;
            $modulo->temario = $request->temario;
            $modulo->cargaHoraria = $request->cargaHoraria;
            $modulo->carrera_id = $request->carrera;

            $path = 'storage/moduloPortadas';
            $photo = $request->file('portada');
            $namePhoto = time() . '.' . $photo->extension();
            $photo->move(public_path($path), $namePhoto);

            $modulo->portada = $namePhoto;
            $modulo->save();
        }else{
            $modulo->titulo = $request->titulo;
            $modulo->version = $request->version;
            $modulo->temario = $request->temario;
            $modulo->cargaHoraria = $request->cargaHoraria;
            $modulo->carrera_id = $request->carrera;
            $modulo->save();
        }
        return redirect()->route('admin.modulo.index');
    }
}
