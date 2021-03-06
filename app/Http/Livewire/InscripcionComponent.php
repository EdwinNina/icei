<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inscripcion;

class InscripcionComponent extends Component
{

    public $search;

    public function render()
    {
        $inscripciones = Inscripcion::paginate('10');

        return view('livewire.inscripcion-component', [ 'inscripciones' => $inscripciones ]);
    }

}
