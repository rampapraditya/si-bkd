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
}
