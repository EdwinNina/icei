<?php

use Illuminate\Support\Facades\Auth;

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b>ICEI</b>TECH',
    'logo_img' => 'images/logo2.svg',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'ICEI TECH',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => false,
    'right_sidebar_push' => false,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [

        [
            'text' => 'Panel Administrativo',
            'route'  => 'admin.dashboard.index',
            'can'  => 'admin.dashboard.index',
            'icon' => 'fas fa-fw fa-chart-line'
        ],
        [
            'header' => 'Administración de Carrera',
            'can' => 'admin.categorias.index'
        ],
        [
            'text' => 'Categorías',
            'route'  => 'admin.categorias.index',
            'can' => 'admin.categorias.index'
        ],
        [
            'text' => 'Horarios',
            'route'  => 'admin.horarios.index',
            'can' => 'admin.horarios.index'
        ],
        [
            'text' => 'Carreras',
            'route'  => 'admin.carreras.index',
            'can' => 'admin.carreras.index'
        ],
        [
            'text' => 'Módulos',
            'route'  => 'admin.modulos.index',
            'can' => 'admin.modulos.index'
        ],
        [
            'text' => 'Aulas',
            'route'  => 'admin.aulas.index',
            'can'  => 'admin.aulas.index',
        ],
        ['header' => 'Administración Académica'],
        [
            'text' => 'Historial Académico',
            'route'  => 'estudiante.kardex.academico',
            'icon' => 'fas fa-fw fa-id-card',
            'can'  => 'estudiante.kardex.academico',
        ],
        [
            'text' => 'Historial Económico',
            'route'  => 'estudiante.kardex.economico',
            'can'  => 'estudiante.kardex.economico',
            'icon' => 'fas fa-fw fa-money-bill-alt',
        ],
        [
            'text' => 'Estudiantes',
            'route'  => 'admin.estudiantes.index',
            'icon' => 'fa fa-users',
            'can' => 'admin.estudiantes.index'
        ],
        [
            'text' => 'Docentes',
            'route'  => 'admin.docentes.index',
            'icon' => 'fa fa-users',
            'can' => 'admin.docentes.index'
        ],
        [
            'text' => 'Inscripciones',
            'route'  => 'admin.inscripciones.index',
            'icon' => 'fas fa-address-card',
            'can'  => 'admin.inscripciones.index',
        ],
        [
            'text' => 'Planificación de Carreras',
            'route'  => 'admin.planificacionCarrera.index',
            'icon' => 'fa fa-calendar',
            'can'  => 'admin.planificacionCarrera.index',
        ],
        [
            'text' => 'Búsqueda Planificación',
            'route'  => 'docente.notas.index',
            'icon' => ' fas fa-search',
            'can'  => 'docente.notas.index',
        ],
        [
            'text' => 'Búsqueda Planificación',
            'route'  => 'admin.busquedaPorPlanificacion.index',
            'icon' => 'fas fa-fw fa-search',
            'can'  => 'admin.busquedaPorPlanificacion.index',
        ],
        [
            'text'    => 'Certificados',
            'icon'    => 'fas fa-file-pdf',
            'can'  => 'admin.certificadoFinal.index',
            'submenu' => [
                [
                    'text'    => 'Carrera Finalizada',
                    'submenu' => [
                        [
                            'text' => 'Búsqueda Certificado Final',
                            'route'  => 'admin.certificadoFinal.index',
                            'icon' => 'fas fa-fw fa-search',
                        ],
                        [
                            'text' => 'Solicitados',
                            'route'  => 'admin.certificadoFinal.solicitados',
                            'can'  => 'admin.certificadoFinal.solicitados',
                            'icon' => 'fas fa-hourglass-half'
                        ],
                        [
                            'text' => 'Entregados',
                            'route'  => 'admin.certificadoFinal.entregados',
                            'icon' => 'fas fa-smile'
                        ],
                    ],
                ],
                [
                    'text'    => 'Módulos',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Solicitados',
                            'route'  => 'admin.certificados.solicitados',
                            'can'  => 'admin.certificados.solicitados',
                            'icon' => 'fas fa-hourglass-half'
                        ],
                        [
                            'text' => 'Entregados',
                            'route'  => 'admin.certificados.entregados',
                            'icon' => 'fas fa-smile'
                        ],
                    ],
                ],
                [
                    'text'    => 'Talleres',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Solicitados',
                            'route'  => 'admin.certificadosTalleres.solicitados',
                            'can'  => 'admin.certificadosTalleres.solicitados',
                            'icon' => 'fas fa-hourglass-half'
                        ],
                        [
                            'text' => 'Entregados',
                            'route'  => 'admin.certificadosTalleres.entregados',
                            'icon' => 'fas fa-smile'
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Anteriores Estudiantes',
            'route'  => 'admin.anterioresEstudiantes.index',
            'can'  => 'admin.anterioresEstudiantes.index',
            'icon' => 'fa fa-users',
        ],
        [
            'text'    => 'Módulo Talleres',
            'can'  => 'admin.talleres.index',
            'submenu' => [
                [
                    'text' => 'Talleres',
                    'route'  => 'admin.talleres.index',
                    'icon' => 'fas fa-fw fa-search',
                ],
                [
                    'text' => 'Planificación',
                    'route'  => 'admin.planificacionTaller.index',
                    'icon' => 'fa fa-calendar',
                ],
                [
                    'text' => 'Inscripción',
                    'route'  => 'admin.inscripcionesTalleres.index',
                    'icon' => 'fas fa-address-card',
                ],
            ],
        ],
        [
            'header' => 'Administración Económica',
            'can' => 'admin.tipoPagos.index'
        ],
        [
            'text' => 'Tipo de pagos',
            'route'  => 'admin.tipoPagos.index',
            'icon' => 'fas fa-money-bill-alt',
            'can'  => 'admin.tipoPagos.index',
        ],
        [
            'text' => 'Tipo de razón',
            'route'  => 'admin.tipoRazon.index',
            'can'  => 'admin.tipoRazon.index',
        ],
        [
            'text' => 'Tipo de Plan de Pagos',
            'route'  => 'admin.tipoPlanPagos.index',
            'can'  => 'admin.tipoPlanPagos.index',
        ],
        [
            'header' => 'Otros servicios',
            'can' => 'admin.categoriaServiciosVarios.index'
        ],
        [
            'text' => 'Categoría Servicios',
            'route'  => 'admin.categoriaServiciosVarios.index',
            'can'  => 'admin.categoriaServiciosVarios.index',
        ],
        [
            'text' => 'Servicios Varios',
            'route'  => 'admin.serviciosVarios.index',
            'icon' => 'fa fa-suitcase',
            'can'  => 'admin.serviciosVarios.index',
        ],
        [
            'header' => 'Administración de la Empresa',
            'can' => 'admin.configuraciones.index'
        ],
        [
            'text' => 'Configuraciones',
            'route'  => 'admin.configuraciones.index',
            'icon' => 'fa fa-cogs',
            'can'  => 'admin.configuraciones.index',
        ],
        [
            'header' => 'Administración de Usuarios',
            'can' => 'admin.usuarios.index'
        ],
        [
            'text' => 'Usuarios',
            'route'  => 'admin.usuarios.index',
            'icon' => 'fas fa-fw fa-users',
            'can' => 'admin.usuarios.index',
        ],
        [
            'text' => 'Roles',
            'route'  => 'admin.roles.index',
            'icon' => 'fas fa-fw fa-users',
            'can' => 'admin.roles.index',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => true,
];
