<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        $slugGenerado = Str::slug($request->titulo);
        $carrera->slug = $slugGenerado;
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
    public function edit($id)
    {
        $categorias = Categoria::select('nombre','id')->where('estado',1)->get();
        $carrera = Carrera::where('id', $id)->first();
        return view('admin.carreras.edit', compact('categorias','carrera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carrera = Carrera::where('id', $id)->first();
        $slugGenerado = Str::slug($request->titulo);

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
            $carrera->slug = $slugGenerado;
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
            $carrera->slug = $slugGenerado;
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

    public function getCarreras() {
         $modulosProximos = DB::table('carreras as ca')
                ->join('planificacion_carreras as pc', 'pc.carrera_id','=','ca.id')
                ->join('planificacion_modulos as pm','pm.planificacion_carrera_id','=','pc.id')
                ->join('modulos as mo','mo.id','=','pm.modulo_id')
                ->select('ca.titulo as carrera','mo.titulo as modulo','mo.version as version','mo.portada as imagen','pm.fecha_inicio as inicio','pm.fecha_fin as fin')
                ->whereMonth('pm.fecha_inicio', date('m'))
                ->orWhere(function($query) {
                    $query->whereMonth('pm.fecha_inicio', date('m') + 1);
                })
                ->orderBy('pm.fecha_inicio','asc')
                ->get();

        $carreras = DB::table('carreras as ca')
            ->join('modulos as mo','mo.carrera_id','=','ca.id')
            ->select('ca.titulo', 'ca.requisitos', 'ca.portada', 'ca.cargaHoraria', DB::raw("count(mo.carrera_id) as cantidadModulos"))
            ->groupBy('ca.titulo','ca.requisitos', 'ca.portada', 'ca.cargaHoraria','mo.carrera_id')
            ->where('ca.estado', 1)
            ->get();

        if(count($modulosProximos)){
            return response()->json([
                'modulosProximos' => $modulosProximos,
                'carreras' => $carreras,
                'status' => 'ok',
                'mensaje' => 'Obtención de Información existosa'
            ],200);
        }else{
            return response()->json([
            'carreras' => 0,
            'status' => 'bad',
            'mensaje' => 'No hay modulos nuevos disponibles'
            ],200);
        }
    }
}
