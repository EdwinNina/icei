<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(['name' => 'Administrador']);
        $coordinador = Role::create(['name' => 'Coordinador']);
        $docente = Role::create(['name' => 'Docente']);
        $estudiante = Role::create(['name' => 'Estudiante']);

        Permission::create(['name' => 'admin.categoria.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.horario.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.estudiante.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.docente.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carrera.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carrera.create'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carrera.edit'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carrera.destroy'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulo.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulo.create'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulo.edit'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulo.destroy'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.tipoPagos.index'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$administrador]);
        Permission::create(['name' => 'docente.perfil.edit'])->syncRoles([$docente]);

    }
}
