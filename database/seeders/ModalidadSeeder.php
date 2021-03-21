<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use Illuminate\Database\Seeder;

class ModalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modalidad::create([
            'nombre' => 'Presencial'
        ]);
        Modalidad::create([
            'nombre' => 'Semipresencial'
        ]);
        Modalidad::create([
            'nombre' => 'Virtual'
        ]);
    }
}
