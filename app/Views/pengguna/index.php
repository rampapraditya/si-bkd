<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pengguna <small>Maintenance data pengguna</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Pengguna</li>
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
                                    <th>NRP</th>
                                    <th>Personil</th>
                                    <th>Hak Akses</th>
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
                        <label for="username" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nrp" class="col-sm-3 control-label">NRP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nrp" name="nrp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-3 control-label">Jabatan</label>
                        <div class="col-sm-9">
                            <select id="jabatan" name="jabatan" class="form-control">
                                <option value="-">- Pilih Jabatan -</option>
                                <?php
                                foreach ($jabatan as $row) {
                                    ?>
                                <option value="<?php echo $row->idjabatan; ?>"><?php echo $row->nama_jabatan; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satker" class="col-sm-3 control-label">Satker</label>
                        <div class="col-sm-9">
                            <select id="satker" name="satker" class="form-control">
                                <option value="-">- Pilih Satker -</option>
                                <?php
                                foreach ($satker as $row) {
                                    ?>
                                <option value="<?php echo $row->idsatker; ?>"><?php echo $row->namasatker; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pangkat" class="col-sm-3 control-label">Pangkat</label>
                        <div class="col-sm-9">
                            <select id="pangkat" name="pangkat" class="form-control">
                                <option value="-">- Pilih Pangkat -</option>
                                <?php
                                foreach ($pangkat as $row) {
                                    ?>
                                <option value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="korps" class="col-sm-3 control-label">Korps</label>
                        <div class="col-sm-9">
                            <select id="korps" name="korps" class="form-control">
                                <option value="-">- Pilih Korps -</option>
                                <?php
                                foreach ($korps as $row) {
                                    ?>
                                <option value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                    <?php
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
            ajax: "<?php echo base_url('pengguna/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah pengguna');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var jabatan = document.getElementById('jabatan').value;
        var satker = document.getElementById('satker').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        
        if (username === "") {
            iziToast.error({
                title: 'Error',
                message: "Username tidak boleh kosong",
                position: 'topRight'
            });
        } else if(email === ""){
            iziToast.error({
                title: 'Error',
                message: "Email tidak boleh kosong",
                position: 'topRight'
            });
        } else if(nrp === ""){
            iziToast.error({
                title: 'Error',
                message: "NRP tidak boleh kosong",
                position: 'topRight'
            });
        } else if(nama === ""){
            iziToast.error({
                title: 'Error',
                message: "Nama tidak boleh kosong",
                position: 'topRight'
            });
        } else if(jabatan === "-"){
            iziToast.error({
                title: 'Error',
                message: "Jabatan tidak boleh kosong",
                position: 'topRight'
            });
        } else if(satker === "-"){
            iziToast.error({
                title: 'Error',
                message: "Satker tidak boleh kosong",
                position: 'topRight'
            });
        } else if(pangkat === "-"){
            iziToast.error({
                title: 'Error',
                message: "Pangkat tidak boleh kosong",
                position: 'topRight'
            });
        } else if(korps === "-"){
            iziToast.error({
                title: 'Error',
                message: "Korps tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('pengguna/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('pengguna/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('username', username);
            form_data.append('email', email);
            form_data.append('nrp', nrp);
            form_data.append('nama', nama);
            form_data.append('jabatan', jabatan);
            form_data.append('satker', satker);
            form_data.append('pangkat', pangkat);
            form_data.append('korps', korps);
            
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
            message: 'Apakah yakin menghapus pengguna ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('pengguna/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti pengguna');
        $.ajax({
            url: "<?php echo base_url('pengguna/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idusers);
                $('[name="username"]').val(data.username);
                $('[name="email"]').val(data.email);
                $('[name="nrp"]').val(data.nrp);
                $('[name="nama"]').val(data.nama);
                $('[name="jabatan"]').val(data.idjabatan);
                $('[name="satker"]').val(data.idsatker);
                $('[name="pangkat"]').val(data.idpangkat);
                $('[name="korps"]').val(data.idkorps);
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
        window.location.href = "<?php echo base_url('pengguna/detil/') ?>" + id;
    }
    
</script>
<?php echo $this->endSection(); ?>