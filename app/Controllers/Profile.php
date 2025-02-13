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
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $ukuranFile = $file->getSizeByBinaryUnit();
        $ukuranMB = $ukuranFile / 1048576; // Konversi byte ke MB
        $extFile = $file->getClientExtension();
        $mimeFile = $file->getMimeType();

        //$allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        //$allowedExtensions = ['jpeg', 'jpg', 'png', 'pdf'];

        if($ukuranMB < 1){
            if (in_array($mimeFile, $allowedMimeTypes)) {
                if (file_exists($this->modul->getPublicPath() . '/' . $fileName)) {
                    $status = "Gunakan nama file lain";
                } else {
                    // hapus file lama
                    $lawas = (object)$this->mcustom->getDynamicData(true, ['logo'], 'identitas');
                    if (strlen($lawas->logo) > 0) {
                        if (file_exists($this->modul->getPublicPath() . $lawas->logo)) {
                            unlink($this->modul->getPublicPath() . $lawas->logo);
                        }
                    }

                    $status_upload = $file->move($this->modul->setPublicPath(), $fileName);
                    if ($status_upload) {
                        $data = array(
                            'appname' => strip_tags($this->request->getPost('appname')),
                            'namains' => strip_tags($this->request->getPost('ins')),
                            'slogan' => strip_tags($this->request->getPost('slogan')),
                            'tahun' => strip_tags($this->request->getPost('tahun')),
                            'pimpinan' => strip_tags($this->request->getPost('pimpinan')),
                            'alamat' => strip_tags($this->request->getPost('alamat')),
                            'kdpos' => strip_tags($this->request->getPost('kdpos')),
                            'tlp' => strip_tags($this->request->getPost('tlp')),
                            'website' => strip_tags($this->request->getPost('website')),
                            'email' => strip_tags($this->request->getPost('email')),
                            'logo' => $fileName
                        );
                        $update = $this->mcustom->updateNK("identitas", $data);
                        if ($update == 1) {
                            $status = "Data tersimpan";
                        } else {
                            $status = "Data gagal tersimpan";
                        }
                    } else {
                        $status = "File gagal terupload";
                    }
                }
            }else{
                $status = "Hanya diperkenankan file gambar";
            }
        }else{
            $status = "Hanya diperkenankan file dibawah 1 MB.";
        }
        return $status;
    }

    private function update() {
        $data = array(
            'appname' => strip_tags($this->request->getPost('appname')),
            'namains' => strip_tags($this->request->getPost('ins')),
            'slogan' => strip_tags($this->request->getPost('slogan')),
            'tahun' => strip_tags($this->request->getPost('tahun')),
            'pimpinan' => strip_tags($this->request->getPost('pimpinan')),
            'alamat' => strip_tags($this->request->getPost('alamat')),
            'kdpos' => strip_tags($this->request->getPost('kdpos')),
            'tlp' => strip_tags($this->request->getPost('tlp')),
            'website' => strip_tags($this->request->getPost('website')),
            'email' => strip_tags($this->request->getPost('email'))
        );
        $update = $this->mcustom->updateNK("identitas", $data);
        if ($update == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
}
