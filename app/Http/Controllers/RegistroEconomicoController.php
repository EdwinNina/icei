<?php

namespace App\Http\Controllers;

use App\Models\RegistroEconomico;
use Illuminate\Http\Request;

class RegistroEconomicoController extends Controller
{
    public function anularPago(Request $request){
        $estado = RegistroEconomico::where('id', $request->id)->update([
            'estado' => 0
        ]);
        return response()->json($estado);
    }
}
