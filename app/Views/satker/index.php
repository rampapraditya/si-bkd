<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Satker <small>Maintenance data satker</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Satker</li>
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
                                    <th>Satker</th>
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
                        <label for="nama" class="col-sm-3 control-label">Satker</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
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
            ajax: "<?php echo base_url('satker/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah satker');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var nama = document.getElementById('nama').value;
        
        if (nama === '') {
            iziToast.error({
                title: 'Error',
                message: "Nama satker tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('satker/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('satker/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('nama', nama);
            
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
            message: 'Apakah yakin menghapus satker ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('satker/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti satker');
        $.ajax({
            url: "<?php echo base_url('satker/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idsatker);
                $('[name="nama"]').val(data.namasatker);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data');
            }
        });
    }
    
</script>
<?php echo $this->endSection(); ?>