<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Models\PerfilDocente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PerfilDocenteController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilDocente $perfil)
    {
        return view('admin.docentes.profile', [ 'perfil' => $perfil ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->id === Auth::user()->id){
            $docente = Docente::where('email', $user->email)->first();
            $perfil = $docente->perfil;
            return view('admin.docentes.edit', [ 'perfil' => $perfil ]);
        }
        abort(403, 'Usted no tiene permiso para acceder a esta pagina');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerfilDocente $perfil)
    {

        if($request->hasFile('foto') || $request->hasFile('curriculum')){

            $perfil->profesion = $request->profesion;
            $perfil->biografia = $request->biografia;
            $perfil->website = $request->website;

            if($request->file('foto')){
                if($request->oldImagen){
                    $pathOld = public_path() . '/storage/docentesAvatar/' . $request->oldImagen;
                    File::delete($pathOld);
                }
                $path = 'storage/docentesAvatar';
                $photo = $request->file('foto');
                $namePhoto = time() . '.' . $photo->extension();
                $photo->move(public_path($path), $namePhoto);
                $perfil->foto = $namePhoto;
            }
            if($request->file('curriculum')){
                if($request->oldCurriculum){
                    $pathOld = public_path() . '/storage/docentesCurriculum/' . $request->oldCurriculum;
                    File::delete($pathOld);
                }
                $path = 'storage/docentesCurriculum';
                $file = $request->file('curriculum');
                $nameFile = time() . '.' . $file->extension();
                $file->move(public_path($path), $nameFile);
                $perfil->curriculum = $nameFile;
            }

            $perfil->save();
        }else{
            $perfil->profesion = $request->profesion;
            $perfil->biografia = $request->biografia;
            $perfil->website = $request->website;
            $perfil->save();
        }

        return redirect()->route('docente.perfil.show', $perfil->id)->with('message', 'Perfil Actualizado');
    }
}
