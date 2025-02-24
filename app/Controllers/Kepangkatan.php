<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Kepangkatan extends BaseController
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
                    $def_foto = base_url('kepangkatan/showimg/' . esc($pro->foto));
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

            $data['golongan'] = $this->mcustom->getDynamicData(false, [], 'golongan', [], [], [], [], [], [], null, null, ['created_at' => 'ASC']);
            $data['curdate'] = $this->modul->TanggalSekarang();

            return view('kepangkatan/index', $data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function showimg($filename){
        if (session()->get("logged_dosen")) {
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
            $select = [
                'kepangkatan.idkepangkatan', 
                'kepangkatan.idgolongan', 
                'golongan.nama_golongan', 
                'kepangkatan.nomor_sk', 
                'date_format(kepangkatan.tgl_sk, "%d-%m-%Y") as tgl_sk_f', 
                'date_format(kepangkatan.mulai_tgl, "%d-%m-%Y") as mulai_tgl_f', 
                'kepangkatan.masa_kerja_gol_tahun', 
                'kepangkatan.masa_kerja_gol_bulan', 
                'kepangkatan.created_at',
                'kepangkatan.updated_at'];
            $join = [
                ['table' => 'golongan', 'condition' => 'kepangkatan.idgolongan = golongan.idgolongan', 'type' => 'inner']
            ];
            $list = $this->mcustom->getDynamicData(false, $select, 'kepangkatan', $join, ['idusers' => $idusers], [], [], [], [], null, null, ['kepangkatan.created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->nama_golongan);
                $val[] = esc($row->nomor_sk);
                $val[] = esc($row->tgl_sk_f);
                $val[] = esc($row->mulai_tgl_f);
                $val[] = esc($row->masa_kerja_gol_tahun);
                $val[] = esc($row->masa_kerja_gol_bulan);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idkepangkatan . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idkepangkatan . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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

    public function ajax_add(){
        if (session()->get("logged_dosen")) {
            $idusers = session()->get("idusers");

            $data = array(
                'idkepangkatan' => Uuid::uuid4()->toString(),
                'idgolongan' => esc($this->request->getPost('golongan')),
                'nomor_sk' => esc($this->request->getPost('nomor_sk')),
                'tgl_sk' => esc($this->request->getPost('tgl_sk')),
                'mulai_tgl' => esc($this->request->getPost('tgl_mulai')),
                'masa_kerja_gol_tahun' => esc($this->request->getPost('kerja_tahun')),
                'masa_kerja_gol_bulan' => esc($this->request->getPost('kerja_bulan')),
                'bukti' => '',
                'idusers' => $idusers,
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("kepangkatan", $data);
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
            $kond['idkepangkatan'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("kepangkatan", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'idgolongan' => esc($this->request->getPost('golongan')),
                'nomor_sk' => esc($this->request->getPost('nomor_sk')),
                'tgl_sk' => esc($this->request->getPost('tgl_sk')),
                'mulai_tgl' => esc($this->request->getPost('tgl_mulai')),
                'masa_kerja_gol_tahun' => esc($this->request->getPost('kerja_tahun')),
                'masa_kerja_gol_bulan' => esc($this->request->getPost('kerja_bulan')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idkepangkatan'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("kepangkatan", $data, $kond);
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
        if (session()->get("logged_dosen")) {
            $kond['idkepangkatan'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("kepangkatan", $kond);
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
