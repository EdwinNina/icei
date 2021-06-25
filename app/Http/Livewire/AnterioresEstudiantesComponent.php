<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\AnterioresEstudiantes;
use App\Imports\AnterioresEstudiantesImport;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Validators\ValidationException;

class AnterioresEstudiantesComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $modalFormVisible = false;
    public $nombreBotonCarga = 'Subir', $excel;
    public $searchPaterno, $searchMaterno, $searchNombre;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->reset();
    }

    public function render()
    {
        $estudiantes = AnterioresEstudiantes::where([
            ['paterno', 'like', '%'.$this->searchPaterno.'%'],
            ['materno', 'like', '%'.$this->searchMaterno.'%'],
            ['nombre', 'like', '%'.$this->searchNombre.'%'],
        ])->paginate();
        return view('livewire.anteriores-estudiantes-component',[
            'estudiantes' => $estudiantes
        ]);
    }

    public function import(){

        try {
            $this->validate([
                'excel' => 'required|file|mimes:xlsx,xlsm,xlsb,xltx'
            ]);
            $this->nombreBotonCarga = 'Subiendo...';
            Excel::import(new AnterioresEstudiantesImport, $this->excel);
            $this->modalFormVisible = false;
            $this->nombreBotonCarga = 'Subir';
            $this->emit('messageSuccess');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            session()->flash('failures', $failures);
            return redirect()->route('admin.anterioresEstudiantes.index');
        }
    }
}
