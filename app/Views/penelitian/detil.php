<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Detil Penelitian <small>View data detil penelitian</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li><a href="<?php echo base_url('penelitian'); ?>"> Penelitian</a></li>
            <li class="active">Detil Penelitian</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Penelitian</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Judul Kegiatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->judul; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Afiliasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->afiliasi; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kelompok Bidang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->kelompok_bidang; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->lokasi; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun Usulan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->tahun_usulan; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun Kegiatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->tahun_kegiatan; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun Pelaksanaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->tahun_pelaksanaan; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lama Kegiatan (Tahun)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->lama; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun Pelaksanaan Ke</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->tahun_ke; ?>" autocomplete="off" readonly>
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
                                    <input type="text" class="form-control" value="<?php echo $head->dana_univ; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dana dari Instansi Lain (Rp.)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $head->dana_ins_lain; ?>" autocomplete="off" readonly>
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
                        <h3 class="box-title">Anggota Kegiatan (Dosen)</h3>
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
                        <h3 class="box-title">Anggota Kegiatan (Mahasiswa)</h3>
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
                    <input type="hidden" name="idpenelitian" id="idpenelitian" value="<?php echo $idpenelitian; ?>">
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

<script type="text/javascript">

    var save_method;
    var tbdosen, tbmhs, tbnon;

    $(document).ready(function () {
        tbdosen = $('#tbdosen').DataTable({
            ajax: "<?php echo base_url('penelitian/ajaxdosen/'.$idpenelitian); ?>",
            ordering: false
        });

        tbmhs = $('#tbmhs').DataTable({
            ajax: "<?php echo base_url('penelitian/ajaxmhs/'.$idpenelitian); ?>",
            ordering: false
        });

        tbnon = $('#tbnon').DataTable({
            ajax: "<?php echo base_url('penelitian/ajaxnoncivitas/'.$idpenelitian); ?>",
            ordering: false
        });
    });

    function reload() {
        tbdosen.ajax.reload(null, false);
        tbmhs.ajax.reload(null, false);
        tbnon.ajax.reload(null, false);
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
        var idpenelitian = document.getElementById('idpenelitian').value;
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
                url = "<?php echo base_url('penelitian/ajax_add_member'); ?>";
            } else {
                url = "<?php echo base_url('penelitian/ajax_edit_member'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('idpenelitian', idpenelitian);
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

    function hapus(id, nama) {
        iziToast.show({
            color: 'dark',
            icon: 'fa fa-fw fa-question',
            title: 'Konfirmasi',
            message: 'Apakah yakin menghapus penelitian nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('penelitian/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti penelitian');
        $.ajax({
            url: "<?php echo base_url('penelitian/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpenelitian);
                $('[name="judul"]').val(data.judul);
                $('[name="afiliasi"]').val(data.afiliasi);
                $('[name="bidang"]').val(data.kelompok_bidang);
                $('[name="lokasi"]').val(data.lokasi);
                $('[name="tahun_usulan"]').val(data.tahun_usulan);
                $('[name="tahun_kegiatan"]').val(data.tahun_kegiatan);
                $('[name="tahun_laksana"]').val(data.tahun_pelaksanaan);
                $('[name="lama"]').val(data.lama);
                $('[name="tahun_ke"]').val(data.tahun_ke);
                $('[name="sk"]').val(data.no_sk);
                $('[name="tglsk"]').val(data.tgl_sk);
                $('[name="dana_dikti"]').val(data.dana_dikti);
                $('[name="dana_univ"]').val(data.dana_univ);
                $('[name="dana_lain"]').val(data.dana_ins_lain);

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