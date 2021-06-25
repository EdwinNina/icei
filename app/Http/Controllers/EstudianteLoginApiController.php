<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Servicio;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Models\UsuarioGeneral;
use App\Models\InscripcionTaller;
use Illuminate\Support\Facades\Auth;

class EstudianteLoginApiController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message' => 'Credenciales de autenticacion invalidos'
            ]);
        }
        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function estudianteInfo(Request $request){
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Salida exitosa']);
    }

    public function academico(Request $request){
        $usuario = $request->user();
        $usuario_general = UsuarioGeneral::where('id', $usuario->usuario_general_id)->first();
        $estudiante = Estudiante::where('id', $usuario_general->generable_id)
                        ->where('estado',1)->with(['grado','familiares','notas','notas.planificacionModulo'])->first();
        $inscripciones = Inscripcion::where('estudiante_id', $usuario_general->generable_id)
            ->with(['planificacionCarrera','planificacionCarrera.carrera','modulo','planificacionCarrera.docente',
                'pagosInscripcion','pagosInscripcion.tipoDeRazon','pagosInscripcion.tipoDePago','certificado'])
            ->where('estado',1)
            ->get();
        $servicios = Servicio::where('estudiante_id',$estudiante->id)
            ->with(['categoria','pagosServicios','pagosServicios.tipoDeRazon','pagosServicios.tipoDePago'])
            ->where('estado',1)
            ->get();

        $talleres = InscripcionTaller::where('estudiante_id',$estudiante->id)
            ->with([
                'pagosInscripcionTaller','pagosInscripcionTaller.tipoDeRazon','pagosInscripcionTaller.tipoDePago',
                'planificacionTaller','planificacionTaller.taller'])
                ->where('estado',1)
                ->get();

        if(count($inscripciones)){
            return response()->json([
                'inscripciones' => $inscripciones,
                'estudiante' => $estudiante,
                'servicios' => $servicios,
                'talleres' => $talleres,
                'status' => 'ok',
                'mensaje' => 'Obtención de Información existosa'
            ], 200);
        }else{
            return response()->json([
                'inscripciones' => 0,
                'status' => 'bad',
                'mensaje' => 'Usted no se ha inscrito a ningún curso aún'
            ], 200);
        }
    }

}
