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

$routes->group('privateimg', function ($routes) {
    $routes->get('', 'Privateimg::index');
    $routes->get('showimg/(:any)', 'Privateimg::showimg/$1');
});

$routes->group('inpasing', function ($routes) {
    $routes->get('', 'Inpasing::index');
    $routes->get('ajaxlist', 'Inpasing::ajaxlist');
    $routes->post('ajax_add', 'Inpasing::ajax_add');
    $routes->get('show/(:any)', 'Inpasing::show/$1');
    $routes->post('ajax_edit', 'Inpasing::ajax_edit');
    $routes->get('hapus/(:any)', 'Inpasing::hapus/$1');
});

$routes->group('jab-fungsi-dosen', function ($routes) {
    $routes->get('', 'Jabfungsidosen::index');
    $routes->get('ajaxlist', 'Jabfungsidosen::ajaxlist');
    $routes->post('ajax_add', 'Jabfungsidosen::ajax_add');
    $routes->get('show/(:any)', 'Jabfungsidosen::show/$1');
    $routes->post('ajax_edit', 'Jabfungsidosen::ajax_edit');
    $routes->get('hapus/(:any)', 'Jabfungsidosen::hapus/$1');
});

$routes->group('kepangkatan', function ($routes) {
    $routes->get('', 'Kepangkatan::index');
    $routes->get('ajaxlist', 'Kepangkatan::ajaxlist');
    $routes->post('ajax_add', 'Kepangkatan::ajax_add');
    $routes->get('show/(:any)', 'Kepangkatan::show/$1');
    $routes->post('ajax_edit', 'Kepangkatan::ajax_edit');
    $routes->get('hapus/(:any)', 'Kepangkatan::hapus/$1');
});

$routes->group('penempatan', function ($routes) {
    $routes->get('', 'Penempatan::index');
    $routes->get('ajaxlist', 'Penempatan::ajaxlist');
    $routes->post('ajax_add', 'Penempatan::ajax_add');
    $routes->get('show/(:any)', 'Penempatan::show/$1');
    $routes->post('ajax_edit', 'Penempatan::ajax_edit');
    $routes->get('hapus/(:any)', 'Penempatan::hapus/$1');
});

$routes->group('pend-formal', function ($routes) {
    $routes->get('', 'Pendformal::index');
    $routes->get('ajaxlist', 'Pendformal::ajaxlist');
    $routes->post('ajax_add', 'Pendformal::ajax_add');
    $routes->get('show/(:any)', 'Pendformal::show/$1');
    $routes->post('ajax_edit', 'Pendformal::ajax_edit');
    $routes->get('hapus/(:any)', 'Pendformal::hapus/$1');
});

$routes->group('diklat', function ($routes) {
    $routes->get('', 'Diklat::index');
    $routes->get('ajaxlist', 'Diklat::ajaxlist');
    $routes->post('ajax_add', 'Diklat::ajax_add');
    $routes->get('show/(:any)', 'Diklat::show/$1');
    $routes->post('ajax_edit', 'Diklat::ajax_edit');
    $routes->get('hapus/(:any)', 'Diklat::hapus/$1');
});

$routes->group('riwayat-kerja', function ($routes) {
    $routes->get('', 'Riwayatkerja::index');
    $routes->get('ajaxlist', 'Riwayatkerja::ajaxlist');
    $routes->post('ajax_add', 'Riwayatkerja::ajax_add');
    $routes->get('show/(:any)', 'Riwayatkerja::show/$1');
    $routes->post('ajax_edit', 'Riwayatkerja::ajax_edit');
    $routes->get('hapus/(:any)', 'Riwayatkerja::hapus/$1');
});

$routes->group('pengajaran', function ($routes) {
    $routes->get('', 'Pengajaran::index');
    $routes->get('ajaxlist', 'Pengajaran::ajaxlist');
    $routes->get('ajaxdosen', 'Pengajaran::ajaxdosen');
    $routes->get('ajaxlistadmin/(:any)', 'Pengajaran::ajaxlistadmin/$1');
    $routes->get('aktivitasdosen/(:any)', 'Pengajaran::aktivitasdosen/$1');
    $routes->post('ajax_add', 'Pengajaran::ajax_add');
    $routes->get('show/(:any)', 'Pengajaran::show/$1');
    $routes->post('ajax_edit', 'Pengajaran::ajax_edit');
    $routes->get('hapus/(:any)', 'Pengajaran::hapus/$1');
});

$routes->group('bim-mhs', function ($routes) {
    $routes->get('', 'Bimbinganmhs::index');
    $routes->get('ajaxlist', 'Bimbinganmhs::ajaxlist');
    $routes->get('ajaxdosen', 'Bimbinganmhs::ajaxdosen');
    $routes->get('ajaxlistadmin/(:any)', 'Bimbinganmhs::ajaxlistadmin/$1');
    $routes->get('aktivitasdosen/(:any)', 'Bimbinganmhs::aktivitasdosen/$1');
    $routes->post('ajax_add', 'Bimbinganmhs::ajax_add');
    $routes->get('show/(:any)', 'Bimbinganmhs::show/$1');
    $routes->post('ajax_edit', 'Bimbinganmhs::ajax_edit');
    $routes->get('hapus/(:any)', 'Bimbinganmhs::hapus/$1');
});

$routes->group('pengujian-mhs', function ($routes) {
    $routes->get('', 'Pengujianmhs::index');
    $routes->get('ajaxlist', 'Pengujianmhs::ajaxlist');
    $routes->get('ajaxdosen', 'Pengujianmhs::ajaxdosen');
    $routes->get('ajaxlistadmin/(:any)', 'Pengujianmhs::ajaxlistadmin/$1');
    $routes->get('aktivitasdosen/(:any)', 'Pengujianmhs::aktivitasdosen/$1');
    $routes->post('ajax_add', 'Pengujianmhs::ajax_add');
    $routes->get('show/(:any)', 'Pengujianmhs::show/$1');
    $routes->post('ajax_edit', 'Pengujianmhs::ajax_edit');
    $routes->get('hapus/(:any)', 'Pengujianmhs::hapus/$1');
});

$routes->group('bahan-ajar', function ($routes) {
    $routes->get('', 'Bahanajar::index');
    $routes->get('ajaxlist', 'Bahanajar::ajaxlist');
    $routes->post('ajax_add', 'Bahanajar::ajax_add');
    $routes->get('show/(:any)', 'Bahanajar::show/$1');
    $routes->post('ajax_edit', 'Bahanajar::ajax_edit');
    $routes->get('hapus/(:any)', 'Bahanajar::hapus/$1');
});

$routes->group('pembinaan-mhs', function ($routes) {
    $routes->get('', 'Pembinaanmhs::index');
    $routes->get('ajaxlist', 'Pembinaanmhs::ajaxlist');
    $routes->get('ajaxdosen', 'Pembinaanmhs::ajaxdosen');
    $routes->get('aktivitasdosen/(:any)', 'Pembinaanmhs::aktivitasdosen/$1');
    $routes->get('ajaxlistadmin/(:any)', 'Pembinaanmhs::ajaxlistadmin/$1');
    $routes->post('ajax_add', 'Pembinaanmhs::ajax_add');
    $routes->get('show/(:any)', 'Pembinaanmhs::show/$1');
    $routes->post('ajax_edit', 'Pembinaanmhs::ajax_edit');
    $routes->get('hapus/(:any)', 'Pembinaanmhs::hapus/$1');
});

$routes->group('visit-sci', function ($routes) {
    $routes->get('', 'Visit::index');
    $routes->get('ajaxlist', 'Visit::ajaxlist');
    $routes->post('ajax_add', 'Visit::ajax_add');
    $routes->get('show/(:any)', 'Visit::show/$1');
    $routes->post('ajax_edit', 'Visit::ajax_edit');
    $routes->get('hapus/(:any)', 'Visit::hapus/$1');
});

$routes->group('datasering', function ($routes) {
    $routes->get('', 'Datasering::index');
    $routes->get('ajaxlist', 'Datasering::ajaxlist');
    $routes->post('ajax_add', 'Datasering::ajax_add');
    $routes->get('show/(:any)', 'Datasering::show/$1');
    $routes->post('ajax_edit', 'Datasering::ajax_edit');
    $routes->get('hapus/(:any)', 'Datasering::hapus/$1');
});

$routes->group('orasi', function ($routes) {
    $routes->get('', 'Orasi::index');
    $routes->get('ajaxlist', 'Orasi::ajaxlist');
    $routes->post('ajax_add', 'Orasi::ajax_add');
    $routes->get('show/(:any)', 'Orasi::show/$1');
    $routes->post('ajax_edit', 'Orasi::ajax_edit');
    $routes->get('hapus/(:any)', 'Orasi::hapus/$1');
});

$routes->group('pemb-dosen', function ($routes) {
    $routes->get('', 'Pembdosen::index');
    $routes->get('ajaxlist', 'Pembdosen::ajaxlist');
    $routes->post('ajax_add', 'Pembdosen::ajax_add');
    $routes->get('show/(:any)', 'Pembdosen::show/$1');
    $routes->post('ajax_edit', 'Pembdosen::ajax_edit');
    $routes->get('hapus/(:any)', 'Pembdosen::hapus/$1');
});

$routes->group('tugas-tambahan', function ($routes) {
    $routes->get('', 'Tugastambahan::index');
    $routes->get('ajaxlist', 'Tugastambahan::ajaxlist');
    $routes->post('ajax_add', 'Tugastambahan::ajax_add');
    $routes->get('show/(:any)', 'Tugastambahan::show/$1');
    $routes->post('ajax_edit', 'Tugastambahan::ajax_edit');
    $routes->get('hapus/(:any)', 'Tugastambahan::hapus/$1');
});

$routes->group('anggota-profesi', function ($routes) {
    $routes->get('', 'Anggotaprofesi::index');
    $routes->get('ajaxlist', 'Anggotaprofesi::ajaxlist');
    $routes->post('ajax_add', 'Anggotaprofesi::ajax_add');
    $routes->get('show/(:any)', 'Anggotaprofesi::show/$1');
    $routes->post('ajax_edit', 'Anggotaprofesi::ajax_edit');
    $routes->get('hapus/(:any)', 'Anggotaprofesi::hapus/$1');
});

$routes->group('penghargaan', function ($routes) {
    $routes->get('', 'Penghargaan::index');
    $routes->get('ajaxlist', 'Penghargaan::ajaxlist');
    $routes->post('ajax_add', 'Penghargaan::ajax_add');
    $routes->get('show/(:any)', 'Penghargaan::show/$1');
    $routes->post('ajax_edit', 'Penghargaan::ajax_edit');
    $routes->get('hapus/(:any)', 'Penghargaan::hapus/$1');
});

$routes->group('penunjang-lain', function ($routes) {
    $routes->get('', 'Penunjanglain::index');
    $routes->get('ajaxlist', 'Penunjanglain::ajaxlist');
    $routes->post('ajax_add', 'Penunjanglain::ajax_add');
    $routes->get('show/(:any)', 'Penunjanglain::show/$1');
    $routes->post('ajax_edit', 'Penunjanglain::ajax_edit');
    $routes->get('hapus/(:any)', 'Penunjanglain::hapus/$1');
});

$routes->group('penelitian', function ($routes) {
    $routes->get('', 'Penelitian::index');
    $routes->get('ajaxlist', 'Penelitian::ajaxlist');
    $routes->post('ajax_add', 'Penelitian::ajax_add');
    $routes->get('show/(:any)', 'Penelitian::show/$1');
    $routes->post('ajax_edit', 'Penelitian::ajax_edit');
    $routes->get('hapus/(:any)', 'Penelitian::hapus/$1');
    $routes->get('detil/(:any)', 'Penelitian::detil/$1');
    $routes->get('ajaxdosen/(:any)', 'Penelitian::ajaxdosen/$1');
    $routes->get('ajaxmhs/(:any)', 'Penelitian::ajaxmhs/$1');
    $routes->get('ajaxnoncivitas/(:any)', 'Penelitian::ajaxnoncivitas/$1');
    $routes->post('ajax_add_member', 'Penelitian::ajax_add_member');
    $routes->get('show_member_dosen/(:any)', 'Penelitian::show_member_dosen/$1');
    $routes->get('show_member_mhs/(:any)', 'Penelitian::show_member_mhs/$1');
    $routes->get('show_member_non/(:any)', 'Penelitian::show_member_non/$1');
    $routes->post('ajax_edit_member', 'Penelitian::ajax_edit_member');
    $routes->get('hapusdosen/(:any)', 'Penelitian::hapusdosen/$1');
    $routes->get('hapusmhs/(:any)', 'Penelitian::hapusmhs/$1');
    $routes->get('hapusnon/(:any)', 'Penelitian::hapusnon/$1');
    $routes->get('ajaxdokumen/(:any)', 'Penelitian::ajaxdokumen/$1');
    $routes->post('ajax_add_dokumen', 'Penelitian::ajax_add_dokumen');
    $routes->get('showdokumen/(:any)', 'Penelitian::showdokumen/$1');
    $routes->get('unduh/(:any)', 'Penelitian::unduh/$1');
    $routes->get('hapusdokumen/(:any)', 'Penelitian::hapusdokumen/$1');
    $routes->post('ajax_edit_dokumen', 'Penelitian::ajax_edit_dokumen');
});

$routes->group('publikasi', function ($routes) {
    $routes->get('', 'Publikasi::index');
    $routes->get('ajaxlist', 'Publikasi::ajaxlist');
    $routes->post('ajax_add', 'Publikasi::ajax_add');
    $routes->get('show/(:any)', 'Publikasi::show/$1');
    $routes->post('ajax_edit', 'Publikasi::ajax_edit');
    $routes->get('hapus/(:any)', 'Publikasi::hapus/$1');
    $routes->get('detil/(:any)', 'Publikasi::detil/$1');
    $routes->get('ajaxdosen/(:any)', 'Publikasi::ajaxdosen/$1');
    $routes->get('ajaxmhs/(:any)', 'Publikasi::ajaxmhs/$1');
    $routes->get('ajaxnoncivitas/(:any)', 'Publikasi::ajaxnoncivitas/$1');
    $routes->post('ajax_add_member', 'Publikasi::ajax_add_member');
    $routes->get('show_member_dosen/(:any)', 'Publikasi::show_member_dosen/$1');
    $routes->get('show_member_mhs/(:any)', 'Publikasi::show_member_mhs/$1');
    $routes->get('show_member_non/(:any)', 'Publikasi::show_member_non/$1');
    $routes->post('ajax_edit_member', 'Publikasi::ajax_edit_member');
    $routes->get('hapusdosen/(:any)', 'Publikasi::hapusdosen/$1');
    $routes->get('hapusmhs/(:any)', 'Publikasi::hapusmhs/$1');
    $routes->get('hapusnon/(:any)', 'Publikasi::hapusnon/$1');
    $routes->get('ajaxdokumen/(:any)', 'Publikasi::ajaxdokumen/$1');
    $routes->post('ajax_add_dokumen', 'Publikasi::ajax_add_dokumen');
    $routes->get('showdokumen/(:any)', 'Publikasi::showdokumen/$1');
    $routes->get('unduh/(:any)', 'Publikasi::unduh/$1');
    $routes->get('hapusdokumen/(:any)', 'Publikasi::hapusdokumen/$1');
    $routes->post('ajax_edit_dokumen', 'Publikasi::ajax_edit_dokumen');
});

$routes->group('paten', function ($routes) {
    $routes->get('', 'Paten::index');
    $routes->get('ajaxlist', 'Paten::ajaxlist');
    $routes->post('ajax_add', 'Paten::ajax_add');
    $routes->get('show/(:any)', 'Paten::show/$1');
    $routes->post('ajax_edit', 'Paten::ajax_edit');
    $routes->get('hapus/(:any)', 'Paten::hapus/$1');
    $routes->get('detil/(:any)', 'Paten::detil/$1');
    $routes->get('ajaxdosen/(:any)', 'Paten::ajaxdosen/$1');
    $routes->get('ajaxmhs/(:any)', 'Paten::ajaxmhs/$1');
    $routes->get('ajaxnoncivitas/(:any)', 'Paten::ajaxnoncivitas/$1');
    $routes->post('ajax_add_member', 'Paten::ajax_add_member');
    $routes->get('show_member_dosen/(:any)', 'Paten::show_member_dosen/$1');
    $routes->get('show_member_mhs/(:any)', 'Paten::show_member_mhs/$1');
    $routes->get('show_member_non/(:any)', 'Paten::show_member_non/$1');
    $routes->post('ajax_edit_member', 'Paten::ajax_edit_member');
    $routes->get('hapusdosen/(:any)', 'Paten::hapusdosen/$1');
    $routes->get('hapusmhs/(:any)', 'Paten::hapusmhs/$1');
    $routes->get('hapusnon/(:any)', 'Paten::hapusnon/$1');
    $routes->get('ajaxdokumen/(:any)', 'Paten::ajaxdokumen/$1');
    $routes->post('ajax_add_dokumen', 'Paten::ajax_add_dokumen');
    $routes->get('showdokumen/(:any)', 'Paten::showdokumen/$1');
    $routes->get('unduh/(:any)', 'Paten::unduh/$1');
    $routes->get('hapusdokumen/(:any)', 'Paten::hapusdokumen/$1');
    $routes->post('ajax_edit_dokumen', 'Paten::ajax_edit_dokumen');
});

$routes->group('pengabdian', function ($routes) {
    $routes->get('', 'Pengabdian::index');
    $routes->get('ajaxlist', 'Pengabdian::ajaxlist');
    $routes->post('ajax_add', 'Pengabdian::ajax_add');
    $routes->get('show/(:any)', 'Pengabdian::show/$1');
    $routes->post('ajax_edit', 'Pengabdian::ajax_edit');
    $routes->get('hapus/(:any)', 'Pengabdian::hapus/$1');
    $routes->get('detil/(:any)', 'Pengabdian::detil/$1');
    $routes->get('ajaxdosen/(:any)', 'Pengabdian::ajaxdosen/$1');
    $routes->get('ajaxmhs/(:any)', 'Pengabdian::ajaxmhs/$1');
    $routes->get('ajaxnoncivitas/(:any)', 'Pengabdian::ajaxnoncivitas/$1');
    $routes->post('ajax_add_member', 'Pengabdian::ajax_add_member');
    $routes->get('show_member_dosen/(:any)', 'Pengabdian::show_member_dosen/$1');
    $routes->get('show_member_mhs/(:any)', 'Pengabdian::show_member_mhs/$1');
    $routes->get('show_member_non/(:any)', 'Pengabdian::show_member_non/$1');
    $routes->post('ajax_edit_member', 'Pengabdian::ajax_edit_member');
    $routes->get('hapusdosen/(:any)', 'Pengabdian::hapusdosen/$1');
    $routes->get('hapusmhs/(:any)', 'Pengabdian::hapusmhs/$1');
    $routes->get('hapusnon/(:any)', 'Pengabdian::hapusnon/$1');
    $routes->get('ajaxdokumen/(:any)', 'Pengabdian::ajaxdokumen/$1');
    $routes->post('ajax_add_dokumen', 'Pengabdian::ajax_add_dokumen');
    $routes->get('showdokumen/(:any)', 'Pengabdian::showdokumen/$1');
    $routes->get('unduh/(:any)', 'Pengabdian::unduh/$1');
    $routes->get('hapusdokumen/(:any)', 'Pengabdian::hapusdokumen/$1');
    $routes->post('ajax_edit_dokumen', 'Pengabdian::ajax_edit_dokumen');
});