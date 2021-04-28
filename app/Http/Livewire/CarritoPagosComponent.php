<?php

namespace App\Http\Livewire;

use App\Models\TipoPago;
use App\Models\TipoRazon;
use Carbon\Carbon;
use Livewire\Component;

class CarritoPagosComponent extends Component
{
    public $modalFormVisible = false;
    public $totalPagado = 0.0;
    public $costoModulo, $saldo = 0.0, $pagoAnterior;
    public $pagos = [], $tipoPagos = [], $tipoRazones = [];

    public function mount(){
        $this->tipoPagos = TipoPago::get();
        $this->tipoRazones = TipoRazon::get();
        $this->pagos = [
            [
                'tipo_razon_id' => '',
                'tipo_pago_id' => '',
                'concepto' => '',
                'numero_recibo' => '',
                'monto' => '',
                'fecha_pago' => Carbon::now()->format('Y-m-d'),
            ]
        ];
    }

    protected $listeners = ['costoModulo' => 'obtenerCostoModulo'];

    public function render()
    {
        return view('livewire.carrito-pagos-component');
    }

    public function agregarPago(){
        $this->pagos[] = [
            'tipo_razon_id' => '',
            'tipo_pago_id' => '',
            'concepto' => '',
            'numero_recibo' => '',
            'monto' => '',
            'fecha_pago' => Carbon::now()->format('Y-m-d')
        ];
    }

    public function eliminarPago($index){
        unset($this->pagos[$index]);
        $this->pagos = array_values($this->pagos);
    }

    public function obtenerCostoModulo($costo){
        $this->costoModulo = $costo;
    }

    public function mostrarReporte(){
        $this->modalFormVisible = true;
    }

    public function calcularSaldo(){
        $todosLosMontos = array();
        foreach ($this->pagos as $index => $pago) {
            $todosLosMontos[$index] = $pago['monto'];
        }
        $todosLosMontos[count($todosLosMontos)+1] = $this->pagoAnterior;
        $this->totalPagado = array_sum($todosLosMontos);
        if($this->costoModulo >= $this->totalPagado ){
            $calculoSaldo = $this->costoModulo - $this->totalPagado;
            $this->saldo = empty($this->totalPagado) ? 0 : $calculoSaldo;
            $this->emit('montoCorrecto');
        }else{
            $this->emit('errorMonto');
            $this->totalPagado = '0';
            $this->saldo = '0';
        }
    }
}
