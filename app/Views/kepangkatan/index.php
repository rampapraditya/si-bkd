<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Kepangkatan <small>Maintenance data kepangkatan</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Kepangkatan</li>
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
                                    <th>Golongan</th>
                                    <th>No SK</th>
                                    <th>Tgl SK</th>
                                    <th>Tgl Mulai</th>
                                    <th>Masa Kerja<br>Tahun</th>
                                    <th>Masa Kerja<br>Bulan</th>
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
                        <label class="col-sm-4 control-label">Golongan</label>
                        <div class="col-sm-8">
                            <select id="golongan" name="golongan" class="form-control">
                                <option value="-">- Pilih Golongan -</option>
                                <?php
                                foreach ($golongan as $row) {
                                    ?>
                                <option value="<?php echo $row->idgolongan; ?>"><?php echo $row->nama_golongan; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Nomor SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nomor_sk" name="nomor_sk" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal SK</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_sk" name="tgl_sk" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Mulai</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Masa Kerja (Tahun)</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="kerja_tahun" name="kerja_tahun" autocomplete="off" onkeypress="return hanyaAngka(event, false);">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Masa Kerja (Bulan)</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="kerja_bulan" name="kerja_bulan" autocomplete="off" onkeypress="return hanyaAngka(event, false);">
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
            ajax: "<?php echo base_url('kepangkatan/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah kepangkatan');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var golongan = document.getElementById('golongan').value;
        var nomor_sk = document.getElementById('nomor_sk').value;
        var tgl_sk = document.getElementById('tgl_sk').value;
        var tgl_mulai = document.getElementById('tgl_mulai').value;
        var kerja_tahun = document.getElementById('kerja_tahun').value;
        var kerja_bulan = document.getElementById('kerja_bulan').value;
        
        if (golongan === "-") {
            iziToast.error({
                title: 'Error',
                message: "Pilih golongan terlebih dahulu",
                position: 'topRight'
            });
        } else if (nomor_sk === "") {
            iziToast.error({
                title: 'Error',
                message: "Nomor SK tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgl_sk === "") {
            iziToast.error({
                title: 'Error',
                message: "Tanggal SK tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgl_mulai === "") {
            iziToast.error({
                title: 'Error',
                message: "Tanggal mulai tidak boleh kosong",
                position: 'topRight'
            });
        } else if (kerja_tahun === "") {
            iziToast.error({
                title: 'Error',
                message: "Masa kerja (tahun) tidak boleh kosong",
                position: 'topRight'
            });
        } else if (kerja_bulan === "") {
            iziToast.error({
                title: 'Error',
                message: "Masa kerja (bulan) tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('kepangkatan/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('kepangkatan/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('golongan', golongan);
            form_data.append('nomor_sk', nomor_sk);
            form_data.append('tgl_sk', tgl_sk);
            form_data.append('tgl_mulai', tgl_mulai);
            form_data.append('kerja_tahun', kerja_tahun);
            form_data.append('kerja_bulan', kerja_bulan);
            
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
            message: 'Apakah yakin menghapus kepangkatan nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('kepangkatan/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti kepangkatan');
        $.ajax({
            url: "<?php echo base_url('kepangkatan/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idkepangkatan);
                $('[name="golongan"]').val(data.idgolongan);
                $('[name="nomor_sk"]').val(data.nomor_sk);
                $('[name="tgl_sk"]').val(data.tgl_sk);
                $('[name="mulai_tgl"]').val(data.mulai_tgl);
                $('[name="kerja_tahun"]').val(data.masa_kerja_gol_tahun);
                $('[name="kerja_bulan"]').val(data.masa_kerja_gol_bulan);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data');
            }
        });
    }
    
</script>
<?php echo $this->endSection(); ?>