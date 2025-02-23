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
                                <button type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: center;" rowspan="5">
                                            <img class="img-thumbnail" src="<?php echo $foto; ?>" style="max-width: 150px; height: auto;">
                                        </td>
                                        <td style="text-align: right;">NIDN</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Nama</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><?php echo $head->nama; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Jenis Kelamin</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><?php echo $head->nama; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Tempat Lahir</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><?php echo $head->nama; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Tanggal Lahir</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td><?php echo $head->nama; ?></td>
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
                                <button type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">NIK</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Agama</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kewarganegaraan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
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
                                <button type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">Status Perkawinan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Nama Suami/Istri</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">NIP Suami/Istri</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Pekerjaan Suami/Istri</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
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
                                <button type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">Email</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Alamat</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">RT</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">RW</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Desa / Kelurahan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kecamatan / Kota / Kabupaten</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Provinsi</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Kode Pos</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">No. Telepon Rumah</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">No Ponsel</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
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
                                <button type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">Nomor SK TMMD</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">TMMD</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Sumber Gaji</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Status Keaktifan</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Program Studi</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
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
                                <button type="button" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                            </div>
                            <div class="box-body">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">NPWP</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Nama Wajib Pajak</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">SINTA ID</td>
                                        <td style="text-align: center;">&nbsp; : &nbsp;</td>
                                        <td></td>
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

<div class="modal fade" id="modal_fakultas_jurusan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Fakultas & Jurusan</h4>
            </div>
            <div class="modal-body">
                <form id="form_fakultas_jurusan" class="form-horizontal">
                    <input type="hidden" name="idusers_fakultas_jurusan" id="idusers_fakultas_jurusan" readonly autocomplete="off">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 control-label">Fakultas</label>
                        <div class="col-sm-9">
                            <select id="fakultas_modal" name="fakultas_modal" class="form-control" onchange="load_jurusan(this.value)">
                                <option value="-">- Pilih Fakultas -</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 control-label">Jurusan</label>
                        <div class="col-sm-9">
                            <select id="jurusan_modal" name="jurusan_modal" class="form-control">
                                <option value="-">- Pilih Jurusan -</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveFakultasJurusan" type="button" class="btn btn-sm btn-primary" onclick="save_fak_jur();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        reload();
    });

    
    
</script>
<?php echo $this->endSection(); ?>