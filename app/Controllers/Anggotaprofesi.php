<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Anggotaprofesi extends BaseController
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

            $data['curdate'] = $this->modul->TanggalSekarang();

            return view('anggota_profesi/index', $data);
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
            $list = $this->mcustom->getDynamicData(false, ['*', 'date_format(mulai, "%d-%m-%Y") as mulai_f', 'date_format(selesai, "%d-%m-%Y") as selesai_f'], 'anggota_profesi', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama_org);
                $val[] = esc($row->peran);
                $val[] = esc($row->mulai_f);
                $val[] = esc($row->selesai_f);
                $val[] = esc($row->instansi_profesi);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idang_profesi . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idang_profesi . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idang_profesi' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'nama_org' => esc($this->request->getPost('nama_org')),
                'peran' => esc($this->request->getPost('peran')),
                'mulai' => esc($this->request->getPost('mulai')),
                'selesai' => esc($this->request->getPost('selesai')),
                'instansi_profesi' => esc($this->request->getPost('ins')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("anggota_profesi", $data);
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
            $kond['idang_profesi'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("anggota_profesi", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'nama_org' => esc($this->request->getPost('nama_org')),
                'peran' => esc($this->request->getPost('peran')),
                'mulai' => esc($this->request->getPost('mulai')),
                'selesai' => esc($this->request->getPost('selesai')),
                'instansi_profesi' => esc($this->request->getPost('ins')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idang_profesi'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("anggota_profesi", $data, $kond);
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
            $kond['idang_profesi'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("anggota_profesi", $kond);
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
