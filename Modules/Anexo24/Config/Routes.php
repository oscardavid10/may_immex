<?php
/** @var CodeIgniter\Router\RouteCollection $routes */
$routes->group('anexo24', ['namespace' => 'Modules\Anexo24\Controllers'], static function($routes) {
    // UI
    $routes->get('/', 'Dashboard::index');
    $routes->get('pedimentos', 'Pedimentos::index');
    $routes->get('pedimentos/create', 'Pedimentos::create');
    $routes->post('pedimentos', 'Pedimentos::store');
    $routes->get('pedimentos/(:num)', 'Pedimentos::show/$1');
    $routes->get('pedimentos/(:num)/partidas', 'Pedimentos::partidas/$1');
    $routes->post('pedimentos/(:num)/partidas', 'Pedimentos::storePartida/$1');
    $routes->post('pedimentos/(:num)/lotear', 'Pedimentos::lotear/$1');
    $routes->get('productos', 'Productos::index');
    $routes->get('productos/create', 'Productos::create');
    $routes->post('productos', 'Productos::store');
    $routes->get('productos/(:num)/edit', 'Productos::edit/$1');
    $routes->post('productos/(:num)/update', 'Productos::update/$1');
    $routes->get('bom', 'Bom::index');
    $routes->get('bom/(:num)/edit', 'Bom::edit/$1');
    $routes->post('bom/(:num)/save', 'Bom::save/$1');
    $routes->get('inventario/saldos', 'Inventario::saldos');
    $routes->get('inventario/kardex/(:segment)', 'Inventario::kardex/$1');
    $routes->get('exportaciones', 'Exportaciones::index');
    $routes->get('exportaciones/create', 'Exportaciones::create');
    $routes->post('exportaciones', 'Exportaciones::store');
    $routes->get('exportaciones/(:num)/descargas', 'Exportaciones::descargas/$1');
    $routes->post('exportaciones/(:num)/descargas', 'Exportaciones::storeDescarga/$1');
    $routes->get('alertas', 'Alertas::index');

    // API (JSON) + CORS preflight
    $routes->options('api/(:any)', 'Api::options/$1'); // preflight
    $routes->group('api', static function($routes){
        $routes->get('pedimentos', 'Api::pedimentos');
        $routes->post('pedimentos', 'Api::pedimentosCreate');
        $routes->get('productos', 'Api::productos');
        $routes->post('productos', 'Api::productosCreate');
        $routes->get('inventario/saldos', 'Api::inventarioSaldos');
        $routes->get('inventario/kardex/(:segment)', 'Api::inventarioKardex/$1');
        $routes->get('alertas', 'Api::alertas');
        $routes->get('exportaciones', 'Api::exportaciones');
    });
});
