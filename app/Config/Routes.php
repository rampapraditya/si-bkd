<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('/', function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
});

$routes->group('login', function ($routes) {
    $routes->get('', 'Login::index');
    $routes->post('proses', 'Login::proses');
    $routes->get('logout', 'Login::logout');
});

$routes->group('identitas', function ($routes) {
    $routes->get('', 'Identitas::index');
    $routes->post('proses', 'Identitas::proses');
    $routes->get('showimg/(:any)', 'Identitas::showimg/$1');
});

$routes->group('profile', function ($routes) {
    $routes->get('', 'Profile::index');
    $routes->post('proses', 'Profile::proses');
    $routes->get('showimg/(:any)', 'Profile::showimg/$1');
});

$routes->group('ganti-password', function ($routes) {
    $routes->get('', 'Gantipass::index');
    $routes->post('proses', 'Gantipass::proses');
    $routes->get('showimg/(:any)', 'Gantipass::showimg/$1');
});