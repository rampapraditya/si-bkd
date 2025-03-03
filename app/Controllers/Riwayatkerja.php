<?php

namespace App\Controllers;

use App\Models\Mcustom;
use App\Libraries\Modul;
use Ramsey\Uuid\Uuid;

class Riwayatkerja extends BaseController
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
                    $def_foto = base_url('riwayat-kerja/showimg/' . esc($pro->foto));
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

            return view('riwayat_kerja/index', $data);
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
            $list = $this->mcustom->getDynamicData(false, ['*'], 'riwayat_kerja', [], ['idusers' => $idusers], [], [], [], [], null, null, ['created_at' => 'ASC']);
            foreach ($list as $row) {
                $val = array();
                $val[] = $no;
                $val[] = esc($row->bidang_usaha);
                $val[] = esc($row->jenis_pekerjaan);
                $val[] = esc($row->jabatan);
                $val[] = esc($row->instansi);
                $val[] = esc($row->divisi);
                $val[] = '<div style="text-align:center; width:100%;"><div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-xs btn-primary btn-fw" onclick="ganti(' . "'" . $row->idriwayat_kerja . "'" . ')"><i class="fa fa-fw fa-pencil"></i></button>'
                    . '<button type="button" class="btn btn-xs btn-danger btn-fw" onclick="hapus(' . "'" . $row->idriwayat_kerja . "'" . ',' . "'" . $no . "'" . ')"><i class="fa fa-fw fa-trash"></i></button>'
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
                'idriwayat_kerja' => Uuid::uuid4()->toString(),
                'idusers' => $idusers,
                'bidang_usaha' => esc($this->request->getPost('bidang_usaha')),
                'jenis_pekerjaan' => esc($this->request->getPost('jenis_pekerjaan')),
                'jabatan' => esc($this->request->getPost('jabatan')),
                'instansi' => esc($this->request->getPost('instansi')),
                'divisi' => esc($this->request->getPost('divisi')),
                'deskripsi' => esc($this->request->getPost('deskripsi')),
                'mulai_kerja' => esc($this->request->getPost('mulai_kerja')),
                'selesai_kerja' => esc($this->request->getPost('selesai_kerja')),
                'area' => esc($this->request->getPost('area')),
                'created_at' => $this->modul->TanggalWaktu(),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $simpan = $this->mcustom->tambah("riwayat_kerja", $data);
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
            $kond['idriwayat_kerja'] = esc($this->request->getUri()->getSegment(3));
            $data = $this->mcustom->get_by_id("riwayat_kerja", $kond);
            echo json_encode($data);
        } else {
            $this->modul->halaman('login');
        }
    }

    public function ajax_edit()
    {
        if (session()->get("logged_dosen")) {
            $data = array(
                'bidang_usaha' => esc($this->request->getPost('bidang_usaha')),
                'jenis_pekerjaan' => esc($this->request->getPost('jenis_pekerjaan')),
                'jabatan' => esc($this->request->getPost('jabatan')),
                'instansi' => esc($this->request->getPost('instansi')),
                'divisi' => esc($this->request->getPost('divisi')),
                'deskripsi' => esc($this->request->getPost('deskripsi')),
                'mulai_kerja' => esc($this->request->getPost('mulai_kerja')),
                'selesai_kerja' => esc($this->request->getPost('selesai_kerja')),
                'area' => esc($this->request->getPost('area')),
                'updated_at' => $this->modul->TanggalWaktu()
            );
            $kond['idriwayat_kerja'] = esc($this->request->getPost('kode'));
            $simpan = $this->mcustom->ganti("riwayat_kerja", $data, $kond);
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
            $kond['idriwayat_kerja'] = esc($this->request->getUri()->getSegment(3));
            $hapus = $this->mcustom->hapus("riwayat_kerja", $kond);
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
