<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Bimbingan Dosen <small>Maintenance data bimbingan dosen</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li><a href="<?php echo base_url('bim-mhs'); ?>"> Pengajaran</a></li>
            <li class="active">Bimbingan Dosen</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Dosen</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo trim($head->nama_pangkat.' '.$head->nama_korps.' '.$head->nama); ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th>Semester</th>
                                    <th>Kategori Kegiatan</th>
                                    <th>Judul Bimbingan</th>
                                    <th>Bidang<br>Keilmuan</th>
                                    <th>Jenis<br>Bimbingan</th>
                                    <th>Program<br>Studi</th>
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
                    <input type="hidden" name="idusers" id="idusers" value="<?php echo $head->idusers; ?>">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Semester</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="semester" name="semester" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Kategori Kegiatan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket_kegiatan" name="ket_kegiatan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Judul Bimbingan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="judul_bimbingan" name="judul_bimbingan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Bidang Keilmuan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="bidang" name="bidang" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jenis Bimbingan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jenis_bimbingan" name="jenis_bimbingan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Program Studi</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="idjurusan" name="idjurusan">
                                <?php
                                foreach ($jurusan as $row) {
                                    echo '<option value="'.$row->idjurusan.'">'.$row->namajurusan.'</option>';
                                }
                                ?>
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
            ajax: "<?php echo base_url('bim-mhs/ajaxlistadmin/').$head->idusers; ?>",
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
        $('.modal-title').text('Tambah bimbingan dosen');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var idusers = document.getElementById('idusers').value;
        var semester = document.getElementById('semester').value;
        var ket_kegiatan = document.getElementById('ket_kegiatan').value;
        var judul_bimbingan = document.getElementById('judul_bimbingan').value;
        var bidang = document.getElementById('bidang').value;
        var jenis_bimbingan = document.getElementById('jenis_bimbingan').value;
        var idjurusan = document.getElementById('idjurusan').value;
        
        if (idusers === '') {
            iziToast.error({
                title: 'Error',
                message: "Dosen tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('bim-mhs/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('bim-mhs/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('idusers', idusers);
            form_data.append('semester', semester);
            form_data.append('ket_kegiatan', ket_kegiatan);
            form_data.append('judul_bimbingan', judul_bimbingan);
            form_data.append('bidang', bidang);
            form_data.append('jenis_bimbingan', jenis_bimbingan);
            form_data.append('idjurusan', idjurusan);
            
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
    }

    function hapus(id, nama) {
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus bimbingan mahasiswa nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('bim-mhs/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti bimbingan dosen');
        $.ajax({
            url: "<?php echo base_url('bim-mhs/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idbimbingan);
                $('[name="semester"]').val(data.semester);
                $('[name="ket_kegiatan"]').val(data.ket_kegiatan);
                $('[name="judul_bimbingan"]').val(data.judul_bimbingan);
                $('[name="bidang"]').val(data.bidang);
                $('[name="jenis_bimbingan"]').val(data.jenis_bimbingan);
                $('[name="idjurusan"]').val(data.idjurusan);
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