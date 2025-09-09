<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('Modules\Anexo24\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');

$routes->get('/', 'Dashboard::index');


if (is_file(ROOTPATH.'Modules/Anexo24/Config/Routes.php')) {
    require ROOTPATH.'Modules/Anexo24/Config/Routes.php';
}