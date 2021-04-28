<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Certificado;
use Livewire\WithPagination;

class CertificadosEntregadosComponent extends Component
{
    use WithPagination;

    public $search;
    public $fecha_de = '', $fecha_hasta = '';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $entregados = Certificado::filtroFecha($this->fecha_de, $this->fecha_hasta)->where([
            ['impresion','=','1'],
            ['entregado','=','1']
        ])->whereHas('estudiante', function($query){
            $query->where('nombre', 'like', "%{$this->search}%")->orWhere('paterno', 'like', "%{$this->search}%");
        });
        $entregados = $entregados->paginate();
        return view('livewire.certificados-entregados-component', [
            'entregados' => $entregados
        ]);
    }

    public function limpiarFiltro(){
        $this->reset();
    }
}
