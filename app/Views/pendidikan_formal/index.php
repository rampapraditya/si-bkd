<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pendidikan Formal <small>Maintenance data pendidikan formal</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Pendidikan Formal</li>
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
                                    <th>Jenjang</th>
                                    <th>Gelar</th>
                                    <th>Bidang Studi</th>
                                    <th>Perguruan<br>Tinggi</th>
                                    <th>Lulus</th>
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
                        <label class="col-sm-5 control-label">Perguruan Tinggi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="pt" name="pt" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Nomor Induk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="noinduk" name="noinduk" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Jenjang</label>
                        <div class="col-sm-7">
                            <select id="jenjang" name="jenjang" class="form-control">
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Program Studi</label>
                        <div class="col-sm-7">
                            <select id="program_studi" name="program_studi" class="form-control">
                                <?php
                                foreach ($jurusan as $row) {
                                    ?>
                                <option value="<?php echo $row->idjurusan; ?>"><?php echo $row->namajurusan; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Gelar Akademik</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="gelar" name="gelar" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Bidang Studi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="bidang" name="bidang" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Tahun Masuk</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Tanggal Lulus</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="tgl_lulus" name="tgl_lulus" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">IPK</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="ipk" name="ipk" autocomplete="off" onkeypress="return hanyaAngka(event, true);">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Nomor Ijazah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">Judul Skripsi / Tesis / Disertasi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="judul_tesis" name="judul_tesis" autocomplete="off">
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
            ajax: "<?php echo base_url('pend-formal/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah pendidikan formal');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var pt = document.getElementById('pt').value;
        var noinduk = document.getElementById('noinduk').value;
        var jenjang = document.getElementById('jenjang').value;
        var program_studi = document.getElementById('program_studi').value;
        var gelar = document.getElementById('gelar').value;
        var bidang = document.getElementById('bidang').value;
        var tahun_masuk = document.getElementById('tahun_masuk').value;
        var tgl_lulus = document.getElementById('tgl_lulus').value;
        var ipk = document.getElementById('ipk').value;
        var no_ijazah = document.getElementById('no_ijazah').value;
        var judul_tesis = document.getElementById('judul_tesis').value;

        if (pt === "") {
            iziToast.error({
                title: 'Error',
                message: "Perguruan tinggi terlebih dahulu",
                position: 'topRight'
            });
        } else if (tahun_masuk === "") {
            iziToast.error({
                title: 'Error',
                message: "Tahun masuk tidak boleh kosong",
                position: 'topRight'
            });
        } else if (tgl_lulus === "") {
            iziToast.error({
                title: 'Error',
                message: "Tanggal lulus tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('pend-formal/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('pend-formal/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('pt', pt);
            form_data.append('noinduk', noinduk);
            form_data.append('jenjang', jenjang);
            form_data.append('program_studi', program_studi);
            form_data.append('gelar', gelar);
            form_data.append('bidang', bidang);
            form_data.append('tahun_masuk', tahun_masuk);
            form_data.append('tgl_lulus', tgl_lulus);
            form_data.append('ipk', ipk);
            form_data.append('no_ijazah', no_ijazah);
            form_data.append('judul_tesis', judul_tesis);
            
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
            message: 'Apakah yakin menghapus pendidikan formal nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('pend-formal/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti pendidikan formal');
        $.ajax({
            url: "<?php echo base_url('pend-formal/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpendformal);
                $('[name="jenjang"]').val(data.jenjang);
                $('[name="pt"]').val(data.pt);
                $('[name="noinduk"]').val(data.noinduk);
                $('[name="program_studi"]').val(data.program_studi);
                $('[name="gelar"]').val(data.gelar);
                $('[name="bidang"]').val(data.bidang);
                $('[name="tahun_masuk"]').val(data.tahun_masuk);
                $('[name="tgl_lulus"]').val(data.tgl_lulus);
                $('[name="ipk"]').val(data.ipk);
                $('[name="no_ijazah"]').val(data.no_ijazah);
                $('[name="judul_tesis"]').val(data.judul_tesis);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data');
            }
        });
    }
    
</script>
<?php echo $this->endSection(); ?>