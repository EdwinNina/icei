<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Desarrollo Web',
            'slug' => 'desarrollo-web'
        ]);

        Categoria::create([
            'nombre' => 'Desarrollo de aplicaciones moviles',
            'slug' => 'desarrollo-de-aplicaciones-moviles'
        ]);

        Categoria::create([
            'nombre' => 'Administración de bases de datos',
            'slug' => 'administracion-de-bases-de-datos'
        ]);

        Categoria::create([
            'nombre' => 'Ethical hacking',
            'slug' => 'ethical-hacking'
        ]);

        Categoria::create([
            'nombre' => 'Administración de redes',
            'slug' => 'administracion-de-redes'
        ]);

        Categoria::create([
            'nombre' => 'Administración de servidores',
            'slug' => 'administracion-de-servidores'
        ]);

    }
}
