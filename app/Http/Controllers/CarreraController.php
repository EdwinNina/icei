<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Categoria;
use App\Models\Docente;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CarreraController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.carreras.create')->only('create','store');
        $this->middleware('can:admin.carreras.edit')->only('edit','update');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::select('nombre','id')->where('estado',1)->get();

        return view('admin.carreras.create', compact('categorias'));
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
        ]);

        $carrera = new Carrera();
        $carrera->titulo = mb_strtolower($request->titulo);
        $carrera->descripcion = mb_strtolower($request->descripcion);
        $carrera->requisitos = mb_strtolower($request->requisitos);
        $carrera->cargaHoraria = $request->cargaHoraria;
        $carrera->categoria_id = $request->categoria_id;

        if($request->hasFile('portada')){
            $path = 'storage/carreraPortadas';
            $photo = $request->file('portada');
            $namePhoto = time() . '.' . $photo->extension();
            $photo->move(public_path($path), $namePhoto);
        }
        $carrera->portada = $namePhoto;
        $carrera->save();

        if ($carrera) {
            return redirect()->route('admin.carreras.index')->with('message','good');
        } else {
            return redirect()->route('admin.carreras.index')->with('message','bad');
        }

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
        $categorias = Categoria::select('nombre','id')->where('estado',1)->get();

        return view('admin.carreras.edit', compact('categorias','carrera'));
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
            ]);

            $path = public_path() . '/storage/carreraPortadas/' . $request->oldCover;
            if(File::exists($path)){
                File::delete($path);
            }
            $carrera->titulo = mb_strtolower($request->titulo);
            $carrera->descripcion = mb_strtolower($request->descripcion);
            $carrera->cargaHoraria = $request->cargaHoraria;
            $carrera->categoria_id = $request->categoria_id;

            $path = 'storage/carreraPortadas';
            $photo = $request->file('portada');
            $namePhoto = time() . '.' . $photo->extension();
            $photo->move(public_path($path), $namePhoto);

            $carrera->portada = $namePhoto;
            $carrera->save();
        }else{
            $carrera->titulo = mb_strtolower($request->titulo);
            $carrera->descripcion = mb_strtolower($request->descripcion);
            $carrera->cargaHoraria = $request->cargaHoraria;
            $carrera->categoria_id = $request->categoria_id;
            $carrera->save();
        }

        if ($carrera) {
            return redirect()->route('admin.carreras.index')->with('message','good');
        } else {
            return redirect()->route('admin.carreras.index')->with('message','bad');
        }
    }
}
