<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

class Gantipass extends BaseController
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
            $pro = (object) $this->mcustom->getDynamicData(true, ['foto', 'username'], 'users', [], ['idusers' => $data['idusers']]);
            if (strlen($pro->foto) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $pro->foto)) {
                    $def_foto = base_url('ganti-password/showimg/' . esc($pro->foto));
                }
            }
            $data['foto'] = $def_foto;
            $data['username'] = $pro->username;

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

            return view('gantipass/index', $data);
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
            $idusers = session()->get("idusers");

            $pro = (object) $this->mcustom->getDynamicData(true, ['pass'], 'users', [], ['idusers' => $idusers]);
            $pass_lama = strip_tags($this->request->getPost('pass_lama'));
            $pass_baru = strip_tags($this->request->getPost('pass_baru'));
            if($pro->pass == $this->modul->enkrip_pass($pass_lama)){
                $data = array(
                    'pass' => $this->modul->enkrip_pass($pass_baru)
                );
                $kond['idusers'] = session()->get("idusers");
                $update = $this->mcustom->ganti("users", $data, $kond);
                if ($update == 1) {
                    $status = "Data tersimpan";
                } else {
                    $status = "Data gagal tersimpan";
                }
            }else{
                $status = "Password lama tidak sesuai";
            }
            
            $output = array('status' => $status);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }
}
