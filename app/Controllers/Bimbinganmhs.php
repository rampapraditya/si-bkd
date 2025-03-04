<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Bimbinganmhs extends BaseController
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
                    $def_foto = base_url('bim-mhs/showimg/' . esc($pro->foto));
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

            if (session()->get("logged_admin")) {
                return view('bimbingan_mhs/dosen', $data);
            } else if (session()->get("logged_dosen")) {
                return view('bimbingan_mhs/index', $data);
            }
            
        } else {
            $this->modul->halaman('login');
        }
    }

    public function showimg($filename){
        if (session()->get("logged_admin") || session()->get("logged_dosen")) {
            return $this->modul->serveImage($this->response, $filename);
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
            $select = ['bimbingan.*','jurusan.namajurusan'];
            $join = [
                ['table' => 'jurusan', 'condition' => 'bimbingan.idjurusan = jurusan.idjurusan', 'type' => 'inner'],  
            ];
            $list = $this->mcustom->getDynamicData(false, $select, 'bimbingan', $join, ['idusers' => $idusers], [], [], [], [], null, null, ['bimbingan.created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->semester);
                $val[] = esc($row->ket_kegiatan);
                $val[] = esc($row->judul_bimbingan);
                $val[] = esc($row->bidang);
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
                    $def_foto = base_url('pengajaran/showimg/' . esc($pro->foto));
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

            return view('bimbingan_mhs/aktivitasdosen', $data);
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

            $select = ['bimbingan.*','jurusan.namajurusan'];
            $join = [
                ['table' => 'jurusan', 'condition' => 'bimbingan.idjurusan = jurusan.idjurusan', 'type' => 'inner'],  
            ];
            $list = $this->mcustom->getDynamicData(false, $select, 'bimbingan', $join, ['idusers' => $idusers], [], [], [], [], null, null, ['bimbingan.created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->semester);
                $val[] = esc($row->ket_kegiatan);
                $val[] = esc($row->judul_bimbingan);
                $val[] = esc($row->bidang);
                $val[] = esc($row->jenis_bimbingan);
                $val[] = esc($row->namajurusan);    
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idbimbingan . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idbimbingan . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idbimbingan' => Uuid::uuid4()->toString(),
                'idusers' => esc($this->request->getPost('idusers')),
                'semester' => esc($this->request->getPost('semester')),
                'ket_kegiatan' => esc($this->request->getPost('ket_kegiatan')),
                'judul_bimbingan' => esc($this->request->getPost('judul_bimbingan')),
                'bidang' => esc($this->request->getPost('bidang')),
                'jenis_bimbingan' => esc($this->request->getPost('jenis_bimbingan')),
                'idjurusan' => esc($this->request->getPost('idjurusan')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("bimbingan", $data);
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
            $kond['idbimbingan'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("bimbingan", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_admin")) {
            $data = array(
                'semester' => esc($this->request->getPost('semester')),
                'ket_kegiatan' => esc($this->request->getPost('ket_kegiatan')),
                'judul_bimbingan' => esc($this->request->getPost('judul_bimbingan')),
                'bidang' => esc($this->request->getPost('bidang')),
                'jenis_bimbingan' => esc($this->request->getPost('jenis_bimbingan')),
                'idjurusan' => esc($this->request->getPost('idjurusan')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idbimbingan'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("bimbingan", $data, $kond);
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
            $kond['idbimbingan'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("bimbingan", $kond);
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
