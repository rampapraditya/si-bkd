<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Publikasi extends BaseController
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
            
            $data['curdate'] = $this->modul->TanggalSekarang();

            return view('publikasi/index', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlist()
    {
        if (session()->get("logged_admin") || session()->get("logged_dosen")) {
            if (session()->get("logged_dosen")) {
                $idusers = session()->get("idusers");
                $list = $this->mcustom->getDynamicData(false, ['*', 'date_format(tgl_terbit, "%d-%m-%Y") as tgl_terbit'], 'publikasi', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            } else if (session()->get("logged_admin")) {
                $select = ['publikasi.*','users.nama'];
                $join = [
                    ['table' => 'users', 'condition' => 'publikasi.idusers = users.idusers', 'type' => 'inner']
                ];
                $list = $this->mcustom->getDynamicData(false, $select, 'publikasi', $join, [], [], [], [], [], null, null, ['publikasi.created_at' => 'ASC']);
            }
            
            $data = array();
            $no = 1;
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                if (session()->get("logged_admin")) {
                    $val[] = esc($row->nama);
                }
                $val[] = esc($row->jenis);
                $val[] = esc($row->kategori_capaian);
                $val[] = esc($row->judul);
                $val[] = esc($row->tgl_terbit);
                if (session()->get("logged_admin")) {
                    $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpublikasi . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
                    . '</div></div>';
                } else {
                    $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="detil(' . "'" . $this->modul->enkrip_simple($row->idpublikasi) . "'" . ')"><i class="fa fa-fw fa-check"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpublikasi . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpublikasi . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idpublikasi' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'jenis' => esc($this->request->getPost('jenis')),
                'kategori_keg' => esc($this->request->getPost('kategori_keg')),
                'kategori_capaian' => esc($this->request->getPost('kategori_capaian')),
                'aktivitas_litabmas' => esc($this->request->getPost('aktivitas_litabmas')),
                'judul' => esc($this->request->getPost('judul')),
                'tgl_terbit' => esc($this->request->getPost('tgl_terbit')),
                'jml_hal' => esc($this->request->getPost('jml_hal')),
                'penerbit' => esc($this->request->getPost('penerbit')),
                'ISBN' => esc($this->request->getPost('isbn')),
                'tautan_external' => esc($this->request->getPost('tautan_external')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("publikasi", $data);
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
            $kond['idpublikasi'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("publikasi", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'jenis' => esc($this->request->getPost('jenis')),
                'kategori_keg' => esc($this->request->getPost('kategori_keg')),
                'kategori_capaian' => esc($this->request->getPost('kategori_capaian')),
                'aktivitas_litabmas' => esc($this->request->getPost('aktivitas_litabmas')),
                'judul' => esc($this->request->getPost('judul')),
                'tgl_terbit' => esc($this->request->getPost('tgl_terbit')),
                'jml_hal' => esc($this->request->getPost('jml_hal')),
                'penerbit' => esc($this->request->getPost('penerbit')),
                'ISBN' => esc($this->request->getPost('isbn')),
                'tautan_external' => esc($this->request->getPost('tautan_external')),
                'keterangan' => esc($this->request->getPost('keterangan')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idpublikasi'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("publikasi", $data, $kond);
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
            $kond['idpublikasi'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("publikasi", $kond);
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

            $idpublikasi = $this->modul->dekrip_simple($this->request->getUri()->getSegment(3));
            $data['idpublikasi'] = $idpublikasi;
            $data['head'] = $this->mcustom->get_by_id("publikasi", ['idpublikasi' => $idpublikasi]);

            return view('publikasi/detil', $data);
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
                . '<button type="button" class="btn btn-xs btn-default btn-fw" onclick="unduh(' . "'" . $row->file . "'" . ')"><i class="fa fa-fw fa-download"></i></button>'
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

    public function hapusdokumen() {
        if (session()->get("logged_dosen")) {
            $kond['idpenelitian_doc'] = esc($this->request->getUri()->getSegment(3));

            $lawas = (object)$this->mcustom->getDynamicData(true, ['file'], 'penelitian_dokumen', [], $kond);
            if (strlen($lawas->file) > 0) {
                if (file_exists($this->modul->getPrivatePath() . $lawas->file)) {
                    unlink($this->modul->getPrivatePath() . $lawas->file);
                }
            }

            $hapus = $this->mcustom->hapus("penelitian_dokumen", $kond);
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
                            'idpenelitian_doc' => Uuid::uuid4()->toString(),
                            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
                            'judul_dokumen' => esc($this->request->getPost('judul')),
                            'file' => $fileName,
                            'created_at' => $this->modul->TanggalWaktu(),
                            'updated_at' => $this->modul->TanggalWaktu()
                        );
                        $simpan = $this->mcustom->tambah("penelitian_dokumen", $data);
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
            $kond['idpenelitian_doc'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("penelitian_dokumen", $kond);
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
                    $lawas = (object)$this->mcustom->getDynamicData(true, ['file'], 'penelitian_dokumen', [], ['idpenelitian_doc' => $this->request->getPost('kode')]);
                    if (strlen($lawas->file) > 0) {
                        if (file_exists($this->modul->getPrivatePath() . $lawas->file)) {
                            unlink($this->modul->getPrivatePath() . $lawas->file);
                        }
                    }

                    $status_upload = $file->move($this->modul->setPrivatePath(), $fileName);
                    if ($status_upload) {
                        $data = array(
                            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
                            'judul_dokumen' => esc($this->request->getPost('judul')),
                            'file' => $fileName,
                            'updated_at' => $this->modul->TanggalWaktu()
                        );
                        $kond['idpenelitian_doc'] = $this->request->getPost('kode');
                        $update = $this->mcustom->ganti("penelitian_dokumen", $data, $kond);
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
            'idpenelitian' => esc($this->request->getPost('idpenelitian')),
            'judul_dokumen' => esc($this->request->getPost('judul')),
            'updated_at' => $this->modul->TanggalWaktu()
        );
        $kond['idpenelitian_doc'] = $this->request->getPost('kode');
        $update = $this->mcustom->ganti("penelitian_dokumen", $data, $kond);
        if ($update == 1) {
            $status = "Data tersimpan";
        } else {
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
}
