<?php

namespace App\Http\Controllers;

use App\Models\PerfilDocente;
use Illuminate\Http\Request;

class PerfilDocenteController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfil = PerfilDocente::where('docente_id',$id)->first();

        return view('ui.docentes.profile', [ 'perfil' => $perfil ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PerfilDocente $perfil)
    {
        return view('ui.docentes.edit', [ 'perfil' => $perfil ]);
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
        if($request->profesion == ''){
            $request->validate([
                'profesion' => 'required',
                'biografia' => 'required',
                'foto' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
                'curriculum' => 'required|mimes:pdf|max:5000'
            ]);
            $perfil->profesion = $request->profesion;
            $perfil->biografia = $request->biografia;
            $perfil->website = $request->website;

            if($request->hasFile('foto')){
                $path = 'storage/docentesAvatar';
                $photo = $request->file('foto');
                $namePhoto = time() . '.' . $photo->extension();
                $photo->move(public_path($path), $namePhoto);
            }
            $perfil->foto = $namePhoto;

            if($request->hasFile('curriculum')){
                $path = 'storage/docentesCurriculum';
                $file = $request->file('curriculum');
                $nameFile = time() . '.' . $file->extension();
                $file->move(public_path($path), $nameFile);
            }
            $perfil->curriculum = $nameFile;
            $perfil->save();
        }else{
            $perfil->profesion = $request->profesion;
            $perfil->biografia = $request->biografia;
            $perfil->website = $request->website;
            $perfil->save();
        }


        return redirect()->route('docentes.profile.show', 4);
    }
}
