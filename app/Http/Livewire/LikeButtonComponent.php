<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeButtonComponent extends Component
{

    public $carrera, $usuario;

    public function render()
    {
        return view('livewire.like-button-component');
    }

    public function likeToggle(){
        $this->usuario = Auth::user()->usuarioGeneral->generable_id;
    }
}
