<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

class Profile extends BaseController
{
    private $mcustom;
    private $modul;

    public function __construct() {
        $this->mcustom = new Mcustom();
        $this->modul = new Modul();
    }

    public function index()
    {
        if (session()->get("logged_admin")) {
            $data['idusers'] = session()->get("idusers");
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("idjabatan");
            $data['nm_role'] = session()->get("nama_jabatan");
            $data['menu'] = $this->request->getUri()->getSegment(1);

            $def_foto = base_url('images/noimg.jpg');
            $pro = (object) $this->mcustom->getDynamicData(true, ['foto'], 'users', [], ['idusers' => $data['idusers']]);
            if (strlen($pro->foto) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $pro->foto)) {
                    $def_foto = base_url('profile/showimg/' . esc($pro->foto));
                }
            }
            $data['foto'] = $def_foto;

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

            $data['satker'] = $this->mcustom->getAll("satker");
            $data['pangkat'] = $this->mcustom->getAll("pangkat");
            $data['korps'] = $this->mcustom->getAll("korps");

            $join = [
                ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
            ];
            $where = ['users.idusers' => session()->get("idusers")];
            $profile = (object) $this->mcustom->getDynamicData(true, ['users.*', 'jabatan.nama_jabatan', 'satker.namasatker', 'pangkat.nama_pangkat', 'korps.nama_korps'], 'users', $join, $where);
            $data['profile'] = $profile;

            return view('profile/index', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function showimg($filename){
        if (session()->get("logged_admin")) {
            return $this->modul->serveImage($this->response, $filename);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function proses() {
        if (session()->get("logged_admin")) {
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $pesan = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $pesan = $this->update_file();
                }
            } else {
                $pesan = $this->update();
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

    private function update_file() {
        $idusers = session()->get("idusers");

        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $ukuranFile = $file->getSizeByBinaryUnit();
        $ukuranMB = $ukuranFile / 1048576; // Konversi byte ke MB
        $extFile = $file->getClientExtension();
        $mimeFile = $file->getMimeType();

        //$allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        //$allowedExtensions = ['jpeg', 'jpg', 'png', 'pdf'];

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
                        'username' => strip_tags($this->request->getPost('username')),
                        'email' => strip_tags($this->request->getPost('email')),
                        'nrp' => strip_tags($this->request->getPost('nrp')),
                        'nama' => strip_tags($this->request->getPost('nama')),
                        'idsatker' => strip_tags($this->request->getPost('satker')),
                        'idpangkat' => strip_tags($this->request->getPost('pangkat')),
                        'idkorps' => strip_tags($this->request->getPost('korps')),
                        'foto' => $fileName,
                        'updated_at' => $this->modul->TanggalWaktu()
                    );
                    $kond['idusers'] = session()->get("idusers");
                    $update = $this->mcustom->ganti("users", $data, $kond);
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

    private function update() {
        $data = array(
            'username' => strip_tags($this->request->getPost('username')),
            'email' => strip_tags($this->request->getPost('email')),
            'nrp' => strip_tags($this->request->getPost('nrp')),
            'nama' => strip_tags($this->request->getPost('nama')),
            'idsatker' => strip_tags($this->request->getPost('satker')),
            'idpangkat' => strip_tags($this->request->getPost('pangkat')),
            'idkorps' => strip_tags($this->request->getPost('korps')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idusers'] = session()->get("idusers");
        $update = $this->mcustom->ganti("users", $data, $kond);
        if ($update == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
}
