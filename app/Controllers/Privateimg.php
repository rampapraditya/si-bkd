<?php

namespace App\Controllers;

use App\Libraries\Modul;

class Privateimg extends BaseController
{
    private $modul;

    public function __construct() {
        $this->modul = new Modul();
    }

    public function index(){
        echo 'Directory access is forbidden.';
    }

    public function showimg($filename){
        if (session()->get("logged_admin") || session()->get("logged_dosen")) {
            return $this->modul->serveImage($this->response, $filename);
        } else {
            $this->modul->halaman('login');
        }
    }
}
