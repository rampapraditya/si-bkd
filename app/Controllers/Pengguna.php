<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Pengguna extends BaseController
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
                    $def_foto = base_url('pengguna/showimg/' . esc($pro->foto));
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

            $data['jabatan'] = $this->mcustom->getDynamicData(false, [], 'jabatan', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            $data['satker'] = $this->mcustom->getDynamicData(false, [], 'satker', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            $data['pangkat'] = $this->mcustom->getDynamicData(false, [], 'pangkat', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            $data['korps'] = $this->mcustom->getDynamicData(false, [], 'korps', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);

            return view('pengguna/index', $data);
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

            $select = ['users.*','jabatan.nama_jabatan', 'satker.namasatker', 'pangkat.nama_pangkat', 'korps.nama_korps'];
            $join = [
                ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
            ];
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, $select, 'users', $join, [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nrp);
                $lengkap = trim(esc($row->nama_pangkat). ' ' .esc($row->nama_korps).' '.esc($row->nama));
                $val[] = $lengkap;
                $val[] = esc($row->nama_jabatan);
                if(strtoupper(esc($row->nama_jabatan)) == "ADMINISTRATOR"){
                    $val[] = '<div style="text-align:center; width:100%;"></div>';
                } else if(strtoupper(esc($row->nama_jabatan)) == "DOSEN"){
                    $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="detil(' . "'" . $this->modul->enkrip_simple($row->idusers) . "'" . ')"><i class="fa fa-fw fa-bars"></i> Detil</button>'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idusers . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idusers . "'" . ',' . "'" . $lengkap . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
                    . '</div></div>';
                } else {
                    $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idusers . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idusers . "'" . ',' . "'" . $lengkap . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
                    . '</div></div>';
                }

                
                
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
                'idusers' => Uuid::uuid4()->toString(),
                'username' => esc($this->request->getPost('username')),
                'email' => esc($this->request->getPost('email')),
                'pass' => $this->modul->enkrip_pass("123"),
                'nrp' => esc($this->request->getPost('nrp')),
                'nama' => esc($this->request->getPost('nama')),
                'foto' => '',
                'idjabatan' => esc($this->request->getPost('jabatan')),
                'idsatker' => esc($this->request->getPost('satker')),
                'idpangkat' => esc($this->request->getPost('pangkat')),
                'idkorps' => esc($this->request->getPost('korps')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("users", $data);
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
            $kond['idusers'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("users", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'username' => esc($this->request->getPost('username')),
                'email' => esc($this->request->getPost('email')),
                'nrp' => esc($this->request->getPost('nrp')),
                'nama' => esc($this->request->getPost('nama')),
                'idjabatan' => esc($this->request->getPost('jabatan')),
                'idsatker' => esc($this->request->getPost('satker')),
                'idpangkat' => esc($this->request->getPost('pangkat')),
                'idkorps' => esc($this->request->getPost('korps')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idusers'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("users", $data, $kond);
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
            $kond['idusers'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("users", $kond);
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

    public function detil()
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
                    $def_foto = base_url('pengguna/showimg/' . esc($pro->foto));
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

            $idusers = $this->modul->dekrip_simple($this->request->getUri()->getSegment(3));
            
            $select_users = ['users.*','jabatan.nama_jabatan', 'satker.namasatker', 'pangkat.nama_pangkat', 'korps.nama_korps'];
            $join_users = [
                ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
            ];
            $head = (object) $this->mcustom->getDynamicData(true, $select_users, 'users', $join_users, ['users.idusers' => $idusers]);
            $data['head'] = $head;

            // mencari fakultas dan jurusan dosen
            $jml_fak_jur_dosen = $this->mcustom->getCount("dosen_jurusan",[], ['idusers' => $head->idusers], [], []);
            if($jml_fak_jur_dosen > 0){
                $select_fak_jur = ['dosen_jurusan.*','fakultas.namafakultas', 'jurusan.namajurusan'];
                $join_fak_jur = [
                    ['table' => 'fakultas', 'condition' => 'fakultas.idfakultas = dosen_jurusan.idfakultas', 'type' => 'inner'],
                    ['table' => 'jurusan', 'condition' => 'jurusan.idjurusan = dosen_jurusan.idjurusan', 'type' => 'inner'],
                ];
                $fak_jur_dosen = (object) $this->mcustom->getDynamicData(true, $select_fak_jur, "dosen_jurusan", $join_fak_jur, ['idusers' => $head->idusers]);
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

            $data['fakultas'] = $this->mcustom->getDynamicData(false, [], "fakultas", [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);

            return view('pengguna/detil', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxreload(){
        if (session()->get("logged_admin")) {
            $iduser = $this->request->getUri()->getSegment(3);

            $jml_fak_jur_dosen = $this->mcustom->getCount("dosen_jurusan",[], ['idusers' => $iduser], [], []);
            if($jml_fak_jur_dosen > 0){
                $select_fak_jur = ['dosen_jurusan.*','fakultas.namafakultas', 'jurusan.namajurusan'];
                $join_fak_jur = [
                    ['table' => 'fakultas', 'condition' => 'fakultas.idfakultas = dosen_jurusan.idfakultas', 'type' => 'inner'],
                    ['table' => 'jurusan', 'condition' => 'jurusan.idjurusan = dosen_jurusan.idjurusan', 'type' => 'inner'],
                ];
                $fak_jur_dosen = (object) $this->mcustom->getDynamicData(true, $select_fak_jur, "dosen_jurusan", $join_fak_jur, ['idusers' => $iduser]);
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

            $output = $data;
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function loadjurusan()
    {
        if (session()->get("logged_admin")) {
            $idfakultas = $this->request->getUri()->getSegment(3);

            $hasil = '<option value="-">- Pilih Jurusan -</option>';
            $list = $this->mcustom->getDynamicData(false, ['idjurusan', 'namajurusan'], "jurusan", [], ['idfakultas' => $idfakultas], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $hasil .= '<option value="'.$row->idjurusan.'">'.$row->namajurusan.'</option>';
            }
            $output = array('hasil' => $hasil);
            return $this->response
                        ->setJSON($output)
                        ->setStatusCode(200)
                        ->setHeader('X-CSRF-TOKEN', csrf_hash());
        } else {
            $this->modul->halaman('login');
        }
    }

    public function proses_fak_jur()
    {
        if (session()->get("logged_admin")) {
            $idusers = $this->request->getPost('idusers');
            $jml = $this->mcustom->getCount("dosen_jurusan", [], ['idusers' => $idusers]);
            if($jml > 0){
                $status = $this->proses_fak_jur_ganti();
            }else{
                $status = $this->proses_fak_jur_tambah();
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

    private function proses_fak_jur_tambah(){
        $data = array(
            'idjurusandosen' => Uuid::uuid4()->toString(),
            'idfakultas' => esc($this->request->getPost('fakultas')),
            'idjurusan' => esc($this->request->getPost('jurusan')),
            'idusers' => esc($this->request->getPost('idusers')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );

        $simpan = $this->mcustom->tambah("dosen_jurusan", $data);
        if ($simpan == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }

    private function proses_fak_jur_ganti(){
        $data = array(
            'idfakultas' => esc($this->request->getPost('fakultas')),
            'idjurusan' => esc($this->request->getPost('jurusan')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idusers'] = esc($this->request->getPost('idusers'));
        $simpan = $this->mcustom->ganti("dosen_jurusan", $data, $kond);
        if ($simpan == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
}
