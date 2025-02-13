<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/showimg/(:any)', 'Dashboard::showimg/$1');

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

$routes->group('korps', function ($routes) {
    $routes->get('', 'Korps::index');
    $routes->get('showimg/(:any)', 'Korps::showimg/$1');
    $routes->get('ajaxlist', 'Korps::ajaxlist');
    $routes->post('ajax_add', 'Korps::ajax_add');
    $routes->get('show/(:any)', 'Korps::show/$1');
    $routes->post('ajax_edit', 'Korps::ajax_edit');
    $routes->get('hapus/(:any)', 'Korps::hapus/$1');
});

$routes->group('pangkat', function ($routes) {
    $routes->get('', 'Pangkat::index');
    $routes->get('showimg/(:any)', 'Pangkat::showimg/$1');
    $routes->get('ajaxlist', 'Pangkat::ajaxlist');
    $routes->post('ajax_add', 'Pangkat::ajax_add');
    $routes->get('show/(:any)', 'Pangkat::show/$1');
    $routes->post('ajax_edit', 'Pangkat::ajax_edit');
    $routes->get('hapus/(:any)', 'Pangkat::hapus/$1');
});

$routes->group('satker', function ($routes) {
    $routes->get('', 'Satker::index');
    $routes->get('showimg/(:any)', 'Satker::showimg/$1');
    $routes->get('ajaxlist', 'Satker::ajaxlist');
    $routes->post('ajax_add', 'Satker::ajax_add');
    $routes->get('show/(:any)', 'Satker::show/$1');
    $routes->post('ajax_edit', 'Satker::ajax_edit');
    $routes->get('hapus/(:any)', 'Satker::hapus/$1');
});

$routes->group('jabatan', function ($routes) {
    $routes->get('', 'Jabatan::index');
    $routes->get('showimg/(:any)', 'Jabatan::showimg/$1');
    $routes->get('ajaxlist', 'Jabatan::ajaxlist');
    $routes->post('ajax_add', 'Jabatan::ajax_add');
    $routes->get('show/(:any)', 'Jabatan::show/$1');
    $routes->post('ajax_edit', 'Jabatan::ajax_edit');
    $routes->get('hapus/(:any)', 'Jabatan::hapus/$1');
});

$routes->group('pengguna', function ($routes) {
    $routes->get('', 'Pengguna::index');
    $routes->get('showimg/(:any)', 'Pengguna::showimg/$1');
    $routes->get('ajaxlist', 'Pengguna::ajaxlist');
    $routes->post('ajax_add', 'Pengguna::ajax_add');
    $routes->get('show/(:any)', 'Pengguna::show/$1');
    $routes->post('ajax_edit', 'Pengguna::ajax_edit');
    $routes->get('hapus/(:any)', 'Pengguna::hapus/$1');
});