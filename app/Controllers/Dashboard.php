<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;

class Dashboard extends BaseController
{
    private $mcustom;
    private $modul;

    public function __construct() {
        $this->mcustom = new Mcustom();
        $this->modul = new Modul();
    }

    public function index()
    {
        if (session()->get("logged_admin") || session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $data['idusers'] = $idusers;
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("idjabatan");
            $data['nm_role'] = session()->get("nama_jabatan");
            $data['menu'] = $this->request->getUri()->getSegment(1);

            $def_foto = base_url('images/noimg.jpg');
            $pro = (object) $this->mcustom->getDynamicData(true, ['foto'], 'users', [], ['idusers' => $data['idusers']]);
            if (strlen($pro->foto) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $pro->foto)) {
                    $def_foto = base_url('dashboard/showimg/' . esc($pro->foto));
                }
            }
            $data['foto'] = $def_foto;

            $jml = $this->mcustom->getCount('identitas');
            if ($jml > 0) {
                $tersimpan = (object) $this->mcustom->getDynamicData(true, [], 'identitas');
                $data['appname'] = esc($tersimpan->appname);
                $data['namains'] = esc($tersimpan->namains);
                $data['slogan'] = esc($tersimpan->slogan);
                $data['alamat'] = esc($tersimpan->alamat);
                $data['email'] = esc($tersimpan->email);
                $data['website'] = esc($tersimpan->website);
                $data['tlp'] = esc($tersimpan->tlp);

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
                $data['slogan'] = "";
                $data['alamat'] = "";
                $data['email'] = "";
                $data['website'] = "";
                $data['tlp'] = "";
                $data['logo'] = base_url('images/logo.png');
            }

            if (session()->get("logged_admin")) {
                return view('dashboard/index', $data);
            } else if (session()->get("logged_dosen")) {

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

                return view('dashboard/dashdosen', $data);
            }
            
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
}
