<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Pengabdian extends BaseController
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
            $data['idusers'] = session()->get("idusers");
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("idjabatan");
            $data['nm_role'] = session()->get("nama_jabatan");
            $data['menu'] = $this->request->getUri()->getSegment(1);

            $def_foto = base_url('images/noimg.jpg');

            $pro = (object) $this->mcustom->getDynamicData(true, ['foto'], 'users', [], ['idusers' => $data['idusers']]);
            if (strlen($pro->foto) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $pro->foto)) {
                    $def_foto = base_url('privateimg/showimg/' . esc($pro->foto));
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
            $data['tahun'] = $this->modul->getTahun();
            $data['curdate'] = $this->modul->TanggalSekarang();

            return view('pengabdian/index', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist()
    {
        if (session()->get("logged_admin") || session()->get("logged_dosen")) {
            
            if (session()->get("logged_dosen")) {
                $idusers = session()->get("idusers");
                $list = $this->mcustom->getDynamicData(false, ['*'], 'pengabdian', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);

            } else if (session()->get("logged_admin")) {
                $select = ['pengabdian.*','users.nama'];
                $join = [
                    ['table' => 'users', 'condition' => 'pengabdian.idusers = users.idusers', 'type' => 'inner']
                ];
                $list = $this->mcustom->getDynamicData(false, $select, 'pengabdian', $join, [], [], [], [], [], null, null, ['pengabdian.created_at' => 'ASC']);
            }
            
            $data = array();
            $no = 1;
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                if (session()->get("logged_admin")) {
                    $val[] = esc($row->nama);
                }
                $val[] = esc($row->judul);
                $val[] = esc($row->tahun);
                $val[] = esc($row->lama);
                if (session()->get("logged_admin")) {
                    $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpengabdian . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
                    . '</div></div>';
                } else {
                    $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="detil(' . "'" . $this->modul->enkrip_simple($row->idpengabdian) . "'" . ')"><i class="fa fa-fw fa-check"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpengabdian . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpengabdian . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $data = array(
                'idpengabdian' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'tahun' => esc($this->request->getPost('tahun')),
                'afiliasi' => esc($this->request->getPost('afiliasi')),
                'sk_penugasan' => esc($this->request->getPost('sk')),
                'tgl_penugasan' => esc($this->request->getPost('tanggal')),
                'lama' => esc($this->request->getPost('lama')),
                'judul' => esc($this->request->getPost('judul')),
                'lokasi' => esc($this->request->getPost('lokasi')),
                'dana_dikti' => esc($this->request->getPost('dana_dikti')),
                'dana_pt' => esc($this->request->getPost('dana_univ')),
                'dana_lain' => esc($this->request->getPost('dana_lain')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("pengabdian", $data);
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
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pengabdian", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'tahun' => esc($this->request->getPost('tahun')),
                'afiliasi' => esc($this->request->getPost('afiliasi')),
                'sk_penugasan' => esc($this->request->getPost('sk')),
                'tgl_penugasan' => esc($this->request->getPost('tanggal')),
                'lama' => esc($this->request->getPost('lama')),
                'judul' => esc($this->request->getPost('judul')),
                'lokasi' => esc($this->request->getPost('lokasi')),
                'dana_dikti' => esc($this->request->getPost('dana_dikti')),
                'dana_pt' => esc($this->request->getPost('dana_univ')),
                'dana_lain' => esc($this->request->getPost('dana_lain')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idpengabdian'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("pengabdian", $data, $kond);
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

    public function hapus()
    {
        if (session()->get("logged_admin") || session()->get("logged_dosen")) {
            $kond['idpengabdian'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("pengabdian", $kond);
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
        if (session()->get("logged_dosen")) {
            $data['idusers'] = session()->get("idusers");
            $data['nama'] = session()->get("nama");
            $data['role'] = session()->get("idjabatan");
            $data['nm_role'] = session()->get("nama_jabatan");
            $data['menu'] = $this->request->getUri()->getSegment(1);

            $def_foto = base_url('images/noimg.jpg');

            $pro = (object) $this->mcustom->getDynamicData(true, ['foto'], 'users', [], ['idusers' => $data['idusers']]);
            if (strlen($pro->foto) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $pro->foto)) {
                    $def_foto = base_url('privateimg/showimg/' . esc($pro->foto));
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
            $data['tahun'] = $this->modul->getTahun();
            $data['curdate'] = $this->modul->TanggalSekarang();

            $idpengabdian = $this->modul->dekrip_simple($this->request->getUri()->getSegment(3));
            $data['idpengabdian'] = $idpengabdian;
            $data['head'] = $this->mcustom->get_by_id("pengabdian", ['idpengabdian' => $idpengabdian]);

            return view('pengabdian/detil', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxdosen()
    {
        if (session()->get("logged_dosen")) {
            $idpengabdian = $this->request->getUri()->getSegment(3);
            $mode = "Dosen";
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'pengabdian_dosen', [], ['idpengabdian' => $idpengabdian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpengabdian_dosen . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpengabdian_dosen . "'" . ',' . "'" . $no . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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

    public function ajaxmhs()
    {
        if (session()->get("logged_dosen")) {
            $idpengabdian = $this->request->getUri()->getSegment(3);
            $mode = "Mahasiswa";

            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'pengabdian_mhs', [], ['idpengabdian' => $idpengabdian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpengabdian_mhs . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpengabdian_mhs . "'" . ',' . "'" . $no . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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

    public function ajaxnoncivitas()
    {
        if (session()->get("logged_dosen")) {
            $idpengabdian = $this->request->getUri()->getSegment(3);
            $mode = "Non Civitas Akademika";

            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'pengabdian_lain', [], ['idpengabdian' => $idpengabdian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpengabdian_lain . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpengabdian_lain . "'" . ',' . "'" . $no . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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

    public function ajax_add_member(){
        if (session()->get("logged_dosen")) {
            $mode = esc($this->request->getPost('mode'));
            if($mode == "Dosen"){
                $simpan = $this->tambah_dosen();
            } elseif($mode == "Mahasiswa"){
                $simpan = $this->tambah_mahasiswa();
            } elseif($mode == "Non Civitas Akademika"){
                $simpan = $this->tambah_non_civitas();
            }

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

    private function tambah_dosen(){
        $data = array(
            'idpengabdian_dosen' => Uuid::uuid4()->toString(),
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'nama' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        return $this->mcustom->tambah("pengabdian_dosen", $data);
    }

    private function tambah_mahasiswa(){
        $data = array(
            'idpengabdian_mhs' => Uuid::uuid4()->toString(),
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'nama' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        return $this->mcustom->tambah("pengabdian_mhs", $data);
    }

    private function tambah_non_civitas(){
        $data = array(
            'idpengabdian_lain' => Uuid::uuid4()->toString(),
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'nama' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        return $this->mcustom->tambah("pengabdian_lain", $data);
    }

    public function show_member_dosen()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_dosen'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pengabdian_dosen", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function show_member_mhs()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_mhs'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pengabdian_mhs", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function show_member_non()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_lain'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pengabdian_lain", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function hapusdosen()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_dosen'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("pengabdian_dosen", $kond);
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

    public function hapusmhs()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_mhs'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("pengabdian_mhs", $kond);
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

    public function hapusnon()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_lain'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("pengabdian_lain", $kond);
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

    public function ajax_edit_member(){
        if (session()->get("logged_dosen")) {
            $mode = esc($this->request->getPost('mode'));
            if($mode == "Dosen"){
                $simpan = $this->ganti_dosen();
            } elseif($mode == "Mahasiswa"){
                $simpan = $this->ganti_mahasiswa();
            } elseif($mode == "Non Civitas Akademika"){
                $simpan = $this->ganti_non_civitas();
            }

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

    private function ganti_dosen(){
        $data = array(
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'nama' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpengabdian_dosen'] = $this->request->getPost('kode');
        return $this->mcustom->ganti("pengabdian_dosen", $data, $kond);
    }

    private function ganti_mahasiswa(){
        $data = array(
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'nama' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpengabdian_mhs'] = $this->request->getPost('kode');
        return $this->mcustom->ganti("pengabdian_mhs", $data, $kond);
    }

    private function ganti_non_civitas(){
        $data = array(
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'nama' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpengabdian_lain'] = $this->request->getPost('kode');
        return $this->mcustom->ganti("pengabdian_lain", $data, $kond);
    }

    public function ajaxdokumen()
    {
        if (session()->get("logged_dosen")) {
            $idpengabdian = $this->request->getUri()->getSegment(3);
            
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'pengabdian_doc', [], ['idpengabdian' => $idpengabdian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->judul_dokumen);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="unduh(' . "'" . $row->file . "'" . ')"><i class="fa fa-fw fa-download"></i></button>'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="gantidoc(' . "'" . $row->idpengabdian_doc . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapusdoc(' . "'" . $row->idpengabdian_doc . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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

    public function hapusdokumen() {
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_doc'] = esc($this->request->getUri()->getSegment(3));

            $lawas = (object)$this->mcustom->getDynamicData(true, ['file'], 'pengabdian_doc', [], $kond);
            if (strlen($lawas->file) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $lawas->file)) {
                    unlink($this->modul->getPrivatePath() . $lawas->file);
                }
            }

            $hapus = $this->mcustom->hapus("pengabdian_doc", $kond);
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

    public function unduh($filename){
        if (session()->get("logged_dosen")) {
            $filePath = WRITEPATH . 'uploads/' . $filename;
            $this->modul->unduhfile($filePath);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_add_dokumen() {
        if (session()->get("logged_dosen")) {
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $status = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $status = $this->simpan_file();
                }
            } else {
                $status = "File tidak ditemukan";
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

    private function simpan_file() {
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $ukuranFile = $file->getSize() / (1024 * 1024);
        $mimeFile = $file->getMimeType();

        //$allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        $allowedMimeTypes = ['application/pdf'];
        //$allowedExtensions = ['jpeg', 'jpg', 'png', 'pdf'];

        if($ukuranFile < 25){
            if (in_array($mimeFile, $allowedMimeTypes)) {
                if (file_exists($this->modul->getPrivatePath() . '/' . $fileName)) {
                    $status = "Gunakan nama file lain";
                } else {
                    $status_upload = $file->move($this->modul->setPrivatePath(), $fileName);
                    if ($status_upload) {
                        $data = array(
                            'idpengabdian_doc' => Uuid::uuid4()->toString(),
                            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
                            'judul_dokumen' => esc($this->request->getPost('judul')),
                            'file' => $fileName,
                            'created_at' => $this->modul->TanggalWaktu(),
                            'updated_at' => $this->modul->TanggalWaktu()
                        );
                        $simpan = $this->mcustom->tambah("pengabdian_doc", $data);
                        if ($simpan == 1) {
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
            $status = "Hanya diperkenankan file dibawah 1 MB";
        }
        return $status;
    }

    public function showdokumen(){
        if (session()->get("logged_dosen")) {
            $kond['idpengabdian_doc'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pengabdian_doc", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit_dokumen(){
        if (session()->get("logged_dosen")) {
            if (isset($_FILES['file']['name'])) {
                if (0 < $_FILES['file']['error']) {
                    $status = "Error during file upload " . $_FILES['file']['error'];
                } else {
                    $status = $this->update_file();
                }
            } else {
                $status = $this->update();
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

    private function update_file() {
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $ukuranFile = $file->getSize() / (1024 * 1024);
        $extFile = $file->getClientExtension();
        $mimeFile = $file->getMimeType();

        //$allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        $allowedMimeTypes = ['application/pdf'];
        //$allowedExtensions = ['jpeg', 'jpg', 'png', 'pdf'];

        if($ukuranFile < 25){
            if (in_array($mimeFile, $allowedMimeTypes)) {
                if (file_exists($this->modul->getPrivatePath() . '/' . $fileName)) {
                    $status = "Gunakan nama file lain";
                } else {
                    // hapus file lama
                    $lawas = (object)$this->mcustom->getDynamicData(true, ['file'], 'pengabdian_doc', [], ['idpengabdian_doc' => $this->request->getPost('kode')]);
                    if (strlen($lawas->file) > 0) {
                        if (file_exists($this->modul->getPrivatePath() . $lawas->file)) {
                            unlink($this->modul->getPrivatePath() . $lawas->file);
                        }
                    }

                    $status_upload = $file->move($this->modul->setPrivatePath(), $fileName);
                    if ($status_upload) {
                        $data = array(
                            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
                            'judul_dokumen' => esc($this->request->getPost('judul')),
                            'file' => $fileName,
                            'updated_at' => $this->modul->TanggalWaktu()
                        );
                        $kond['idpengabdian_doc'] = $this->request->getPost('kode');
                        $update = $this->mcustom->ganti("pengabdian_doc", $data, $kond);
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
            $status = "Hanya diperkenankan file dibawah 25 MB";
        }
        return $status;
    }

    private function update() {
        $data = array(
            'idpengabdian' => esc($this->request->getPost('idpengabdian')),
            'judul_dokumen' => esc($this->request->getPost('judul')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpengabdian_doc'] = $this->request->getPost('kode');
        $update = $this->mcustom->ganti("pengabdian_doc", $data, $kond);
        if ($update == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
}
