<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Penelitian extends BaseController
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

            return view('penelitian/index', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist()
    {
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'penelitian', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->judul);
                $val[] = esc($row->kelompok_bidang);
                $val[] = esc($row->tahun_pelaksanaan);
                $val[] = esc($row->lama);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="detil(' . "'" . $this->modul->enkrip_simple($row->idpenelitian) . "'" . ')"><i class="fa fa-fw fa-check"></i></button>'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpenelitian . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpenelitian . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");
            $data = array(
                'idpenelitian' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'judul' => esc($this->request->getPost('judul')),
                'afiliasi' => esc($this->request->getPost('afiliasi')),
                'kelompok_bidang' => esc($this->request->getPost('bidang')),
                'lokasi' => esc($this->request->getPost('lokasi')),
                'no_sk' => esc($this->request->getPost('sk')),
                'tgl_sk' => esc($this->request->getPost('tglsk')),
                'lama' => esc($this->request->getPost('lama')),
                'tahun_usulan' => esc($this->request->getPost('tahun_usulan')),
                'tahun_kegiatan' => esc($this->request->getPost('tahun_kegiatan')),
                'tahun_pelaksanaan' => esc($this->request->getPost('tahun_laksana')),
                'tahun_ke' => esc($this->request->getPost('tahun_ke')),
                'dana_dikti' => esc($this->request->getPost('dana_dikti')),
                'dana_univ' => esc($this->request->getPost('dana_univ')),
                'dana_ins_lain' => esc($this->request->getPost('dana_lain')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("penelitian", $data);
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
            $kond['idpenelitian'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("penelitian", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'judul' => esc($this->request->getPost('judul')),
                'afiliasi' => esc($this->request->getPost('afiliasi')),
                'kelompok_bidang' => esc($this->request->getPost('bidang')),
                'lokasi' => esc($this->request->getPost('lokasi')),
                'no_sk' => esc($this->request->getPost('sk')),
                'tgl_sk' => esc($this->request->getPost('tglsk')),
                'lama' => esc($this->request->getPost('lama')),
                'tahun_usulan' => esc($this->request->getPost('tahun_usulan')),
                'tahun_kegiatan' => esc($this->request->getPost('tahun_kegiatan')),
                'tahun_pelaksanaan' => esc($this->request->getPost('tahun_laksana')),
                'tahun_ke' => esc($this->request->getPost('tahun_ke')),
                'dana_dikti' => esc($this->request->getPost('dana_dikti')),
                'dana_univ' => esc($this->request->getPost('dana_univ')),
                'dana_ins_lain' => esc($this->request->getPost('dana_lain')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idpenelitian'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("penelitian", $data, $kond);
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
        if (session()->get("logged_dosen")) {
            $kond['idpenelitian'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("penelitian", $kond);
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

            $idpenelitian = $this->modul->dekrip_simple($this->request->getUri()->getSegment(3));
            $data['idpenelitian'] = $idpenelitian;
            $data['head'] = $this->mcustom->get_by_id("penelitian", ['idpenelitian' => $idpenelitian]);

            return view('penelitian/detil', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxdosen()
    {
        if (session()->get("logged_dosen")) {
            $idpenelitian = $this->request->getUri()->getSegment(3);
            $mode = "Dosen";
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'penelitian_dosen', [], ['idpenelitian' => $idpenelitian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama_dosen);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpenelitian_dosen . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpenelitian_dosen . "'" . ',' . "'" . $no . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
            $idpenelitian = $this->request->getUri()->getSegment(3);
            $mode = "Mahasiswa";

            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'penelitian_mahasiswa', [], ['idpenelitian' => $idpenelitian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama_mhs);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpenelitian_mhs . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpenelitian_mhs . "'" . ',' . "'" . $no . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
            $idpenelitian = $this->request->getUri()->getSegment(3);
            $mode = "Non Civitas Akademika";

            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'penelitian_non_civitas', [], ['idpenelitian' => $idpenelitian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama_non_civitas);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpenelitian_non_civitas . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpenelitian_non_civitas . "'" . ',' . "'" . $no . "'" . ', ' . "'" . $mode . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
            'idpenelitian_dosen' => Uuid::uuid4()->toString(),
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'nama_dosen' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        return $this->mcustom->tambah("penelitian_dosen", $data);
    }

    private function tambah_mahasiswa(){
        $data = array(
            'idpenelitian_mhs' => Uuid::uuid4()->toString(),
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'nama_mhs' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        return $this->mcustom->tambah("penelitian_mahasiswa", $data);
    }

    private function tambah_non_civitas(){
        $data = array(
            'idpenelitian_non_civitas' => Uuid::uuid4()->toString(),
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'nama_non_civitas' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'created_at' => $this->modul->TanggalWaktu(),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        return $this->mcustom->tambah("penelitian_non_civitas", $data);
    }

    public function show_member_dosen()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpenelitian_dosen'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("penelitian_dosen", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function show_member_mhs()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpenelitian_mhs'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("penelitian_mahasiswa", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function show_member_non()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpenelitian_non_civitas'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("penelitian_non_civitas", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function hapusdosen()
    {
        if (session()->get("logged_dosen")) {
            $kond['idpenelitian_dosen'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("penelitian_dosen", $kond);
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
            $kond['idpenelitian_mhs'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("penelitian_mahasiswa", $kond);
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
            $kond['idpenelitian_non_civitas'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("penelitian_non_civitas", $kond);
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
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'nama_dosen' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpenelitian_dosen'] = $this->request->getPost('kode');
        return $this->mcustom->ganti("penelitian_dosen", $data, $kond);
    }

    private function ganti_mahasiswa(){
        $data = array(
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'nama_mhs' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpenelitian_mhs'] = $this->request->getPost('kode');
        return $this->mcustom->ganti("penelitian_mahasiswa", $data, $kond);
    }

    private function ganti_non_civitas(){
        $data = array(
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'nama_non_civitas' => esc($this->request->getPost('nama')),
            'peran' => esc($this->request->getPost('peran')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpenelitian_non_civitas'] = $this->request->getPost('kode');
        return $this->mcustom->ganti("penelitian_non_civitas", $data, $kond);
    }

    public function ajaxdokumen()
    {
        if (session()->get("logged_dosen")) {
            $idpenelitian = $this->request->getUri()->getSegment(3);
            
            $data = array();
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, ['*'], 'penelitian_dokumen', [], ['idpenelitian' => $idpenelitian], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->judul_dokumen);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="unduh(' . "'" . $row->idpenelitian_doc . "'" . ')"><i class="fa fa-fw fa-download"></i></button>'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="gantidoc(' . "'" . $row->idpenelitian_doc . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapusdoc(' . "'" . $row->idpenelitian_doc . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
}
