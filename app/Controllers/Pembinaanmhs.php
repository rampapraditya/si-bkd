<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Pembinaanmhs extends BaseController
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

            $data['jurusan'] = $this->mcustom->getDynamicData(false, [], 'jurusan', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            
            if (session()->get("logged_admin")) {
                return view('pembinaan_mhs/dosen', $data);
            } else if (session()->get("logged_dosen")) {
                return view('pembinaan_mhs/index', $data);
            }
            
            
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
            $join = [
                ['table' => 'jurusan', 'condition' => 'pembinaan.idjurusan = jurusan.idjurusan', 'type' => 'inner']
            ];
            $list = $this->mcustom->getDynamicData(false, ['pembinaan.*', 'jurusan.namajurusan'], 'pembinaan', $join, ['pembinaan.idusers' => $idusers], [], [], [], [], null, null, ['pembinaan.created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->tahun_ajar).'<br>'.esc($row->semester);
                $val[] = esc($row->kegiatan);
                $val[] = esc($row->judul_bimbingan);
                $val[] = esc($row->jenis_bimbingan);
                $val[] = esc($row->namajurusan);
                $data[] = $val;
                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxdosen()
    {
        if (session()->get("logged_admin")) {
            
            $data = array();
            $no = 1;
            $select = ['users.*','jabatan.nama_jabatan', 'satker.namasatker', 'pangkat.nama_pangkat', 'korps.nama_korps'];
            $join = [
                ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
            ];
            $no = 1;
            $list = $this->mcustom->getDynamicData(false, $select, 'users', $join, ['jabatan.nama_jabatan' => 'DOSEN'], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nrp);
                $lengkap = trim(esc($row->nama_pangkat). ' ' .esc($row->nama_korps).' '.esc($row->nama));
                $val[] = $lengkap;
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="pilih(' . "'" . $this->modul->enkrip_simple($row->idusers) . "'" . ')"><i class="fa fa-fw fa-check"></i></button>'
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

    public function aktivitasdosen(){
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

            $idusers = $this->modul->dekrip_simple($this->request->getUri()->getSegment(3));
            $select = ['users.*','jabatan.nama_jabatan', 'satker.namasatker', 'pangkat.nama_pangkat', 'korps.nama_korps'];
            $join = [
                ['table' => 'jabatan', 'condition' => 'users.idjabatan = jabatan.idjabatan', 'type' => 'inner'],
                ['table' => 'satker', 'condition' => 'users.idsatker = satker.idsatker', 'type' => 'inner'],
                ['table' => 'pangkat', 'condition' => 'users.idpangkat = pangkat.idpangkat', 'type' => 'inner'],
                ['table' => 'korps', 'condition' => 'users.idkorps = korps.idkorps', 'type' => 'inner']
            ];
            $head = (object) $this->mcustom->getDynamicData(true, $select, 'users', $join, ['users.idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            $data['head'] = $head;

            $data['jurusan'] = $this->mcustom->getDynamicData(false, [], 'jurusan', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);

            return view('pembinaan_mhs/aktivitasdosen', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajaxlistadmin()
    {
        if (session()->get("logged_admin")) {
            $idusers = $this->request->getUri()->getSegment(3);

            $data = array();
            $no = 1;
            $join = [
                ['table' => 'jurusan', 'condition' => 'pembinaan.idjurusan = jurusan.idjurusan', 'type' => 'inner']
            ];
            $list = $this->mcustom->getDynamicData(false, ['pembinaan.*', 'jurusan.namajurusan'], 'pembinaan', $join, ['pembinaan.idusers' => $idusers], [], [], [], [], null, null, ['pembinaan.created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->tahun_ajar).'<br>'.esc($row->semester);
                $val[] = esc($row->kegiatan);
                $val[] = esc($row->judul_bimbingan);
                $val[] = esc($row->jenis_bimbingan);
                $val[] = esc($row->namajurusan);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpembinaan . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpembinaan . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idpembinaan' => Uuid::uuid4()->toString(),
                'idusers' => esc($this->request->getPost('idusers')),
                'tahun_ajar' => esc($this->request->getPost('tahun_ajar')),
                'semester' => esc($this->request->getPost('semester')),
                'kegiatan' => esc($this->request->getPost('kegiatan')),
                'judul_bimbingan' => esc($this->request->getPost('judul')),
                'jenis_bimbingan' => esc($this->request->getPost('jenis')),
                'idjurusan' => esc($this->request->getPost('jurusan')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("pembinaan", $data);
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
            $kond['idpembinaan'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pembinaan", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'tahun_ajar' => esc($this->request->getPost('tahun_ajar')),
                'semester' => esc($this->request->getPost('semester')),
                'kegiatan' => esc($this->request->getPost('kegiatan')),
                'judul_bimbingan' => esc($this->request->getPost('judul')),
                'jenis_bimbingan' => esc($this->request->getPost('jenis')),
                'idjurusan' => esc($this->request->getPost('jurusan')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idpembinaan'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("pembinaan", $data, $kond);
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
        if (session()->get("logged_admin")) {
            $kond['idpembinaan'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("pembinaan", $kond);
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
