<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Row;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EstudiantesImport implements OnEachRow, WithValidation, WithHeadingRow
{

    public function onRow(Row $row)
    {
        try {
            DB::beginTransaction();
            $row = $row->toArray();
            $estudiante = Estudiante::updateOrCreate([
                'carnet' => $row['carnet'],
                'expedido' => $row['expedido'],
                'paterno' => $row['paterno'],
                'materno' => $row['materno'],
                'nombre' => $row['nombre'],
                'email' => $row['email'],
                'celular' => $row['celular'],
                'codigo' => $row['codigo'],
            ]);
            $estudiante->grado()->updateOrCreate([
                'estudiante_id' => $estudiante->id,
                'grado' => $row['grado'],
                'profesion' => $row['profesion'],
                'universidad' => $row['universidad'],
                'carrera' => $row['carrera'],
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function  rules(): array {
        return [
            'carnet' => Rule::unique('estudiantes','carnet')
        ];
    }

    public function customValidationMessages()
    {
        return [
            'carnet.unique' => 'No puedes importar información duplicada de cedulas de identidad al sistema',
        ];
    }
}
