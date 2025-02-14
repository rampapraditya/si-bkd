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
                if(strtolower(esc($row->username)) == "admin"){
                    $val[] = '<div style="text-align:center; width:100%;"></div>';
                }else{
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
}
