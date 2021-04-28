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

        Permission::create(['name' => 'admin.dashboard.index','descripcion' => 'ver panel administrativo'])->syncRoles([$administrador,$coordinador]);

        Permission::create(['name' => 'admin.categorias.index','descripcion' => 'ver listado de categorias'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.horarios.index','descripcion' => 'ver listado de horarios'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.estudiantes.index','descripcion' => 'ver listado de estudiantes'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.docentes.index','descripcion' => 'ver listado de docentes'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carreras.index','descripcion' => 'ver listado de carreras'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carreras.create','descripcion' => 'crear carreras'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.carreras.edit','descripcion' => 'editar carreras'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulos.index','descripcion' => 'ver listado de módulos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulos.create','descripcion' => 'crear módulos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.modulos.edit','descripcion' => 'editar módulos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.aulas.index','descripcion' => 'ver listado de aulas'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.inscripciones.index','descripcion' => 'ver listado de inscritos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.inscripciones.create','descripcion' => 'registrar una inscripcion'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.inscripciones.edit','descripcion' => 'editar una inscripcion'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionCarrera.index','descripcion' => 'ver listado de planificaciones por carreras'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionCarrera.create','descripcion' => 'registrar planificación de una carrera'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionCarrera.edit','descripcion' => 'editar planificación de una carrera'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionModulo.create','descripcion' => 'registrar planificación de un modulo'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionModulo.edit','descripcion' => 'editar planificación de un modulo'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.busquedaPorPlanificacion.index','descripcion' => 'ver búsqueda de planificaciones por modulos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.tipoPagos.index','descripcion' => 'ver listado de tipos de pagos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.usuarios.index','descripcion' => 'ver listado de usuarios'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.tipoPlanPagos.index','descripcion' => 'ver listado de tipo de plan de pagos'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.tipoRazon.index','descripcion' => 'ver listado de tipos de razón de pago'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.configuraciones.index','descripcion' => 'ver listado de configuraciones'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.categoriaServiciosVarios.index','descripcion' => 'ver categorias de servicios'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.serviciosVarios.index','descripcion' => 'ver listado de servicios varios'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.index','descripcion' => 'ver listado de roles'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.create','descripcion' => 'crear un rol'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.edit','descripcion' => 'editar un rol'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.registroEconomico.anularPago','descripcion' => 'anular registro de pago'])->syncRoles([$administrador]);

        Permission::create(['name' => 'docente.notas.index','descripcion' => 'ver listado de notas'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.perfil.edit','descripcion' => 'editar perfil de docente'])->syncRoles([$docente]);
        Permission::create(['name' => 'estudiante.kardex.index','descripcion' => 'ver kardex de estudiante'])->syncRoles([$estudiante]);

        Permission::create(['name' => 'admin.talleres.index', 'descripcion' => 'ver modulo de talleres'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionTaller.create', 'descripcion' => 'crear una nueva planificacion de taller'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionTaller.edit', 'descripcion' => 'editar planificacion de taller'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.planificacionTaller.show', 'descripcion' => 'mostrar detalle de la planificacion taller'])->syncRoles([$administrador,$coordinador]);

        Permission::create(['name' => 'admin.inscripcionesTalleres.create', 'descripcion' => 'realizar una inscripcion al taller'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.inscripcionesTalleres.edit', 'descripcion' => 'editar la inscripcion del taller'])->syncRoles([$administrador,$coordinador]);

        Permission::create(['name' => 'admin.certificados.generarCertificado', 'descripcion' => 'generar certificado modular'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.certificados.entregados', 'descripcion' => 'vista para ver certificados modulares entregados'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.certificadosTalleres.entregados', 'descripcion' => 'vista para ver certificados de talleres entregados'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.certificadoFinal.entregados', 'descripcion' => 'vista para ver certificados finales entregados'])->syncRoles([$administrador,$coordinador]);

        Permission::create(['name' => 'admin.certificadoFinal.index', 'descripcion' => 'buscar finalizacion carrera'])->syncRoles([$administrador,$coordinador]);
        Permission::create(['name' => 'admin.certificadoFinal.detalleCertificado', 'descripcion' => 'ver detalle del certificado final'])->syncRoles([$administrador,$coordinador]);

        Permission::create(['name' => 'admin.certificados.solicitados', 'descripcion' => 'vista de certificados modulares solicitados'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.certificadoFinal.solicitados', 'descripcion' => 'vista de certificados finales solicitados'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.certificadosTalleres.solicitados', 'descripcion' => 'vista de certificados de talleres solicitados'])->syncRoles([$administrador]);

    }
}
