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
                    $def_foto = base_url('datapribadi/showimg/' . esc($pro->foto));
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
        if (session()->get("logged_admin")) {
            return $this->modul->serveImage($this->response, $filename);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist()
    {
        if (session()->get("logged_admin")) {
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, [], 'fakultas', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->namafakultas);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="detil(' . "'" . $this->modul->enkrip_simple($row->idfakultas) . "'" . ')"><i class="fa fa-fw fa-bars"></i> Detil</button>'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idfakultas . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idfakultas . "'" . ',' . "'" . $row->namafakultas . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
                    . '</div></div>';
                $data[] = $val;

                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_add()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'idfakultas' => Uuid::uuid4()->toString(),
                'namafakultas' => esc($this->request->getPost('nama')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("fakultas", $data);
            if ($simpan == 1) {
                $status = "Data tersimpan";
            } else {
                $status = "Data gagal tersimpan";
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

    public function show()
    {
        if (session()->get("logged_admin")) {
            $kond['idfakultas'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("fakultas", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'namafakultas' => esc($this->request->getPost('nama')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idfakultas'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("fakultas", $data, $kond);
            if ($simpan == 1) {
                $status = "Data terupdate";
            } else {
                $status = "Data gagal terupdate";
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

    public function hapus()
    {
        if (session()->get("logged_admin")) {
            $kond['idfakultas'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("fakultas", $kond);
            if ($hapus == 1) {
                $status = "Data terhapus";
            } else {
                $status = "Data gagal terhapus";
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

    public function jurusan()
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
                    $def_foto = base_url('fakultas/showimg/' . esc($pro->foto));
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

            $idfakultas = $this->modul->dekrip_simple($this->request->getUri()->getSegment(3));
            $data['head'] = $this->mcustom->getDynamicData(true, ['idfakultas', 'namafakultas'], "fakultas", [], ['idfakultas' => $idfakultas]);


            return view('fakultas/jurusan', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxjurusan()
    {
        if (session()->get("logged_admin")) {
            $idfakultas = $this->request->getUri()->getSegment(3);
            // load data
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, [], 'jurusan', [], ['idfakultas' => $idfakultas], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->namajurusan);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idjurusan . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idjurusan . "'" . ',' . "'" . $row->namajurusan . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
                    . '</div></div>';
                $data[] = $val;

                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_add_jurusan()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'idjurusan' => Uuid::uuid4()->toString(),
                'namajurusan' => esc($this->request->getPost('nama')),
                'idfakultas' => esc($this->request->getPost('idfakultas')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("jurusan", $data);
            if ($simpan == 1) {
                $status = "Data tersimpan";
            } else {
                $status = "Data gagal tersimpan";
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

    public function show_jurusan()
    {
        if (session()->get("logged_admin")) {
            $kond['idjurusan'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("jurusan", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit_jurusan()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'namajurusan' => esc($this->request->getPost('nama')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idjurusan'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("jurusan", $data, $kond);
            if ($simpan == 1) {
                $status = "Data terupdate";
            } else {
                $status = "Data gagal terupdate";
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

    public function hapus_jurusan()
    {
        if (session()->get("logged_admin")) {
            $kond['idjurusan'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("jurusan", $kond);
            if ($hapus == 1) {
                $status = "Data terhapus";
            } else {
                $status = "Data gagal terhapus";
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
