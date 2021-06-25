<?php

namespace App\Http\Livewire;

use App\Models\CertificadoTaller;
use Livewire\Component;
use Livewire\WithPagination;

class CertificadosTallerEntregadosComponent extends Component
{
    use WithPagination;

    public $search;
    public $fecha_de = '', $fecha_hasta = '';
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $entregados = CertificadoTaller::filtroFecha($this->fecha_de, $this->fecha_hasta)->where([
            ['impresion','=','1'],
            ['entregado','=','1']
        ])->whereHas('estudiante', function($query){
            $query->where('nombre', 'like', "%{$this->search}%")->orWhere('paterno', 'like', "%{$this->search}%");
        });

        $entregados = $entregados->paginate();
        return view('livewire.certificados-taller-entregados-component',[
            'entregados' => $entregados
        ]);
    }

 public function limpiarFiltro(){
        $this->reset();
    }
}
