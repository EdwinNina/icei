<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use App\Models\AnterioresEstudiantes;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnterioresEstudiantesImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        AnterioresEstudiantes::updateOrCreate([
            'carnet' => mb_strtolower(trim($row['carnet'])),
            'paterno' => mb_strtolower(trim($row['paterno'])),
            'materno' => mb_strtolower(trim($row['materno'])),
            'nombre' => mb_strtolower(trim($row['nombre'])),
            'carrera' => mb_strtolower(trim($row['carrera'])),
            'modulo' => mb_strtolower(trim($row['modulo'])),
            'nota' => mb_strtolower(trim($row['nota'])),
            'docente' => mb_strtolower(trim($row['docente'])),
            'fecha_inicio' => strval(trim($row['fecha_inicio'])),
            'fecha_fin' => strval(trim($row['fecha_fin'])),
        ]);
    }
}
