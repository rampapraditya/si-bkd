<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Dilkat <small>Maintenance data diklat</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Diklat</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box">
                    <div class="box-header with-border">
                        <button type="button" class="btn btn-primary btn-sm" onclick="add();"><i class="fa fa-fw fa-plus"></i> Tambah</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="reload();"><i class="fa fa-fw fa-refresh"></i> Reload</button>
                    </div>
                    <div class="box-body">
                        <table id="tb" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Diklat</th>
                                    <th>Jenis Diklat</th>
                                    <th>Penyelenggara</th>
                                    <th>Tahun</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <form id="form" class="form-horizontal">
                    <input type="hidden" name="kode" id="kode">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jenis Diklat</label>
                        <div class="col-sm-8">
                            <select id="jenisdiklat" name="jenisdiklat" class="form-control">
                                <option value="Pelatihan Profesional">Pelatihan Profesional</option>
                                <option value="Lemhanas">Lemhanas</option>
                                <option value="Diklat Prajabatan">Diklat Prajabatan</option>
                                <option value="Diklat Kepemimpinan">Diklat Kepemimpinan</option>
                                <option value="Academic Exchange">Academic Exchange</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Nama Diklat</label>
                        <div class="col-sm-8">
                            <input type="text" name="namadiklat" id="namadiklat" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Penyelenggara</label>
                        <div class="col-sm-8">
                            <input type="text" name="penyelengara" id="penyelengara" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Peran</label>
                        <div class="col-sm-8">
                            <input type="text" name="peran" id="peran" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tingkat</label>
                        <div class="col-sm-8">
                            <select id="tingkat" name="tingkat" class="form-control">
                                <option value="Lokal">Lokal</option>
                                <option value="Regional">Regional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jumlah Jam</label>
                        <div class="col-sm-8">
                            <input type="number" name="jmljam" id="jmljam" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">No. Sertifikat</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_sert" id="no_sert" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Sertifikat</label>
                        <div class="col-sm-8">
                            <input type="date" name="tgl_sert" id="tgl_sert" class="form-control" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tahun Penyelenggaraan</label>
                        <div class="col-sm-8">
                            <input type="number" name="tahun_selenggara" id="tahun_selenggara" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tempat</label>
                        <div class="col-sm-8">
                            <input type="text" name="tempat" id="tempat" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Mulai</label>
                        <div class="col-sm-8">
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Selesai</label>
                        <div class="col-sm-8">
                            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Nomor SK Penugasan</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_sk_penugasan" id="no_sk_penugasan" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal SK Penugasan</label>
                        <div class="col-sm-8">
                            <input type="date" name="tgl_sk_penugasan" id="tgl_sk_penugasan" class="form-control" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSave" type="button" class="btn btn-sm btn-primary" onclick="save();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var save_method;
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url('diklat/ajaxlist'); ?>",
            ordering: false
        });
    });

    function reload() {
        table.ajax.reload(null, false);
    }

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah diklat');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var jenisdiklat = document.getElementById('jenisdiklat').value;
        var namadiklat = document.getElementById('namadiklat').value;
        var penyelengara = document.getElementById('penyelengara').value;
        var peran = document.getElementById('peran').value;
        var tingkat = document.getElementById('tingkat').value;
        var jmljam = document.getElementById('jmljam').value;
        var no_sert = document.getElementById('no_sert').value;
        var tgl_sert = document.getElementById('tgl_sert').value;
        var tahun_selenggara = document.getElementById('tahun_selenggara').value;
        var tempat = document.getElementById('tempat').value;
        var tgl_mulai = document.getElementById('tgl_mulai').value;
        var tgl_selesai = document.getElementById('tgl_selesai').value;
        var no_sk_penugasan = document.getElementById('no_sk_penugasan').value;
        var tgl_sk_penugasan = document.getElementById('tgl_sk_penugasan').value;
        
        if (jenisdiklat === '') {
            iziToast.error({
                title: 'Error',
                message: "Jenis diklat tidak boleh kosong",
                position: 'topRight'
            });
        } else if (namadiklat === '') {
            iziToast.error({
                title: 'Error',
                message: "Nama diklat tidak boleh kosong",
                position: 'topRight'
            });
        } else if (penyelengara === '') {
            iziToast.error({
                title: 'Error',
                message: "Penyelengara tidak boleh kosong",
                position: 'topRight'
            });
        } else if (no_sert === '') {
            iziToast.error({
                title: 'Error',
                message: "Nomor sertifikat tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgl_sert === '') {
            iziToast.error({
                title: 'Error',
                message: "Tanggal sertifikat tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tahun_selenggara === '') {
            iziToast.error({
                title: 'Error',
                message: "Tahun penyelenggaraan tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgl_mulai === '') {
            iziToast.error({
                title: 'Error',
                message: "Tanggal mulai tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgl_selesai === '') {
            iziToast.error({
                title: 'Error',
                message: "Tanggal selesai tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('diklat/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('diklat/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('jenisdiklat', jenisdiklat);
            form_data.append('namadiklat', namadiklat);
            form_data.append('penyelengara', penyelengara);
            form_data.append('peran', peran);
            form_data.append('tingkat', tingkat);
            form_data.append('jmljam', jmljam);
            form_data.append('no_sert', no_sert);
            form_data.append('tgl_sert', tgl_sert);
            form_data.append('tahun_selenggara', tahun_selenggara);
            form_data.append('tempat', tempat);
            form_data.append('tgl_mulai', tgl_mulai);
            form_data.append('tgl_selesai', tgl_selesai);
            form_data.append('no_sk_penugasan', no_sk_penugasan);
            form_data.append('tgl_sk_penugasan', tgl_sk_penugasan);
            
            $.ajax({
                url: url,
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

                    $('#modal_form').modal('hide');
                    reload();

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);

                }, error: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }
    }

    function hapus(id, nama) {
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus diklat nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('diklat/hapus/'); ?>" + id,
                            type: "GET",
                            dataType: "JSON",
                            success: function (data) {
                                iziToast.info({
                                    title: 'Info',
                                    message: data.status,
                                    position: 'topRight'
                                });
                                reload();

                            }, error: function (jqXHR, textStatus, errorThrown) {
                                iziToast.error({
                                    title: 'Error',
                                    message: "Error json " + errorThrown,
                                    position: 'topRight'
                                });
                            }
                        });
                    }
                ],
                [
                    '<button>Close</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);
                    }
                ]
            ]
        });
    }

    function ganti(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Ganti diklat');
        $.ajax({
            url: "<?php echo base_url('diklat/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.iddiklat);
                $('[name="jenisdiklat"]').val(data.jenisdiklat);
                $('[name="namadiklat"]').val(data.namadiklat);
                $('[name="penyelengara"]').val(data.penyelengara);
                $('[name="peran"]').val(data.peran);
                $('[name="tingkat"]').val(data.tingkat);
                $('[name="jmljam"]').val(data.jmljam);
                $('[name="no_sert"]').val(data.no_sert);
                $('[name="tgl_sert"]').val(data.tgl_sert);
                $('[name="tahun_selenggara"]').val(data.tahun_selenggara);
                $('[name="tempat"]').val(data.tempat);
                $('[name="tgl_mulai"]').val(data.tgl_mulai);
                $('[name="tgl_selesai"]').val(data.tgl_selesai);
                $('[name="no_sk_penugasan"]').val(data.no_sk_penugasan);
                $('[name="tgl_sk_penugasan"]').val(data.tgl_sk_penugasan);

            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }
    
</script>
<?php echo $this->endSection(); ?>