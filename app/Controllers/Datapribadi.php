<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Datapribadi extends BaseController
{
    private $mcustom;
    private $modul;

    public function __construct() {
        $this->mcustom = new Mcustom();
        $this->modul = new Modul();
    }

    public function index()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $data['idusers'] = $idusers;
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("idjabatan");
            $data['nm_role'] = session()->get("nama_jabatan");
            $data['menu'] = $this->request->getUri()->getSegment(1);

            $def_foto = base_url('images/noimg.jpg');

            $select_users = ['users.*','jabatan.nama_jabatan', 'satker.namasatker', 'pangkat.nama_pangkat', 'korps.nama_korps'];
            $join_users = [
                ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
            ];
            $pro = (object) $this->mcustom->getDynamicData(true, $select_users, 'users', $join_users, ['idusers' => $idusers]);
            if (strlen($pro->foto) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $pro->foto)) {
                    $def_foto = base_url('data-pribadi/showimg/' . esc($pro->foto));
                }
            }
            $data['foto'] = $def_foto;
            $data['head'] = $pro;

            $jml = $this->mcustom->getCount('identitas');
            if ($jml > 0) {
                $tersimpan = (object) $this->mcustom->getDynamicData(true, [], 'identitas');
                $data['appname'] = esc($tersimpan->appname);
                $data['namains'] = esc($tersimpan->namains);
                $deflogo = base_url('images/logo.png');
                if (strlen($tersimpan->logo) > 0) {
                    if (file_exists($this->modul->getPublicPath() . esc($tersimpan->logo))) {
                        $deflogo = base_url($this->modul->getPublicPath().esc($tersimpan->logo));
                    }
                }
                $data['logo'] = $deflogo;
            } else {
                $data['appname'] = "";
                $data['namains'] = "";
                $data['logo'] = base_url('images/logo.png');
            }

            $jml_fak_jur_dosen = $this->mcustom->getCount("dosen_jurusan",[], ['idusers' => $idusers], [], []);
            if($jml_fak_jur_dosen > 0){
                $select_fak_jur = ['dosen_jurusan.*','fakultas.namafakultas', 'jurusan.namajurusan'];
                $join_fak_jur = [
                    ['table' => 'fakultas', 'condition' => 'fakultas.idfakultas = dosen_jurusan.idfakultas', 'type' => 'inner'],
                    ['table' => 'jurusan', 'condition' => 'jurusan.idjurusan = dosen_jurusan.idjurusan', 'type' => 'inner'],
                ];
                $fak_jur_dosen = (object) $this->mcustom->getDynamicData(true, $select_fak_jur, "dosen_jurusan", $join_fak_jur, ['idusers' => $idusers]);
                $data['idfakultas'] = $fak_jur_dosen->idfakultas;
                $data['namafakultas'] = $fak_jur_dosen->namafakultas;
                $data['idjurusan'] = $fak_jur_dosen->idjurusan;
                $data['namajurusan'] = $fak_jur_dosen->namajurusan;
            } else {
                $data['idfakultas'] = "";
                $data['namafakultas'] = "";
                $data['idjurusan'] = "";
                $data['namajurusan'] = "";
            }

            return view('datapribadi/index', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function showimg($filename){
        if (session()->get("logged_dosen")) {
            return $this->modul->serveImage($this->response, $filename);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function prosesprofile() {
        if (session()->get("logged_dosen")) {
            
            $idusers = session()->get("idusers");

            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $pesan = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $jml = $this->mcustom->getCount("users_detil", [], ['idusers' => $idusers]);
                    if($jml > 0){
                        $pesan = $this->ganti_profile_file();
                    } else {
                        $pesan = $this->tambah_profile_file();
                    }
                }
            } else {
                $pesan = $this->proses_profile();
            }
            
            $output = array('status' => $pesan);

            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    private function tambah_profile_file() {
        $idusers = session()->get("idusers");

        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $ukuranFile = $file->getSizeByBinaryUnit();
        $ukuranMB = $ukuranFile / 1048576; // Konversi byte ke MB
        $extFile = $file->getClientExtension();
        $mimeFile = $file->getMimeType();

        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        if($ukuranMB < 3){
            if (in_array($mimeFile, $allowedMimeTypes)) {
                $status_upload = $file->move($this->modul->setPrivatePath(), $fileName);
                if ($status_upload) {

                    $data = array(
                        'nama' => strip_tags($this->request->getPost('nama')),
                        'foto' => $fileName,
                        'updated_at' => $this->modul->TanggalWaktu()
                    );
                    $kond['idusers'] = $idusers;
                    $this->mcustom->ganti("users", $data, $kond);

                    $data1 = array(
                        'idusers_detil' => Uuid::uuid4()->toString(),
                        'nidn' => strip_tags($this->request->getPost('nidn')),
                        'jkel' => strip_tags($this->request->getPost('jkel')),
                        'tmp_lahir' => strip_tags($this->request->getPost('tmplahir')),
                        'tgl_lahir' => strip_tags($this->request->getPost('tgllahir')),
                        'created_at' => $this->modul->TanggalWaktu(),
                        'updated_at' => $this->modul->TanggalWaktu()
                    );
                    $update = $this->mcustom->tambah("users_detil", $data1);
                    if ($update == 1) {
                        $status = "Data tersimpan";
                    } else {
                        $status = "Data gagal tersimpan";
                    }
                } else {
                    $status = "File gagal terupload";
                }
            }else{
                $status = "Hanya diperkenankan file gambar";
            }
        }else{
            $status = "Hanya diperkenankan file dibawah 3 MB.";
        }
        return $status;
    }

    private function ganti_profile_file() {
        $idusers = session()->get("idusers");

        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $ukuranFile = $file->getSizeByBinaryUnit();
        $ukuranMB = $ukuranFile / 1048576; // Konversi byte ke MB
        $extFile = $file->getClientExtension();
        $mimeFile = $file->getMimeType();

        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        if($ukuranMB < 3){
            if (in_array($mimeFile, $allowedMimeTypes)) {
                // hapus file lama
                $lawas = (object)$this->mcustom->getDynamicData(true, ['foto'], 'users', [], ['idusers' => $idusers]);  
                if (strlen($lawas->foto) > 0) {
                    if (file_exists($this->modul->getPrivatePath() . $lawas->foto)) {
                        unlink($this->modul->getPrivatePath() . $lawas->foto);
                    }
                }

                $status_upload = $file->move($this->modul->setPrivatePath(), $fileName);
                if ($status_upload) {

                    $data = array(
                        'nama' => strip_tags($this->request->getPost('nama')),
                        'foto' => $fileName,
                        'updated_at' => $this->modul->TanggalWaktu()
                    );
                    $kond['idusers'] = $idusers;
                    $this->mcustom->ganti("users", $data, $kond);

                    $data1 = array(
                        'nidn' => strip_tags($this->request->getPost('nidn')),
                        'jkel' => strip_tags($this->request->getPost('jkel')),
                        'tmp_lahir' => strip_tags($this->request->getPost('tmplahir')),
                        'tgl_lahir' => strip_tags($this->request->getPost('tgllahir')),
                        'updated_at' => $this->modul->TanggalWaktu()
                    );
                    $kond1['idusers'] = $idusers;
                    $update = $this->mcustom->ganti("users_detil", $data1, $kond1);
                    if ($update == 1) {
                        $status = "Data tersimpan";
                    } else {
                        $status = "Data gagal tersimpan";
                    }
                } else {
                    $status = "File gagal terupload";
                }
            }else{
                $status = "Hanya diperkenankan file gambar";
            }
        }else{
            $status = "Hanya diperkenankan file dibawah 3 MB.";
        }
        return $status;
    }

    private function proses_profile() {
        $idusers = session()->get("idusers");

        $data = array(
            'nama' => strip_tags($this->request->getPost('nama')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idusers'] = $idusers;
        $this->mcustom->ganti("users", $data, $kond);

        $jml = $this->mcustom->getCount("users_detil", [], ['idusers' => $idusers]);
        if($jml > 0){
            $data = array(
                'nidn' => strip_tags($this->request->getPost('nidn')),
                'jkel' => strip_tags($this->request->getPost('jkel')),
                'tmp_lahir' => strip_tags($this->request->getPost('tmplahir')),
                'tgl_lahir' => strip_tags($this->request->getPost('tgllahir')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idusers'] = $idusers;
            $update = $this->mcustom->ganti("users_detil", $data, $kond);
            if ($update == 1) {
                $status = "Data tersimpan";
            } else {
                $status = "Data gagal tersimpan";
            }
        }else{
            $data = array(
                'idusers_detil' => Uuid::uuid4()->toString(),
                'nidn' => strip_tags($this->request->getPost('nidn')),
                'jkel' => strip_tags($this->request->getPost('jkel')),
                'tmp_lahir' => strip_tags($this->request->getPost('tmplahir')),
                'tgl_lahir' => strip_tags($this->request->getPost('tgllahir')),
                'idusers' => $idusers,
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $update = $this->mcustom->tambah("users_detil", $data);
            if ($update == 1) {
                $status = "Data tersimpan";
            } else {
                $status = "Data gagal tersimpan";
            }
        }
        
        return $status;
    }

    public function loadprofile()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $select = ['users_detil.nidn', 'users_detil.jkel', 'users_detil.tmp_lahir', 'users_detil.tgl_lahir', 'date_format(users_detil.tgl_lahir, "%d-%M-%Y") as tglf','users.nama','users.foto'];
            $join = [
                ['table' => 'users_detil', 'condition' => 'users.idusers = users_detil.idusers', 'type' => 'left']
            ];
            $users = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, ['users.idusers' => $idusers]);
            
            $output = array(
                'nidn' => $users->nidn, 
                'jkel' => $users->jkel,
                'tmp_lahir' => $users->tmp_lahir,
                'tgl_lahir' => esc($users->tgl_lahir),
                'tglf' => esc($users->tglf),
                'nama' => esc($users->nama),
                'foto' => base_url('data-pribadi/showimg/' . esc($users->foto))
            );
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function loadpenduduk()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $select = ['kependudukan.*'];
            $join = [
                ['table' => 'kependudukan', 'condition' => 'users.idusers = kependudukan.idusers', 'type' => 'left']
            ];
            $users = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, ['users.idusers' => $idusers]);
            
            $output = array(
                'nik' => esc($users->nik),
                'agama' => esc($users->agama),
                'warganegara' => esc($users->warganegara),
            );
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function prosespenduduk(){
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $jml = $this->mcustom->getCount("kependudukan", [], ['idusers' => $idusers]);
            if($jml > 0){
                $data = array(
                    'nik' => strip_tags($this->request->getPost('nik')),
                    'agama' => strip_tags($this->request->getPost('agama')),
                    'warganegara' => strip_tags($this->request->getPost('kwn')),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $kond['idusers'] = $idusers;
                $simpan = $this->mcustom->ganti("kependudukan", $data, $kond);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            } else {
                $data = array(
                    'idkependudukan' => Uuid::uuid4()->toString(),
                    'nik' => strip_tags($this->request->getPost('nik')),
                    'agama' => strip_tags($this->request->getPost('agama')),
                    'warganegara' => strip_tags($this->request->getPost('kwn')),
                    'idusers' => $idusers,
                    'created_at' => $this->modul->TanggalWaktu(),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $simpan = $this->mcustom->tambah("kependudukan", $data);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            }

            $output = array('status' => $pesan);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function loadkeluarga()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $select = ['keluarga.*'];
            $join = [
                ['table' => 'keluarga', 'condition' => 'users.idusers = keluarga.idusers', 'type' => 'left']
            ];
            $users = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, ['users.idusers' => $idusers]);
            
            $output = array(
                'status_keluarga' => esc($users->status_kawin),
                'nama_suami_istri' => esc($users->nama_suami_istri),
                'nip_suami_istri' => esc($users->nip_suami_istri),
                'pekerjaan_suami_istri' => esc($users->pekerjaan_suami_istri),
            );
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function proseskeluarga(){
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $jml = $this->mcustom->getCount("keluarga", [], ['idusers' => $idusers]);
            if($jml > 0){
                $data = array(
                    'status_kawin' => strip_tags($this->request->getPost('keluarga_status')),
                    'nama_suami_istri' => strip_tags($this->request->getPost('keluarga_suami_istri')),
                    'nip_suami_istri' => strip_tags($this->request->getPost('keluarga_nip')),
                    'pekerjaan_suami_istri' => strip_tags($this->request->getPost('keluarga_pekerjaan')),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $kond['idusers'] = $idusers;
                $simpan = $this->mcustom->ganti("keluarga", $data, $kond);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            } else {
                $data = array(
                    'idkeluarga' => Uuid::uuid4()->toString(),
                    'status_kawin' => strip_tags($this->request->getPost('keluarga_status')),
                    'nama_suami_istri' => strip_tags($this->request->getPost('keluarga_suami_istri')),
                    'nip_suami_istri' => strip_tags($this->request->getPost('keluarga_nip')),
                    'pekerjaan_suami_istri' => strip_tags($this->request->getPost('keluarga_pekerjaan')),
                    'idusers' => $idusers,
                    'created_at' => $this->modul->TanggalWaktu(),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $simpan = $this->mcustom->tambah("keluarga", $data);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            }

            $output = array('status' => $pesan);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function loadkontak()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $select = ['alamat_kontak.*', 'users.email'];
            $join = [
                ['table' => 'alamat_kontak', 'condition' => 'users.idusers = alamat_kontak.idusers', 'type' => 'left']
            ];
            $users = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, ['users.idusers' => $idusers]);
            
            $output = array(
                'email' => esc($users->email),
                'alamat' => esc($users->alamat),
                'rt' => esc($users->rt),
                'rw' => esc($users->rw),
                'kelurahan' => esc($users->kelurahan),
                'kecamatan' => esc($users->kecamatan),
                'kota' => esc($users->kota),
                'provinsi' => esc($users->provinsi),
                'kdpos' => esc($users->kdpos),
                'tlp_rumah' => esc($users->tlp_rumah),
                'tlp_ponsel' => esc($users->tlp_ponsel)
            );
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function proseskontak(){
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $jml = $this->mcustom->getCount("alamat_kontak", [], ['idusers' => $idusers]);
            if($jml > 0){
                $data = array(
                    'alamat' => strip_tags($this->request->getPost('alamat')),
                    'rt' => strip_tags($this->request->getPost('rt')),
                    'rw' => strip_tags($this->request->getPost('rw')),
                    'kelurahan' => strip_tags($this->request->getPost('kelurahan')),
                    'kecamatan' => strip_tags($this->request->getPost('kecamatan')),
                    'kota' => strip_tags($this->request->getPost('kota')),
                    'provinsi' => strip_tags($this->request->getPost('provinsi')),
                    'kdpos' => strip_tags($this->request->getPost('kdpos')),
                    'tlp_rumah' => strip_tags($this->request->getPost('tlp_rumah')),
                    'tlp_ponsel' => strip_tags($this->request->getPost('tlp_ponsel')),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $kond['idusers'] = $idusers;
                $simpan = $this->mcustom->ganti("alamat_kontak", $data, $kond);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            } else {
                $data = array(
                    'idalamat' => Uuid::uuid4()->toString(),
                    'alamat' => strip_tags($this->request->getPost('alamat')),
                    'rt' => strip_tags($this->request->getPost('rt')),
                    'rw' => strip_tags($this->request->getPost('rw')),
                    'kelurahan' => strip_tags($this->request->getPost('kelurahan')),
                    'kecamatan' => strip_tags($this->request->getPost('kecamatan')),
                    'kota' => strip_tags($this->request->getPost('kota')),
                    'provinsi' => strip_tags($this->request->getPost('provinsi')),
                    'kdpos' => strip_tags($this->request->getPost('kdpos')),
                    'tlp_rumah' => strip_tags($this->request->getPost('tlp_rumah')),
                    'tlp_ponsel' => strip_tags($this->request->getPost('tlp_ponsel')),
                    'idusers' => $idusers,
                    'created_at' => $this->modul->TanggalWaktu(),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $simpan = $this->mcustom->tambah("alamat_kontak", $data);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            }

            $output = array('status' => $pesan);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function loadpegawai()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $select = ['kepegawaian.nomor_sk', 'kepegawaian.tmmd', 'date_format(kepegawaian.tmmd, "%d %M %Y") as tglf', 'kepegawaian.sumber_gaji', 'kepegawaian.status_aktif', 'kepegawaian.program_studi'];
            $join = [
                ['table' => 'kepegawaian', 'condition' => 'users.idusers = kepegawaian.idusers', 'type' => 'left']
            ];
            $users = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, ['users.idusers' => $idusers]);
            
            $output = array(
                'nomor_sk' => esc($users->nomor_sk),
                'tmmd' => esc($users->tmmd),
                'tglf' => esc($users->tglf),
                'sumber_gaji' => esc($users->sumber_gaji),
                'status_aktif' => esc($users->status_aktif),
                'program_studi' => esc($users->program_studi)
            );
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function prosespegawai(){
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $jml = $this->mcustom->getCount("kepegawaian", [], ['idusers' => $idusers]);
            if($jml > 0){
                $data = array(
                    'nomor_sk' => strip_tags($this->request->getPost('nomor_sk')),
                    'tmmd' => strip_tags($this->request->getPost('tmmd')),
                    'sumber_gaji' => strip_tags($this->request->getPost('sumber_gaji')),
                    'status_aktif' => strip_tags($this->request->getPost('status_aktif')),
                    'program_studi' => strip_tags($this->request->getPost('program_studi')),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $kond['idusers'] = $idusers;
                $simpan = $this->mcustom->ganti("kepegawaian", $data, $kond);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            } else {
                $data = array(
                    'idkepegawaian' => Uuid::uuid4()->toString(),
                    'nomor_sk' => strip_tags($this->request->getPost('nomor_sk')),
                    'tmmd' => strip_tags($this->request->getPost('tmmd')),
                    'sumber_gaji' => strip_tags($this->request->getPost('sumber_gaji')),
                    'status_aktif' => strip_tags($this->request->getPost('status_aktif')),
                    'program_studi' => strip_tags($this->request->getPost('program_studi')),
                    'idusers' => $idusers,
                    'created_at' => $this->modul->TanggalWaktu(),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $simpan = $this->mcustom->tambah("kepegawaian", $data);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            }

            $output = array('status' => $pesan);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function loadlain()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $select = ['lain_lain.npwp', 'lain_lain.nama_npwp', 'lain_lain.sinta_id'];
            $join = [
                ['table' => 'lain_lain', 'condition' => 'users.idusers = lain_lain.idusers', 'type' => 'left']
            ];
            $users = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, ['users.idusers' => $idusers]);
            
            $output = array(
                'npwp' => esc($users->npwp),
                'nama_npwp' => esc($users->nama_npwp),
                'sinta_id' => esc($users->sinta_id)
            );
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function proseslain(){
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $jml = $this->mcustom->getCount("lain_lain", [], ['idusers' => $idusers]);
            if($jml > 0){
                $data = array(
                    'npwp' => strip_tags($this->request->getPost('npwp')),
                    'nama_npwp' => strip_tags($this->request->getPost('nama_npwp')),
                    'sinta_id' => strip_tags($this->request->getPost('sinta_id')),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $kond['idusers'] = $idusers;
                $simpan = $this->mcustom->ganti("lain_lain", $data, $kond);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            } else {
                $data = array(
                    'idlain' => Uuid::uuid4()->toString(),
                    'npwp' => strip_tags($this->request->getPost('npwp')),
                    'nama_npwp' => strip_tags($this->request->getPost('nama_npwp')),
                    'sinta_id' => strip_tags($this->request->getPost('sinta_id')),
                    'idusers' => $idusers,
                    'created_at' => $this->modul->TanggalWaktu(),
                    'updated_at' => $this->modul->TanggalWaktu()
                );
                $simpan = $this->mcustom->tambah("lain_lain", $data);
                if ($simpan == 1) {
                    $pesan = "Data tersimpan";
                } else {
                    $pesan = "Data gagal tersimpan";
                }
            }

            $output = array('status' => $pesan);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }
}
