<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class EstudiantesImport implements OnEachRow
{

    public function onRow(Row $row)
    {
        $row      = $row->toArray();
        $estudiante = Estudiante::create([
            'carnet' => $row[0],
            'expedido' => $row[1],
            'paterno' => $row[2],
            'materno' => $row[3],
            'nombre' => $row[4],
            'email' => $row[5],
            'celular' => $row[6],
            'codigo' => $row[7],
        ]);
        $estudiante->grado()->create([
            'estudiante_id' => $estudiante->id,
            'grado' => $row[8],
            'profesion' => $row[9],
            'universidad' => $row[10],
            'carrera' => $row[11],
        ]);
    }
}
