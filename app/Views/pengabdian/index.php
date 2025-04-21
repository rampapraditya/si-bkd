<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pengabdian <small>View data pengabdian</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Pengabdian</li>
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
                                    <th>Judul</th>
                                    <th>Tahun<br>Pelaksanaan</th>
                                    <th>Lama<br>Kegiatan</th>
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
                        <label class="col-sm-4 control-label">Tahun</label>
                        <div class="col-sm-8">
                            <input type="number" maxlength="4" class="form-control" id="tahun" name="tahun" autocomplete="off" value="<?php echo $tahun; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Afiliasi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="afiliasi" name="afiliasi" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Sk Penugasan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="sk" name="sk" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Penugasan</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Lama Kegiatan</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="lama" name="lama" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Judul</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="judul" name="judul" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Lokasi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lokasi" name="lokasi" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Dana Dikti</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="dana_dikti" name="dana_dikti" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Dana Universitas</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="dana_univ" name="dana_univ" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Dana Lain-lain</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="dana_lain" name="dana_lain" autocomplete="off">
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
            ajax: "<?php echo base_url('pengabdian/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah pengabdian');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var tahun = document.getElementById('tahun').value;
        var afiliasi = document.getElementById('afiliasi').value;
        var sk = document.getElementById('sk').value;
        var tanggal = document.getElementById('tanggal').value;
        var lama = document.getElementById('lama').value;
        var judul = document.getElementById('judul').value;
        var lokasi = document.getElementById('lokasi').value;
        var dana_dikti = document.getElementById('dana_dikti').value;
        var dana_univ = document.getElementById('dana_univ').value;
        var dana_lain = document.getElementById('dana_lain').value;

        if (judul === '') {
            iziToast.error({
                title: 'Error',
                message: "Judul tidak boleh kosong",
                position: 'topRight'
            });
        } else if (afiliasi === '') {
            iziToast.error({
                title: 'Error',
                message: "Affiliasi tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tanggal === '') {
            iziToast.error({
                title: 'Error',
                message: "Tanggal tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('pengabdian/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('pengabdian/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('tahun', tahun);
            form_data.append('afiliasi', afiliasi);
            form_data.append('sk', sk);
            form_data.append('tanggal', tanggal);
            form_data.append('lama', lama);
            form_data.append('judul', judul);
            form_data.append('lokasi', lokasi);
            form_data.append('dana_dikti', dana_dikti);
            form_data.append('dana_univ', dana_univ);
            form_data.append('dana_lain', dana_lain);
            
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
            message: 'Apakah yakin menghapus pengabdian nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('pengabdian/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti pengabdian');
        $.ajax({
            url: "<?php echo base_url('pengabdian/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpengabdian);
                $('[name="tahun"]').val(data.tahun);
                $('[name="afiliasi"]').val(data.afiliasi);
                $('[name="sk"]').val(data.sk_penugasan);
                $('[name="tanggal"]').val(data.tgl_penugasan);
                $('[name="lama"]').val(data.lama);
                $('[name="judul"]').val(data.judul);
                $('[name="lokasi"]').val(data.lokasi);
                $('[name="dana_dikti"]').val(data.dana_dikti);
                $('[name="dana_univ"]').val(data.dana_pt);
                $('[name="dana_lain"]').val(data.dana_lain);

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
        window.location.href = "<?php echo base_url('pengabdian/detil/'); ?>" + id;
    }
</script>
<?php echo $this->endSection(); ?>