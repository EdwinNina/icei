<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\TipoPago;
use App\Models\TipoRazon;
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

        TipoPago::create([
            'nombre' => 'efectivo',
            'descripcion' => 'Pago realizado en la institucion',
        ]);

        TipoPago::create([
            'nombre' => 'transaccion bancaria',
            'descripcion' => 'Pago realizado en una entidad financiera',
        ]);

        TipoRazon::create([
            'nombre' => 'inscripcion',
            'descripcion' => 'Pago por inscripcion a un modulo',
        ]);

        TipoRazon::create([
            'nombre' => 'examen 2t',
            'descripcion' => 'Pago para el examen de segundo turno',
        ]);
        TipoRazon::create([
            'nombre' => 'certificado',
            'descripcion' => 'Pago para obtencion de certificado',
        ]);
        TipoRazon::create([
            'nombre' => 'taller',
            'descripcion' => 'Pago para taller de capacitacion',
        ]);
        TipoRazon::create([
            'nombre' => 'servicios varios',
            'descripcion' => 'Pago por un servicio',
        ]);
    }
}
