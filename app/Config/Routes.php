<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/notifikasi/tidak-masuk/(:num)', 'Notifikasi::dosenTidakMasuk/$1');
$routes->get('/notifikasi/masuk/(:num)', 'Notifikasi::dosenMasuk/$1');