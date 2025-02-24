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

$routes->group('jabatan-fungsional', function ($routes) {
    $routes->get('', 'Jabatanfungsi::index');
    $routes->get('showimg/(:any)', 'Jabatanfungsi::showimg/$1');
    $routes->get('ajaxlist', 'Jabatanfungsi::ajaxlist');
    $routes->post('ajax_add', 'Jabatanfungsi::ajax_add');
    $routes->get('show/(:any)', 'Jabatanfungsi::show/$1');
    $routes->post('ajax_edit', 'Jabatanfungsi::ajax_edit');
    $routes->get('hapus/(:any)', 'Jabatanfungsi::hapus/$1');
});

$routes->group('golongan', function ($routes) {
    $routes->get('', 'Golongan::index');
    $routes->get('showimg/(:any)', 'Golongan::showimg/$1');
    $routes->get('ajaxlist', 'Golongan::ajaxlist');
    $routes->post('ajax_add', 'Golongan::ajax_add');
    $routes->get('show/(:any)', 'Golongan::show/$1');
    $routes->post('ajax_edit', 'Golongan::ajax_edit');
    $routes->get('hapus/(:any)', 'Golongan::hapus/$1');
});

$routes->group('fakultas', function ($routes) {
    $routes->get('', 'Fakultas::index');
    $routes->get('showimg/(:any)', 'Fakultas::showimg/$1');
    $routes->get('ajaxlist', 'Fakultas::ajaxlist');
    $routes->post('ajax_add', 'Fakultas::ajax_add');
    $routes->get('show/(:any)', 'Fakultas::show/$1');
    $routes->post('ajax_edit', 'Fakultas::ajax_edit');
    $routes->get('hapus/(:any)', 'Fakultas::hapus/$1');
    
    $routes->get('jurusan/(:any)', 'Fakultas::jurusan/$1');
    $routes->get('ajaxjurusan/(:any)', 'Fakultas::ajaxjurusan/$1');
    $routes->post('ajax_add_jurusan', 'Fakultas::ajax_add_jurusan');
    $routes->get('show_jurusan/(:any)', 'Fakultas::show_jurusan/$1');
    $routes->post('ajax_edit_jurusan', 'Fakultas::ajax_edit_jurusan');
    $routes->get('hapus_jurusan/(:any)', 'Fakultas::hapus_jurusan/$1');
});

$routes->group('pengguna', function ($routes) {
    $routes->get('', 'Pengguna::index');
    $routes->get('showimg/(:any)', 'Pengguna::showimg/$1');
    $routes->get('ajaxlist', 'Pengguna::ajaxlist');
    $routes->post('ajax_add', 'Pengguna::ajax_add');
    $routes->get('show/(:any)', 'Pengguna::show/$1');
    $routes->post('ajax_edit', 'Pengguna::ajax_edit');
    $routes->get('hapus/(:any)', 'Pengguna::hapus/$1');

    $routes->get('detil/(:any)', 'Pengguna::detil/$1');
    $routes->get('ajaxreload/(:any)', 'Pengguna::ajaxreload/$1');
    $routes->get('loadjurusan/(:any)', 'Pengguna::loadjurusan/$1');
    $routes->post('proses_fak_jur', 'Pengguna::proses_fak_jur');
});

$routes->group('data-pribadi', function ($routes) {
    $routes->get('', 'Datapribadi::index');
    $routes->get('showimg/(:any)', 'Datapribadi::showimg/$1');
    $routes->post('prosesprofile', 'Datapribadi::prosesprofile');
    $routes->post('prosespenduduk', 'Datapribadi::prosespenduduk');
    $routes->post('proseskeluarga', 'Datapribadi::proseskeluarga');
    $routes->post('proseskontak', 'Datapribadi::proseskontak');
    $routes->post('prosespegawai', 'Datapribadi::prosespegawai');
    $routes->post('proseslain', 'Datapribadi::proseslain');

    $routes->get('loadprofile', 'Datapribadi::loadprofile');
    $routes->get('loadpenduduk', 'Datapribadi::loadpenduduk');
    $routes->get('loadkeluarga', 'Datapribadi::loadkeluarga');
    $routes->get('loadkontak', 'Datapribadi::loadkontak');
    $routes->get('loadpegawai', 'Datapribadi::loadpegawai');
    $routes->get('loadlain', 'Datapribadi::loadlain');
});

$routes->group('inpasing', function ($routes) {
    $routes->get('', 'Inpasing::index');
    $routes->get('showimg/(:any)', 'Inpasing::showimg/$1');
    $routes->get('ajaxlist', 'Inpasing::ajaxlist');
    $routes->post('ajax_add', 'Inpasing::ajax_add');
    $routes->get('show/(:any)', 'Inpasing::show/$1');
    $routes->post('ajax_edit', 'Inpasing::ajax_edit');
    $routes->get('hapus/(:any)', 'Inpasing::hapus/$1');
});

$routes->group('jab-fungsi-dosen', function ($routes) {
    $routes->get('', 'Jabfungsidosen::index');
    $routes->get('showimg/(:any)', 'Jabfungsidosen::showimg/$1');
    $routes->get('ajaxlist', 'Jabfungsidosen::ajaxlist');
    $routes->post('ajax_add', 'Jabfungsidosen::ajax_add');
    $routes->get('show/(:any)', 'Jabfungsidosen::show/$1');
    $routes->post('ajax_edit', 'Jabfungsidosen::ajax_edit');
    $routes->get('hapus/(:any)', 'Jabfungsidosen::hapus/$1');
});