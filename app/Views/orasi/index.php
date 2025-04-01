<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Orasi Ilmiah <small>View data orasi ilmiah</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Orasi Ilmiah</li>
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
                                    <th>Kategori Kegiatan</th>
                                    <th>Judul Makalah</th>
                                    <th>Nama Temu Ilmiah</th>
                                    <th>Penyelenggara</th>
                                    <th>Tanggal<br>Pelaksanaan</th>
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
                        <label class="col-sm-4 control-label">Kategori Kegiatan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kategori" name="kategori" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Judul Makalah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="judul_makalah" name="judul_makalah" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Nama Temu Ilmiah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_temu" name="nama_temu" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Penyelenggara</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Pelaksanaan</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_laksana" name="tgl_laksana" autocomplete="off" value="<?php echo $curdate; ?>">
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
            ajax: "<?php echo base_url('orasi/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah orasi ilmiah');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var kategori = document.getElementById('kategori').value;
        var judul = document.getElementById('judul_makalah').value;
        var nama_temu = document.getElementById('nama_temu').value;
        var penyelenggara = document.getElementById('penyelenggara').value;
        var tgl_laksana = document.getElementById('tgl_laksana').value;

        if (judul === '') {
            iziToast.error({
                title: 'Error',
                message: "Judul tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('orasi/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('orasi/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('kategori', kategori);
            form_data.append('judul', judul);
            form_data.append('nama_temu', nama_temu);
            form_data.append('penyelenggara', penyelenggara);
            form_data.append('tgl_laksana', tgl_laksana);
            
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

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }, error: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }
            });
        }
    }

    function hapus(id, nama) {
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus orasi ilmiah nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('orasi/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti orasi ilmiah');
        $.ajax({
            url: "<?php echo base_url('orasi/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idorasi);
                $('[name="kategori"]').val(data.kategori);
                $('[name="judul_makalah"]').val(data.judul);
                $('[name="nama_temu"]').val(data.nama_temu);
                $('[name="penyelenggara"]').val(data.penyelenggara);
                $('[name="tgl_laksana"]').val(data.tgl_laksana);

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