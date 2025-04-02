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
}
