<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Pengelolajurnal extends BaseController
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

            return view('pengelola_jurnal/index', $data);
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
            $list = $this->mcustom->getDynamicData(false, ['*', 'date_format(tgl_mulai, "%d %M %Y") as tglmf', 'date_format(tgl_selesai, "%d %M %Y") as tglsf'], 'pengelola_jurnal', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama_jurnal);
                $val[] = esc($row->sk);
                $val[] = esc($row->tglmf);
                $val[] = esc($row->tglsf);
                $val[] = esc($row->status_aktif);
                $val[] = esc($row->peran);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idpengelolajurnal . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idpengelolajurnal . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idpengelolajurnal' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'nama_jurnal' => esc($this->request->getPost('namajurnal')),
                'sk' => esc($this->request->getPost('nosk')),
                'tgl_mulai' => esc($this->request->getPost('tgl_mulai')),
                'tgl_selesai' => esc($this->request->getPost('tgl_selesai')),
                'status_aktif' => esc($this->request->getPost('status')),
                'peran' => esc($this->request->getPost('peran')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("pengelola_jurnal", $data);
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
            $kond['idpengelolajurnal'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("pengelola_jurnal", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'nama_jurnal' => esc($this->request->getPost('namajurnal')),
                'sk' => esc($this->request->getPost('nosk')),
                'tgl_mulai' => esc($this->request->getPost('tgl_mulai')),
                'tgl_selesai' => esc($this->request->getPost('tgl_selesai')),
                'status_aktif' => esc($this->request->getPost('status')),
                'peran' => esc($this->request->getPost('peran')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idpengelolajurnal'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("pengelola_jurnal", $data, $kond);
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
            $kond['idpengelolajurnal'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("pengelola_jurnal", $kond);
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
