<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Tugastambahan extends BaseController
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

            return view('tugas_tambahan/index', $data);
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
            $list = $this->mcustom->getDynamicData(false, ['*', 'date_format(tgl_mulai, "%d-%m-%Y") as tgl_mulai_f', 'date_format(tgl_selesai, "%d-%m-%Y") as tgl_selesai_f'], 'tugas_tambahan', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->tugas);
                $val[] = esc($row->unit);
                $val[] = esc($row->instansi);
                $val[] = esc($row->tgl_mulai_f);
                $val[] = esc($row->tgl_selesai_f);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idtugas . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idtugas . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idtugas' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'tugas' => esc($this->request->getPost('tugas')),
                'unit' => esc($this->request->getPost('unit')),
                'instansi' => esc($this->request->getPost('instansi')),
                'tgl_mulai' => esc($this->request->getPost('tgl_mulai')),
                'tgl_selesai' => esc($this->request->getPost('tgl_selesai')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("tugas_tambahan", $data);
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
            $kond['idtugas'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("tugas_tambahan", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'tugas' => esc($this->request->getPost('tugas')),
                'unit' => esc($this->request->getPost('unit')),
                'instansi' => esc($this->request->getPost('instansi')),
                'tgl_mulai' => esc($this->request->getPost('tgl_mulai')),
                'tgl_selesai' => esc($this->request->getPost('tgl_selesai')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idtugas'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("tugas_tambahan", $data, $kond);
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
            $kond['idtugas'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("tugas_tambahan", $kond);
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
