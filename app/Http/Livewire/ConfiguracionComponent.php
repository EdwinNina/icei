<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;

class ConfiguracionComponent extends Component
{
    public $nombre, $direccion, $celular, $telefono, $nota_minima_aprobacion, $director_academico, $pagina_web;

    public function mount(){
        $configuraciones = Configuracion::count();
        if($configuraciones > 0){
            $configuracion = Configuracion::first();
            $this->nombre = Str::title($configuracion->nombre);
            $this->direccion = Str::title($configuracion->direccion);
            $this->celular = $configuracion->celular;
            $this->telefono = $configuracion->telefono;
            $this->pagina_web = $configuracion->pagina_web;
            $this->director_academico = Str::title($configuracion->director_academico);
            $this->nota_minima_aprobacion = $configuracion->nota_minima_aprobacion;
        }
    }

    protected $validationAttributes = [
        'pagina_web' => 'pagina web',
        'nota_minima_aprobacion' => 'nota minima de aprobacion',
    ];

    public function render()
    {
        return view('livewire.configuracion-component');
    }

    public function update(){
        $this->validate();
        DB::table('configuracions')->truncate();
        $configuracion = Configuracion::create([
            'nombre' => mb_strtolower(trim($this->nombre)),
            'direccion' => mb_strtolower(trim($this->direccion)),
            'celular' => trim($this->celular),
            'telefono' => trim($this->telefono),
            'pagina_web' => trim($this->pagina_web),
            'director_academico' => trim($this->director_academico),
            'nota_minima_aprobacion' => trim($this->nota_minima_aprobacion)
        ]);
        if($configuracion){
            $this->emit('messageSuccess');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function rules(){
        return [
            'nombre' => 'required',
            'direccion' => 'required',
            'celular' => 'required|max:8',
            'telefono' => 'required',
            'pagina_web' => 'required|url',
            'director_academico' => 'required',
            'nota_minima_aprobacion' => 'required|min:2'
        ];
    }
}
