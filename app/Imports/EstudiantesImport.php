<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Str;
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
                'carnet' => trim($row['carnet']),
                'expedido' => trim($row['expedido']),
                'paterno' => mb_strtolower(trim($row['paterno'])),
                'materno' => mb_strtolower(trim($row['materno'])),
                'nombre' => mb_strtolower(trim($row['nombre'])),
                'email' => trim($row['email']),
                'celular' => trim($row['celular']),
                'codigo' => empty($row['codigo'])
                    ? trim(Str::substr($row['paterno'], 0, 1)) .''. trim(Str::substr($row['materno'], 0, 1)) .''. trim(Str::substr($row['nombre'], 0, 1)) .''. trim($row['carnet'])
                    : $row['codigo'],
            ]);
            $estudiante->grado()->updateOrCreate([
                'estudiante_id' => $estudiante->id,
                'grado' => trim($row['grado']),
                'profesion' => mb_strtolower(trim($row['profesion'])),
                'universidad' => mb_strtolower(trim($row['universidad'])),
                'carrera' => mb_strtolower(trim($row['carrera'])),
            ]);

            $estudiante->familiares()->updateOrCreate([
                'estudiante_id' => $estudiante->id,
                'nombre'  => mb_strtolower(trim($row['nombre_familiar'])),
                'paterno' => mb_strtolower(trim($row['paterno_familiar'])),
                'materno' => mb_strtolower(trim($row['materno_familiar'])),
                'celular' => trim($row['celular_familiar']),
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
