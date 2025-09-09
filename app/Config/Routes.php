<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('Modules\Anexo24\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');

$routes->get('/', 'Dashboard::index');


$routes->get('login', '\App\Controllers\Auth::login');
$routes->post('login', '\App\Controllers\Auth::login');
$routes->get('logout', '\App\Controllers\Auth::logout');

$routes->group('admin', ['namespace' => 'App\\Controllers', 'filter' => 'auth:admin'], static function ($routes) {
    $routes->get('/', 'Home::admin');
});


if (is_file(ROOTPATH.'Modules/Anexo24/Config/Routes.php')) {
    require ROOTPATH.'Modules/Anexo24/Config/Routes.php';
}