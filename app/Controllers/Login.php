<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

class Login extends BaseController {

    private $modul;
    private $mcustom;

    public function __construct() {
        $this->mcustom = new Mcustom();
        $this->modul = new Modul();
    }

    public function index() {
        $data = array();
        $jml = $this->mcustom->getCount("identitas");
        if ($jml > 0) {
            $tersimpan = (object)$this->mcustom->getDynamicData(true,[], "identitas");
            $data['appname'] = $tersimpan->appname;
            $data['slogan'] = $tersimpan->slogan;

            $deflogo = base_url('images/logo.png');
            if (strlen($tersimpan->logo) > 0) {
                if (file_exists($this->modul->getPublicPath() . $tersimpan->logo)) {
                    $deflogo = base_url($this->modul->getPublicPath() . $tersimpan->logo);
                }
            }
            $data['logo'] = $deflogo;

        } else {
            $data['appname'] = "";
            $data['slogan'] = "";
            $data['logo'] = base_url('images/logo.png');
        }
        return view('index', $data);
    }

    public function proses() {
        clearstatcache();

        $validation = \Config\Services::validation();

        $username = strip_tags($this->request->getPost('username'));
        $password = strip_tags($this->request->getPost('password'));

        $validation->setRules([
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]',
        ]);

        $output = array();
        if (!$this->validate($validation->getRules())) {
            $output['pesan'] = "Input tidak valid!";
        } else {
            $jml = $this->mcustom->getCount('users', [], ['username' => $username]);
            if ($jml < 1) {
                $output['pesan'] = "Maaf, user tidak ditemukan !";
            }else{
                $password = $this->modul->enkrip_pass($password);
                $jml = $this->mcustom->getCount('users', [], ['username' => $username, 'pass' => $password]);
                if ($jml > 0) {
                    $select = ['users.idusers', 'users.nama', 'users.idjabatan', 'jabatan.nama_jabatan', 'users.email', 
                        'users.idjabatan', 'jabatan.nama_jabatan', 
                        'users.idsatker', 'satker.namasatker', 
                        'users.idpangkat', 'pangkat.nama_pangkat', 
                        'users.idkorps', 'korps.nama_korps'];
                    $join = [
                        ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                        ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                        ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                        ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
                    ];
                    $where = ['users.username' => $username];
                    $data = (object) $this->mcustom->getDynamicData(true, $select, "users", $join, $where);
                    if ($data->nama_jabatan == "ADMINISTRATOR") {
                        // ADMIN
                        session()->set([
                            'idusers' => $data->idusers,
                            'nama' => $data->nama,
                            'idjabatan' => $data->idjabatan,
                            'nama_jabatan' => $data->nama_jabatan,
                            'email' => $data->email,
                            'logged_admin' => TRUE
                        ]);
                        $output['pesan'] = "ok";
                    } else if ($data->nama_jabatan == "DOSEN") {
                        // DOSEN
                        session()->set([
                            'idusers' => $data->idusers,
                            'nama' => $data->nama,
                            'idjabatan' => $data->idjabatan,
                            'nama_jabatan' => $data->nama_jabatan,
                            'email' => $data->email,
                            'logged_dosen' => TRUE
                        ]);
                        $output['pesan'] = "okdosen";
                    }
                } else {
                    $output['pesan'] = "Anda tidak berhak mengakses !";
                }
            }
        }
        return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
    }

    public function logout() {
        session()->destroy();
        clearstatcache();

        $this->modul->halaman('login');
    }

}
