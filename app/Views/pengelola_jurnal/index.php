<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pengelola Jurnal <small>View data pengabdian</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Pengelola Jurnal</li>
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
                                    <th>Nama Jurnal</th>
                                    <th>No SK</th>
                                    <th>Tanggal<br>Mulai</th>
                                    <th>Tanggal<br>Selesai</th>
                                    <th>Status Aktif</th>
                                    <th>Peran</th>
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
                        <label class="col-sm-4 control-label">Nama Jurnal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namajurnal" name="namajurnal" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Nomor SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nosk" name="nosk" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Mulai</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Selesai</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Status Aktif</label>
                        <div class="col-sm-8">
                            <select id="status" name="status" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Peran</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="peran" name="peran" autocomplete="off">
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
            ajax: "<?php echo base_url('pengelolajurnal/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah pengelola jurnal');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var namajurnal = document.getElementById('namajurnal').value;
        var nosk = document.getElementById('nosk').value;
        var tgl_mulai = document.getElementById('tgl_mulai').value;
        var tgl_selesai = document.getElementById('tgl_selesai').value;
        var status = document.getElementById('status').value;
        var peran = document.getElementById('peran').value;

        if (namajurnal === '') {
            iziToast.error({
                title: 'Error',
                message: "Nama jurnal tidak boleh kosong",
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
                url = "<?php echo base_url('pengelolajurnal/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('pengelolajurnal/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('namajurnal', namajurnal);
            form_data.append('nosk', nosk);
            form_data.append('tgl_mulai', tgl_mulai);
            form_data.append('tgl_selesai', tgl_selesai);
            form_data.append('status', status);
            form_data.append('peran', peran);
            
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
            message: 'Apakah yakin menghapus pengelola jurnal nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('pengelolajurnal/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti pengelola jurnal');
        $.ajax({
            url: "<?php echo base_url('pengelolajurnal/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpengelolajurnal);
                $('[name="namajurnal"]').val(data.nama_jurnal);
                $('[name="nosk"]').val(data.sk);
                $('[name="tgl_mulai"]').val(data.tgl_mulai);
                $('[name="tgl_selesai"]').val(data.tgl_selesai);
                $('[name="status"]').val(data.status_aktif);
                $('[name="peran"]').val(data.peran);
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