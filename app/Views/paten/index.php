<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Paten <small>View data paten</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Paten</li>
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
                                    <th>Jenis</th>
                                    <th>Kategori<br>Capaian</th>
                                    <th>Judul</th>
                                    <th>Tanggal<br>Terbit</th>
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
                        <label class="col-sm-4 control-label">Judul</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="judul" name="judul" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jenis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jenis" name="jenis" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Kategori Capaian</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kategori_capaian" name="kategori_capaian" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Aktivitas Litabmas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="aktivitas_litabmas" name="aktivitas_litabmas" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Terbit</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tautan Ekternal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tautan_external" name="tautan_external" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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
            ajax: "<?php echo base_url('paten/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah paten');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var kategori_keg = document.getElementById('kategori_keg').value;
        var jenis = document.getElementById('jenis').value;
        var kategori_capaian = document.getElementById('kategori_capaian').value;
        var aktivitas_litabmas = document.getElementById('aktivitas_litabmas').value;
        var judul = document.getElementById('judul').value;
        var tgl_terbit = document.getElementById('tgl_terbit').value;
        var jml_hal = document.getElementById('jml_hal').value;
        var penerbit = document.getElementById('penerbit').value;
        var isbn = document.getElementById('isbn').value;
        var tautan_external = document.getElementById('tautan_external').value;
        var keterangan = document.getElementById('keterangan').value;

        if (jenis === '') {
            iziToast.error({
                title: 'Error',
                message: "Jenis tidak boleh kosong",
                position: 'topRight'
            });
        } else if (judul === '') {
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
                url = "<?php echo base_url('publikasi/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('publikasi/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('kategori_keg', kategori_keg);
            form_data.append('jenis', jenis);
            form_data.append('kategori_capaian', kategori_capaian);
            form_data.append('aktivitas_litabmas', aktivitas_litabmas);
            form_data.append('judul', judul);
            form_data.append('tgl_terbit', tgl_terbit);
            form_data.append('jml_hal', jml_hal);
            form_data.append('penerbit', penerbit);
            form_data.append('isbn', isbn);
            form_data.append('tautan_external', tautan_external);
            form_data.append('keterangan', keterangan);
            
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
            message: 'Apakah yakin menghapus publikasi nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('publikasi/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti publikasi');
        $.ajax({
            url: "<?php echo base_url('publikasi/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpublikasi);
                $('[name="kategori_keg"]').val(data.kategori_keg);
                $('[name="jenis"]').val(data.jenis);
                $('[name="kategori_capaian"]').val(data.kategori_capaian);
                $('[name="aktivitas_litabmas"]').val(data.aktivitas_litabmas);
                $('[name="judul"]').val(data.judul);
                $('[name="tgl_terbit"]').val(data.tgl_terbit);
                $('[name="jml_hal"]').val(data.jml_hal);
                $('[name="penerbit"]').val(data.penerbit);
                $('[name="isbn"]').val(data.ISBN);
                $('[name="tautan_external"]').val(data.tautan_external);
                $('[name="keterangan"]').val(data.keterangan);

            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }
    
    function detil(id){
        window.location.href = "<?php echo base_url('publikasi/detil/'); ?>" + id;
    }
</script>
<?php echo $this->endSection(); ?>