<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Data pribadi <small>Maintenance data pribadi</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Data pribadi</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Profil</h3>
                                <button type="button" class="btn btn-primary btn-sm pull-right" onclick="add_profile();"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: center;" rowspan="5">
                                            <img id="display_foto" class="img-thumbnail" src="<?php echo $foto; ?>" style="max-width: 150px; height: auto;">
                                        </td>
                                        <td style="text-align: right;">NIDN</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_nidn"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Nama</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_nama"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Jenis Kelamin</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_jkel"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Tempat Lahir</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_tmplahir"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Tanggal Lahir</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_tgllahir"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kependudukan</h3>
                                <button onclick="add_penduduk();" type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">NIK</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_nik"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Agama</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_agama"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kewarganegaraan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_kwn"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Keluarga</h3>
                                <button onclick="add_keluarga();" type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">Status Perkawinan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_keluarga_status"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Nama Suami/Istri</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_keluarga_suami_istri"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">NIP Suami/Istri</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_keluarga_nip"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Pekerjaan Suami/Istri</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_keluarga_pekerjaan"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Alamat dan Kontak</h3>
                                <button onclick="add_alamat();" type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">Email</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_email"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Alamat</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_alamat"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">RT</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_rt"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">RW</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_rw"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Desa / Kelurahan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_kelurahan"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kecamatan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_kecamatan"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kota / Kabupaten</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_kota"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Provinsi</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_provinsi"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kode Pos</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_kdpos"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">No. Telepon Rumah</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_tlp_rumah"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">No Ponsel</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_tlp_ponsel"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kepegawaian</h3>
                                <button onclick="add_pegawai();" type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">Nomor SK TMMD</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_nomor_sk"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">TMMD</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_tmmd"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Sumber Gaji</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_sumber_gaji"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Status Keaktifan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_status_aktif"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Program Studi</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_program_studi"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lain-lain</h3>
                                <button onclick="add_lain();" type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">NPWP</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_npwp"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Nama Wajib Pajak</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_nama_npwp"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">SINTA ID</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><label id="display_sinta_id"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Profil</h4>
            </div>
            <div class="modal-body">
                <form id="form_profile" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">NIDN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nidn" name="nidn" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select id="jkel" name="jkel" class="form-control">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Tempat Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tmplahir" name="tmplahir" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgllahir" name="tgllahir" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="foto" name="foto" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveProfile" type="button" class="btn btn-sm btn-primary" onclick="save_profile();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_penduduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Kependudukan</h4>
            </div>
            <div class="modal-body">
                <form id="form_penduduk" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Agama</label>
                        <div class="col-sm-9">
                            <select id="agama" name="agama" class="form-control">
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Kewarganegaraan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kwn" name="kwn" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSavePenduduk" type="button" class="btn btn-sm btn-primary" onclick="save_penduduk();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_keluarga">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Keluarga</h4>
            </div>
            <div class="modal-body">
                <form id="form_keluarga" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Status Perkawinan</label>
                        <div class="col-sm-8">
                            <select id="keluarga_status" name="keluarga_status" class="form-control">
                                <option>Belum kawin</option>
                                <option>Kawin belum tercatat</option>
                                <option>Kawin tercatat</option>
                                <option>Cerai hidup</option>
                                <option>Cerai mati</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Nama Suami / Istri</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="keluarga_suami_istri" name="keluarga_suami_istri" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">NIP Suami / Istri</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="keluarga_nip" name="keluarga_nip" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Pekerjaan Suami / Istri</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="keluarga_pekerjaan" name="keluarga_pekerjaan" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveKeluarga" type="button" class="btn btn-sm btn-primary" onclick="save_keluarga();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_alamat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Alamat dan Kontak</h4>
            </div>
            <div class="modal-body">
                <form id="form_alamat" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">RT</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rt" name="rt" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">RW</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rw" name="rw" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Kelurahan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Kecamatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Kota</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kota" name="kota" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Provinsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="provinsi" name="provinsi" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">KD POS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kdpos" name="kdpos" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Telp Rumah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tlp_rumah" name="tlp_rumah" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Telp Ponsel</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tlp_ponsel" name="tlp_ponsel" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveAlamat" type="button" class="btn btn-sm btn-primary" onclick="save_alamat();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_pegawai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Kepegawaian</h4>
            </div>
            <div class="modal-body">
                <form id="form_pegawai" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Nomor SK</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nomor_sk" name="nomor_sk" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Tanggal Mulai Menjadi Dosen</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="tmmd" name="tmmd" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Sumber Gaji</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="sumber_gaji" name="sumber_gaji">
                                <option value="APBN">APBN</option>
                                <option value="APBD">APBD</option>
                                <option value="APBD Kabupaten / Kota">APBD Kabupaten / Kota</option>
                                <option value="Yayasan">Yayasan</option>
                                <option value="Sekokah">Sekokah</option>
                                <option value="Lembaga Donor">Lembaga Donor</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Status Keaktifan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="status_aktif" name="status_aktif" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Program Studi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="program_studi" name="program_studi" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSavePegawai" type="button" class="btn btn-sm btn-primary" onclick="save_pegawai();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_lain">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Lain - lain</h4>
            </div>
            <div class="modal-body">
                <form id="form_lain" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">NPWP</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="npwp" name="npwp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Nama Wajib Pajak</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_npwp" name="nama_npwp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Sinta ID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sinta_id" name="sinta_id" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveLain" type="button" class="btn btn-sm btn-primary" onclick="save_lain();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        reload_profile();
        reload_penduduk();
        reload_keluarga();
        reload_alamat();
        reload_pegawai();
        reload_lain();
    });

    function reload_profile(){
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadprofile'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#display_nidn').html(data.nidn);
                $('#display_nama').html(data.nama);
                $('#display_jkel').html(data.jkel);
                $('#display_tmplahir').html(data.tmp_lahir);
                $('#display_tgllahir').html(data.tglf);
                $('#display_foto').attr("src", data.foto);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function reload_penduduk(){
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadpenduduk'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#display_nik').html(data.nik);
                $('#display_agama').html(data.agama);
                $('#display_kwn').html(data.warganegara);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function reload_keluarga(){
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadkeluarga'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#display_keluarga_status').html(data.status_keluarga);
                $('#display_keluarga_suami_istri').html(data.nama_suami_istri);
                $('#display_keluarga_nip').html(data.nip_suami_istri);
                $('#display_keluarga_pekerjaan').html(data.pekerjaan_suami_istri);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function reload_alamat(){
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadkontak'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#display_email').html(data.email);
                $('#display_alamat').html(data.alamat);
                $('#display_rt').html(data.rt);
                $('#display_rw').html(data.rw);
                $('#display_kelurahan').html(data.kelurahan);
                $('#display_kecamatan').html(data.kecamatan);
                $('#display_kota').html(data.kota);
                $('#display_provinsi').html(data.provinsi);
                $('#display_kdpos').html(data.kdpos);
                $('#display_tlp_rumah').html(data.tlp_rumah);
                $('#display_tlp_ponsel').html(data.tlp_ponsel);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function reload_pegawai(){
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadpegawai'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#display_nomor_sk').html(data.nomor_sk);
                $('#display_tmmd').html(data.tglf);
                $('#display_sumber_gaji').html(data.sumber_gaji);
                $('#display_status_aktif').html(data.status_aktif);
                $('#display_program_studi').html(data.program_studi);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function reload_lain(){
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadlain'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#display_npwp').html(data.npwp);
                $('#display_nama_npwp').html(data.nama_npwp);
                $('#display_sinta_id').html(data.sinta_id);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function add_profile() {
        $('#form_profile')[0].reset();
        $('#modal_profile').modal('show');
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadprofile'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#nidn').val(data.nidn);
                $('#nama').val(data.nama);
                $('#jkel').val(data.jkel);
                $('#tmplahir').val(data.tmp_lahir);
                $('#tgllahir').val(data.tgl_lahir);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_profile(){
        var nidn = document.getElementById('nidn').value;
        var nama = document.getElementById('nama').value;
        var jkel = document.getElementById('jkel').value;
        var tmplahir = document.getElementById('tmplahir').value;
        var tgllahir = document.getElementById('tgllahir').value;
        var foto = $('#foto').prop('files')[0];
        
        if (nidn === '') {
            iziToast.error({
                title: 'Error',
                message: "NIDN tidak boleh kosong",
                position: 'topRight'
            });
        } else if (nama === ""){
            iziToast.error({
                title: 'Error',
                message: "Nama tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgllahir === ""){
            iziToast.error({
                title: 'Error',
                message: "Tanggal lahir tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSaveProfile').text('Saving...');
            $('#btnSaveProfile').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('nidn', nidn);
            form_data.append('nama', nama);
            form_data.append('jkel', jkel);
            form_data.append('tmplahir', tmplahir);
            form_data.append('tgllahir', tgllahir);
            form_data.append('file', foto);
            
            $.ajax({
                url: "<?php echo base_url('data-pribadi/prosesprofile'); ?>",
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));    
                },success: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.info({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });

                    $('#modal_profile').modal('hide');
                    reload_profile();

                    $('#btnSaveProfile').text('Save');
                    $('#btnSaveProfile').attr('disabled', false);
                }, error: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSaveProfile').text('Save'); //change button text
                    $('#btnSaveProfile').attr('disabled', false); //set button enable 
                }
            });
        }
    }

    function add_penduduk() {
        $('#form_penduduk')[0].reset();
        $('#modal_penduduk').modal('show');
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadpenduduk'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#nik').val(data.nik);
                $('#agama').val(data.agama);
                $('#kwn').val(data.warganegara);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_penduduk(){
        var nik = document.getElementById('nik').value;
        var agama = document.getElementById('agama').value;
        var kwn = document.getElementById('kwn').value;
        
        if (nik === '') {
            iziToast.error({
                title: 'Error',
                message: "NIK tidak boleh kosong",
                position: 'topRight'
            });
        } else if (agama === ""){
            iziToast.error({
                title: 'Error',
                message: "Agama tidak boleh kosong",
                position: 'topRight'
            });
        } else if (kwn === ""){
            iziToast.error({
                title: 'Error',
                message: "Kewarganegaraan lahir tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSavePenduduk').text('Saving...');
            $('#btnSavePenduduk').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('nik', nik);
            form_data.append('agama', agama);
            form_data.append('kwn', kwn);
            
            $.ajax({
                url: "<?php echo base_url('data-pribadi/prosespenduduk'); ?>",
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));    
                },success: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.info({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });

                    $('#modal_penduduk').modal('hide');
                    reload_penduduk();

                    $('#btnSavePenduduk').text('Save');
                    $('#btnSavePenduduk').attr('disabled', false);
                }, error: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSavePenduduk').text('Save');
                    $('#btnSavePenduduk').attr('disabled', false);
                }
            });
        }
    }

    function add_keluarga() {
        $('#form_keluarga')[0].reset();
        $('#modal_keluarga').modal('show');
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadkeluarga'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#keluarga_status').val(data.status_keluarga);
                $('#keluarga_suami_istri').val(data.nama_suami_istri);
                $('#keluarga_nip').val(data.nip_suami_istri);
                $('#keluarga_pekerjaan').val(data.pekerjaan_suami_istri);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_keluarga(){
        var keluarga_status = document.getElementById('keluarga_status').value;
        var keluarga_suami_istri = document.getElementById('keluarga_suami_istri').value;
        var keluarga_nip = document.getElementById('keluarga_nip').value;
        var keluarga_pekerjaan = document.getElementById('keluarga_pekerjaan').value;
        
        $('#btnSaveKeluarga').text('Saving...');
        $('#btnSaveKeluarga').attr('disabled', true);

        var form_data = new FormData();
        form_data.append('keluarga_status', keluarga_status);
        form_data.append('keluarga_suami_istri', keluarga_suami_istri);
        form_data.append('keluarga_nip', keluarga_nip);
        form_data.append('keluarga_pekerjaan', keluarga_pekerjaan);
        
        $.ajax({
            url: "<?php echo base_url('data-pribadi/proseskeluarga'); ?>",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));    
            },success: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.info({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#modal_keluarga').modal('hide');
                reload_keluarga();

                $('#btnSaveKeluarga').text('Save');
                $('#btnSaveKeluarga').attr('disabled', false);

            }, error: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });

                $('#btnSaveKeluarga').text('Save');
                $('#btnSaveKeluarga').attr('disabled', false);
            }
        });
    }

    function add_alamat() {
        $('#form_alamat')[0].reset();
        $('#modal_alamat').modal('show');
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadkontak'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#email').val(data.email);
                $('#alamat').val(data.alamat);
                $('#rt').val(data.rt);
                $('#rw').val(data.rw);
                $('#kelurahan').val(data.kelurahan);
                $('#kecamatan').val(data.kecamatan);
                $('#kota').val(data.kota);
                $('#provinsi').val(data.provinsi);
                $('#kdpos').val(data.kdpos);
                $('#tlp_rumah').val(data.tlp_rumah);
                $('#tlp_ponsel').val(data.tlp_ponsel);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_alamat(){
        var email = document.getElementById('email').value;
        var alamat = document.getElementById('alamat').value;
        var rt = document.getElementById('rt').value;
        var rw = document.getElementById('rw').value;
        var kelurahan = document.getElementById('kelurahan').value;
        var kecamatan = document.getElementById('kecamatan').value;
        var kota = document.getElementById('kota').value;
        var provinsi = document.getElementById('provinsi').value;
        var kdpos = document.getElementById('kdpos').value;
        var tlp_rumah = document.getElementById('tlp_rumah').value;
        var tlp_ponsel = document.getElementById('tlp_ponsel').value;
        
        $('#btnSaveAlamat').text('Saving...');
        $('#btnSaveAlamat').attr('disabled', true);

        var form_data = new FormData();
        form_data.append('email', email);
        form_data.append('alamat', alamat);
        form_data.append('rt', rt);
        form_data.append('rw', rw);
        form_data.append('kelurahan', kelurahan);
        form_data.append('kecamatan', kecamatan);
        form_data.append('kota', kota);
        form_data.append('provinsi', provinsi);
        form_data.append('kdpos', kdpos);
        form_data.append('tlp_rumah', tlp_rumah);
        form_data.append('tlp_ponsel', tlp_ponsel);
        
        $.ajax({
            url: "<?php echo base_url('data-pribadi/proseskontak'); ?>",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));    
            },success: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.info({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#modal_alamat').modal('hide');
                reload_alamat();

                $('#btnSaveAlamat').text('Save');
                $('#btnSaveAlamat').attr('disabled', false);

            }, error: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });

                $('#btnSaveAlamat').text('Save');
                $('#btnSaveAlamat').attr('disabled', false);
            }
        });
    }
    
    function add_pegawai(){
        $('#form_pegawai')[0].reset();
        $('#modal_pegawai').modal('show');
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadpegawai'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#nomor_sk').val(data.nomor_sk);
                $('#tmmd').val(data.tmmd);
                $('#sumber_gaji').val(data.sumber_gaji);
                $('#status_aktif').val(data.status_aktif);
                $('#program_studi').val(data.program_studi);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_pegawai(){
        var nomor_sk = document.getElementById('nomor_sk').value;
        var tmmd = document.getElementById('tmmd').value;
        var sumber_gaji = document.getElementById('sumber_gaji').value;
        var status_aktif = document.getElementById('status_aktif').value;
        var program_studi = document.getElementById('program_studi').value;
        
        $('#btnSavePegawai').text('Saving...');
        $('#btnSavePegawai').attr('disabled', true);

        var form_data = new FormData();
        form_data.append('nomor_sk', nomor_sk);
        form_data.append('tmmd', tmmd);
        form_data.append('sumber_gaji', sumber_gaji);
        form_data.append('status_aktif', status_aktif);
        form_data.append('program_studi', program_studi);

        $.ajax({
            url: "<?php echo base_url('data-pribadi/prosespegawai'); ?>",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));    
            },success: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.info({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#modal_pegawai').modal('hide');
                reload_pegawai();

                $('#btnSavePegawai').text('Save');
                $('#btnSavePegawai').attr('disabled', false);

            }, error: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });

                $('#btnSavePegawai').text('Save');
                $('#btnSavePegawai').attr('disabled', false);
            }
        });
    }

    function add_lain(){
        $('#form_lain')[0].reset();
        $('#modal_lain').modal('show');
        $.ajax({
            url: "<?php echo base_url('data-pribadi/loadlain'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#npwp').val(data.npwp);
                $('#nama_npwp').val(data.nama_npwp);
                $('#sinta_id').val(data.sinta_id);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_lain(){
        var npwp = document.getElementById('npwp').value;
        var nama_npwp = document.getElementById('nama_npwp').value;
        var sinta_id = document.getElementById('sinta_id').value;
        
        $('#btnSaveLain').text('Saving...');
        $('#btnSaveLain').attr('disabled', true);

        var form_data = new FormData();
        form_data.append('npwp', npwp);
        form_data.append('nama_npwp', nama_npwp);
        form_data.append('sinta_id', sinta_id);

        $.ajax({
            url: "<?php echo base_url('data-pribadi/proseslain'); ?>",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));    
            },success: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.info({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#modal_lain').modal('hide');
                reload_lain();

                $('#btnSaveLain').text('Save');
                $('#btnSaveLain').attr('disabled', false);

            }, error: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });

                $('#btnSaveLain').text('Save');
                $('#btnSaveLain').attr('disabled', false);
            }
        });
    }

</script>
<?php echo $this->endSection(); ?>