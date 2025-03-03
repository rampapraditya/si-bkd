<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Penempatan <small>Maintenance data penempatan</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Penempatan</li>
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
                                    <th>Status</th>
                                    <th>Ikatan<br>Kerja</th>
                                    <th>Jenjang<br>Pendidikan</th>
                                    <th>Unit</th>
                                    <th>Perguruan<br>Tinggi</th>
                                    <th>Terhitung<br>Mulai</th>
                                    <th>Tanggal<br>Keluar</th>
                                    <th>Terhitung<br>Selesai</th>
                                    <th>Homebase<br>Penugasan</th>
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
                        <label class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-8">
                            <select id="status" name="status" class="form-control">
                                <option value="NON PNS">NON PNS</option>
                                <option value="PNS">PNS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Ikatan Kerja</label>
                        <div class="col-sm-8">
                            <select id="ikatan" name="ikatan" class="form-control">
                                <option value="Dosen Tetap">Dosen Tetap</option>
                                <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jenjang</label>
                        <div class="col-sm-8">
                            <select id="jenjang" name="jenjang" class="form-control">
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Unit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="unit" name="unit" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Perguruan Tinggi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pt" name="pt" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Terhitung Mulai</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="mulai" name="mulai" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Keluar</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="keluar" name="keluar" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Terhitung Selesai</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="selesai" name="selesai" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Homebase</label>
                        <div class="col-sm-8">
                            <select id="homebase" name="homebase" class="form-control">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
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
            ajax: "<?php echo base_url('penempatan/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah penempatan');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var status = document.getElementById('status').value;
        var ikatan = document.getElementById('ikatan').value;
        var jenjang = document.getElementById('jenjang').value;
        var unit = document.getElementById('unit').value;
        var pt = document.getElementById('pt').value;
        var mulai = document.getElementById('mulai').value;
        var keluar = document.getElementById('keluar').value;
        var selesai = document.getElementById('selesai').value;
        var homebase = document.getElementById('homebase').value;
        
        $('#btnSave').text('Saving...');
        $('#btnSave').attr('disabled', true);

        var url = "";
        if (save_method === 'add') {
            url = "<?php echo base_url('penempatan/ajax_add'); ?>";
        } else {
            url = "<?php echo base_url('penempatan/ajax_edit'); ?>";
        }
        
        var form_data = new FormData();
        form_data.append('kode', kode);
        form_data.append('status', status);
        form_data.append('ikatan', ikatan);
        form_data.append('jenjang', jenjang);
        form_data.append('unit', unit);
        form_data.append('pt', pt);
        form_data.append('mulai', mulai);
        form_data.append('keluar', keluar);
        form_data.append('selesai', selesai);
        form_data.append('homebase', homebase);
        
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

                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

    function hapus(id, nama) {
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus penempatan nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('penempatan/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti penempatan');
        $.ajax({
            url: "<?php echo base_url('penempatan/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpenempatan);
                $('[name="status"]').val(data.status);
                $('[name="ikatan"]').val(data.ikatan_kerja);
                $('[name="jenjang"]').val(data.jenjang);
                $('[name="unit"]').val(data.unit);
                $('[name="pt"]').val(data.pt);
                $('[name="mulai"]').val(data.mulai);
                $('[name="keluar"]').val(data.keluar);
                $('[name="selesai"]').val(data.selesai);
                $('[name="homebase"]').val(data.home_base);

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