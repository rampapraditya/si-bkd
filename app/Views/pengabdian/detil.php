<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Detil Pengabdian <small>View data detil pengabdian</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li><a href="<?php echo base_url('pengabdian'); ?>"> Pengabdian</a></li>
            <li class="active">Detil Pengabdian</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pengabdian</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <input type="hidden" name="idpengabdian" id="idpengabdian" value="<?php echo $idpengabdian; ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->tahun; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Afiliasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->afiliasi; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">SK Penugasan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->sk_penugasan; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal SK Penugasan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->tgl_penugasan; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lama Kegiatan (Tahun)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->lama; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->judul; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lokasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->lokasi; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dana dari Dikti (Rp.)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->dana_dikti; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dana dari Perguruan Tinggi (Rp.)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->dana_pt; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dana dari Instansi Lain (Rp.)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->dana_lain; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Anggota Pengabdian (Dosen)</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary btn-sm" onclick="add('Dosen');"><i class="fa fa-fw fa-plus"></i> Tambah Dosen </button>
                            <button type="button" class="btn btn-default btn-sm" onclick="reload();"><i class="fa fa-fw fa-refresh"></i> Reload</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="tbdosen" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dosen</th>
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
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Anggota Pengabdian (Mahasiswa)</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary btn-sm" onclick="add('Mahasiswa');"><i class="fa fa-fw fa-plus"></i> Tambah Mahasiswa </button>
                            <button type="button" class="btn btn-default btn-sm" onclick="reload();"><i class="fa fa-fw fa-refresh"></i> Reload</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="tbmhs" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mahasiswa</th>
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
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Anggota Non Civitas</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary btn-sm" onclick="add('Non Civitas Akademika');"><i class="fa fa-fw fa-plus"></i> Tambah Non Civitas </button>
                            <button type="button" class="btn btn-default btn-sm" onclick="reload();"><i class="fa fa-fw fa-refresh"></i> Reload</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="tbnon" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Non Civitas</th>
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
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dokumen Penelitian</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary btn-sm" onclick="adddokumen();"><i class="fa fa-fw fa-plus"></i> Tambah Dokumen </button>
                            <button type="button" class="btn btn-default btn-sm" onclick="reload();"><i class="fa fa-fw fa-refresh"></i> Reload</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="tbdokumen" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul Dokumen</th>
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
                    <input type="hidden" name="mode" id="mode">
                    <div class="form-group row">
                        <label id="lbNama" class="col-sm-4 control-label">Nama Anggota</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Peran</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="peran" name="peran" autocomplete="off" placeholder="Peran Anggota">
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

<div class="modal fade" id="modal_dokumen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title-dokumen">Default Modal</h4>
            </div>
            <div class="modal-body">
                <form id="form_dokumen" class="form-horizontal">
                    <input type="hidden" name="kode_dokumen" id="kode_dokumen">    
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Judul Dokumen</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="judul_dokumen" name="judul_dokumen" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Dokumen <br><span style="color: red; font-size: 10px;">Hanya dokumen pdf</span></label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="dokumen" name="dokumen" accept=".pdf">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveDoc" type="button" class="btn btn-sm btn-primary" onclick="savedoc();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var save_method;
    var tbdosen, tbmhs, tbnon, tbdokumen;

    $(document).ready(function () {
        tbdosen = $('#tbdosen').DataTable({
            ajax: "<?php echo base_url('pengabdian/ajaxdosen/'.$idpengabdian); ?>",
            ordering: false
        });

        tbmhs = $('#tbmhs').DataTable({
            ajax: "<?php echo base_url('pengabdian/ajaxmhs/'.$idpengabdian); ?>",
            ordering: false
        });

        tbnon = $('#tbnon').DataTable({
            ajax: "<?php echo base_url('pengabdian/ajaxnoncivitas/'.$idpengabdian); ?>",
            ordering: false
        });

        tbdokumen = $('#tbdokumen').DataTable({
            ajax: "<?php echo base_url('pengabdian/ajaxdokumen/'.$idpengabdian); ?>",
            ordering: false
        });
    });

    function reload() {
        tbdosen.ajax.reload(null, false);
        tbmhs.ajax.reload(null, false);
        tbnon.ajax.reload(null, false);
        tbdokumen.ajax.reload(null, false);
    }

    function add(param) {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('#lbNama').text('Nama ' + param);
        $('#nama').attr('placeholder', 'Nama ' + param);
        $('#mode').val(param);
        $('.modal-title').text('Tambah Anggota ' + param);
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var idpengabdian = document.getElementById('idpengabdian').value;
        var mode = document.getElementById('mode').value;
        var nama = document.getElementById('nama').value;
        var peran = document.getElementById('peran').value;

        if (mode === '') {
            iziToast.error({
                title: 'Error',
                message: "Mode tidak boleh kosong",
                position: 'topRight'
            });
        } else if (nama === '') {
            iziToast.error({
                title: 'Error',
                message: "Nama anggota tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('pengabdian/ajax_add_member'); ?>";
            } else {
                url = "<?php echo base_url('pengabdian/ajax_edit_member'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('idpengabdian', idpengabdian);
            form_data.append('mode', mode);
            form_data.append('nama', nama);
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

    function hapus(id, nama, mode) {
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus pengabdian ' + mode + ' nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        var url = "";
                        if (mode === 'Dosen') {
                            url = "<?php echo base_url('pengabdian/hapusdosen/'); ?>" + id;
                        } else if (mode === 'Mahasiswa') {
                            url = "<?php echo base_url('pengabdian/hapusmhs/'); ?>" + id;
                        } else {
                            url = "<?php echo base_url('pengabdian/hapusnon/'); ?>" + id;
                        }

                        $.ajax({
                            url: url,
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

    function ganti(id, mode) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('#lbNama').text('Nama ' + mode);
        $('#nama').attr('placeholder', 'Nama ' + mode);
        $('#mode').val(mode);
        $('.modal-title').text('Ganti Anggota ' + mode);
        
        if(mode === 'Dosen') {
            $.ajax({
                url: "<?php echo base_url('pengabdian/show_member_dosen/'); ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('[name="kode"]').val(data.idpengabdian_dosen);
                    $('[name="idpengabdian"]').val(data.idpengabdian);
                    $('[name="nama"]').val(data.nama);
                    $('[name="peran"]').val(data.peran);

                }, error: function (jqXHR, textStatus, errorThrown) {
                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });
                }
            });
        } else if (mode === 'Mahasiswa') {
            $.ajax({
                url: "<?php echo base_url('pengabdian/show_member_mhs/'); ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('[name="kode"]').val(data.idpengabdian_mhs);
                    $('[name="idpengabdian"]').val(data.idpengabdian);
                    $('[name="nama"]').val(data.nama);
                    $('[name="peran"]').val(data.peran);

                }, error: function (jqXHR, textStatus, errorThrown) {
                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });
                }
            });
        } else {
            $.ajax({
                url: "<?php echo base_url('pengabdian/show_member_non/'); ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('[name="kode"]').val(data.idpengabdian_lain);
                    $('[name="idpengabdian"]').val(data.idpengabdian);
                    $('[name="nama"]').val(data.nama);
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
    }
    
    function adddokumen(){
        save_method = 'add';
        $('#form_dokumen')[0].reset();
        $('#modal_dokumen').modal('show');
        $('.modal-title-dokumen').text('Tambah Dokumen Pengabdian');
    }

    function savedoc(){
        var kode = document.getElementById('kode_dokumen').value;
        var idpengabdian = document.getElementById('idpengabdian').value;
        var judul = document.getElementById('judul_dokumen').value;
        var file = $('#dokumen').prop('files')[0];
        
        if(judul === ""){
            iziToast.success({
                title: 'Info',
                message: 'Judul dokumen tidak boleh kosong',
                position: 'topRight'
            });
        } else {
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('idpengabdian', idpengabdian);
            form_data.append('judul', judul);
            form_data.append('file', file);

            $('#btnSaveDoc').text('Saving...');
            $('#btnSaveDoc').attr('disabled',true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('pengabdian/ajax_add_dokumen'); ?>";
            } else {
                url = "<?php echo base_url('pengabdian/ajax_edit_dokumen'); ?>";
            }

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

                    $('#btnSaveDoc').text('Save');
                    $('#btnSaveDoc').attr('disabled',false);

                    if(response.status === "Data tersimpan"){
                        iziToast.info({
                            title: 'Info',
                            message: response.status,
                            position: 'topRight'
                        });
                        
                        $('#modal_dokumen').modal('hide');
                        reload();
                    } else {
                        iziToast.warning({
                            title: 'Info',
                            message: response.status,
                            position: 'topRight'
                        });
                    }

                }, error: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);
                    
                    iziToast.error({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });
                    
                    $('#btnSaveDoc').text('Save');
                    $('#btnSaveDoc').attr('disabled',false);
                }
            });
        }
    }

    function unduh(file){
        window.open("<?php echo base_url('pengabdian/unduh/'); ?>"+file, '_blank');
    }

    function hapusdoc(id, no){
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus dokumen pengabdian nomor ' + no + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('pengabdian/hapusdokumen/'); ?>" + id,
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

    function gantidoc(id){
        save_method = 'update';
        $('#form_dokumen')[0].reset();
        $('#modal_dokumen').modal('show');
        $('.modal-title-dokumen').text('Ganti Dokumen Pengabdian');
        $.ajax({
            url: "<?php echo base_url('pengabdian/showdokumen/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode_dokumen"]').val(data.idpengabdian_doc);
                $('[name="judul_dokumen"]').val(data.judul_dokumen);
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