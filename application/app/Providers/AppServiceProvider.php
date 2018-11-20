<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

       
            $events->Listen(BuildingMenu::class, function(BuildingMenu $event){
                $event->menu->add('MENU DE NAVEGACION');
                switch (Auth::user()->user_type) {
                    case 'agente':
                        $event->menu->add([
                            'text' => 'dashboard',
                            'url' => 'home',
                            'icon' => 'dashboard'
                        ],[
                            'text' => 'Propiedad',
                            'url'  => 'admin/properties',
                            'icon' => 'home',
                        ]);
                    break;
                    case 'administrador':
                        $event->menu->add([
                            'text'        => 'Dashboard',
                            'url'         => 'home',
                            'icon'        => 'dashboard',
                        ],
                        [
                            'text' => 'Departamentos',
                            'url'  => 'admin/departaments',
                            'icon' => 'map',
                        ],
                        [
                            'text' => 'Ciudades',
                            'url'  => 'admin/cities',
                            'icon' => 'map',
                        ],
                        [
                            'text' => 'Zonas',
                            'url'  => 'admin/zones',
                            'icon' => 'map',
                        ],
                        [
                            'text' => 'Caracteristicas',
                            'url'  => 'admin/features',
                            'icon' => 'list-ol',
                        ],
                        [
                            'text' => 'Amenidades',
                            'url'  => 'admin/amenities',
                            'icon' => 'list-alt',
                        ],
                        [
                            'text' => 'Tipo Propiedad',
                            'url'  => 'admin/property-types',
                            'icon' => 'window-restore',
                        ],
                        [
                            'text' => 'Asesores',
                            'url'  => 'admin/consultants',
                            'icon' => 'users',
                        ],
                        [
                            'text' => 'Gestiones',
                            'url'  => 'admin/managements',
                            'icon' => 'handshake-o',
                        ],
                        [
                            'text' => 'Propiedad',
                            'url'  => 'admin/properties',
                            'icon' => 'home',
                        ],
                        [
                            'text' => 'Usuarios',
                            'url'  => 'admin/users',
                            'icon' => 'user',
                        ]);
                    break;
                }

                

            }); 

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
