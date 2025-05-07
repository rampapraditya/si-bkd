<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

class Forgot extends BaseController {

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
        return view('forgot', $data);
    }

    public function proses() {
        clearstatcache();

        $username = strip_tags($this->request->getPost('username'));
        
        $output = array();
        $cek = $this->mcustom->getCount("users", [], ['username' => $username]);
        if($cek > 0){
            $select = ['email', 'pass'];
            $where = ['username' => $username];
            $data = (object) $this->mcustom->getDynamicData(true, $select, "users", [], $where);
            $pass_dekrip = $this->modul->dekrip_pass($data->pass);
            
            $hasil = $this->kirimemail($data->email, "Lupa Password", "Password anda ". $pass_dekrip);
            if($hasil == 1){
                $output['pesan'] = "Password was successfully sent to your email. If you don't find the message please check spam";
            }else{
                $output['pesan'] = "Password gagal dikirim";
            }
        }else{
            $output['pesan'] = "Pengguna tidak ditemukan dalam database";
        }

        return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
    }

    private function kirimemail($to, $subject, $message) {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('mail@sttalinformatika18.com', 'SI-BKD');
        
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            $status = 1;
        } else {
            $status = 0;
        }
        return $status;
    }

}
