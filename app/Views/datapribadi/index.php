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

<script type="text/javascript">

    $(document).ready(function () {
        reload_profile();
        reload_penduduk();
        reload_keluarga();
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

                    $('#btnSavePenduduk').text('Save'); //change button text
                    $('#btnSavePenduduk').attr('disabled', false); //set button enable 
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
        var nik = document.getElementById('nik').value;
        var agama = document.getElementById('agama').value;
        var kwn = document.getElementById('kwn').value;
        
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

                $('#btnSavePenduduk').text('Save'); //change button text
                $('#btnSavePenduduk').attr('disabled', false); //set button enable 
            }
        });
    }
    
</script>
<?php echo $this->endSection(); ?>