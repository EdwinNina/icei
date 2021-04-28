<?php

namespace App\Http\Livewire;

use App\Models\CategoriaServicio;
use Livewire\Component;

class SelectServiciosComponent extends Component
{

    public $categoria_id, $descripcion;

    public function render()
    {
        $categorias = CategoriaServicio::get();
        return view('livewire.select-servicios-component',[
            'categorias' => $categorias
        ]);
    }

    public function updatedCategoriaId($id){
        $categoria = CategoriaServicio::where('id', $id)->first();
        $this->descripcion = $categoria->descripcion;
    }
}
