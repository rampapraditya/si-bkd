<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Riwayat Pekerjaan <small>Maintenance data riwayat kerja</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Riwayat Pekerjaan</li>
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
                                    <th>Bidang Usaha</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Jabatan</th>
                                    <th>Instansi</th>
                                    <th>Divisi</th>
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
                        <label class="col-sm-4 control-label">Bidang Usaha</label>
                        <div class="col-sm-8">
                            <select id="bidang_usaha" name="bidang_usaha" class="form-control">
                                <option>Pertanian, Kehutanan, dan Perikanan</option>
                                <option>Pertambangan dan Penggalian</option>
                                <option>Industri Pengolahan</option>
                                <option>Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin</option>
                                <option>Pengolahan Ait, Pengelolaan Air Limbah, Penglolaan dan Daur Ulang Sampah, dan Aktivitas Remediasi</option>
                                <option>Konstruksi</option>
                                <option>Perdagangan Besar dan Eceran; Reparasi dan Perawatan Mobil dan Sepeda Motor</option>
                                <option>Pengangkutan dan pergudangan</option>
                                <option>Penyediaan Akomodasi dan Penyediaan Makan Minum</option>
                                <option>Informasi Dan Komunikasi</option>
                                <option>Aktivitas Keuangan Dan Asuransi</option>
                                <option>Real Estat</option>
                                <option>Aktivitas Penyewaan dan Sewa Guna Usaha Tanpa Hak Opsi, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya</option>
                                <option>Administrasi Pemerintahan, Pertahan dan Jaminan Sosial Wajib</option>
                                <option>Pendidikan</option>
                                <option>Aktivitas Kesehatan Manusia Dan Aktivitas Sosial</option>
                                <option>Kesenian, Hiburan dan Rekreasi</option>
                                <option>Aktivitas Jasa Lainnya</option>
                                <option>Aktivitas Rumah Tangga Sebagai Pemberi Kerja</option>
                                <option>Aktivitas Badan Internasional Dan Badan Extra Internasional Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jenis Pekerjaan</label>
                        <div class="col-sm-8">
                            <select id="jenis_pekerjaan" name="jenis_pekerjaan" class="form-control">
                                <option>Peneliti</option>
                                <option>Tim Ahli/Konsultasi</option>
                                <option>Magang</option>
                                <option>Tenaga Pengajar / Instruktur / Fasilitator</option>
                                <option>Pimpinan / Manajerial</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jabatan</label>
                        <div class="col-sm-8">
                            <input type="text" name="jabatan" id="jabatan" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Instansi</label>
                        <div class="col-sm-8">
                            <input type="text" name="instansi" id="instansi" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Divisi</label>
                        <div class="col-sm-8">
                            <input type="text" name="divisi" id="divisi" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Deskripsi Kerja</label>
                        <div class="col-sm-8">
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Mulai Bekerja</label>
                        <div class="col-sm-8">
                            <input type="date" name="mulai_kerja" id="mulai_kerja" class="form-control" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Selesai Bekerja</label>
                        <div class="col-sm-8">
                            <input type="date" name="selesai_kerja" id="selesai_kerja" class="form-control" autocomplete="off" value="<?php echo $curdate; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Area Pekerjaan</label>
                        <div class="col-sm-8">
                            <select id="area" name="area" class="form-control">
                                <option>Dalam Negeri</option>
                                <option>Luar Negeri</option>
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
            ajax: "<?php echo base_url('riwayat-kerja/ajaxlist'); ?>",
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
        $('.modal-title').text('Tambah riwayat kerja');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var bidang_usaha = document.getElementById('bidang_usaha').value;
        var jenis_pekerjaan = document.getElementById('jenis_pekerjaan').value;
        var jabatan = document.getElementById('jabatan').value;
        var instansi = document.getElementById('instansi').value;
        var divisi = document.getElementById('divisi').value;
        var deskripsi = document.getElementById('deskripsi').value;
        var mulai_kerja = document.getElementById('mulai_kerja').value;
        var selesai_kerja = document.getElementById('selesai_kerja').value;
        var area = document.getElementById('area').value;
        
        if (bidang_usaha === '') {
            iziToast.error({
                title: 'Error',
                message: "Bidang usaha tidak boleh kosong",
                position: 'topRight'
            });
        } else if (jenis_pekerjaan === '') {
            iziToast.error({
                title: 'Error',
                message: "Jenis pekerjaan tidak boleh kosong",
                position: 'topRight'
            });
        } else if (jabatan === '') {
            iziToast.error({
                title: 'Error',
                message: "Jabatan tidak boleh kosong",
                position: 'topRight'
            });
        } else if (instansi === '') {
            iziToast.error({
                title: 'Error',
                message: "Instansi tidak boleh kosong",
                position: 'topRight'
            });
        } else if (mulai_kerja === '') {
            iziToast.error({
                title: 'Error',
                message: "Mulai bekerja tidak boleh kosong",
                position: 'topRight'
            });
        } else if (selesai_kerja === '') {
            iziToast.error({
                title: 'Error',
                message: "Selesai bekerja tidak boleh kosong",
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url('riwayat-kerja/ajax_add'); ?>";
            } else {
                url = "<?php echo base_url('riwayat-kerja/ajax_edit'); ?>";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('bidang_usaha', bidang_usaha);
            form_data.append('jenis_pekerjaan', jenis_pekerjaan);
            form_data.append('jabatan', jabatan);
            form_data.append('instansi', instansi);
            form_data.append('divisi', divisi);
            form_data.append('deskripsi', deskripsi);
            form_data.append('mulai_kerja', mulai_kerja);
            form_data.append('selesai_kerja', selesai_kerja);
            form_data.append('area', area);
            
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
            message: 'Apakah yakin menghapus riwayat kerja nomor ' + nama + ' ?',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [
                    '<button>Ok</button>',
                    function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOutUp'}, toast);

                        $.ajax({
                            url: "<?php echo base_url('riwayat-kerja/hapus/'); ?>" + id,
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
        $('.modal-title').text('Ganti diklat');
        $.ajax({
            url: "<?php echo base_url('riwayat-kerja/show/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idriwayat_kerja);
                $('[name="bidang_usaha"]').val(data.bidang_usaha);
                $('[name="jenis_pekerjaan"]').val(data.jenis_pekerjaan);
                $('[name="jabatan"]').val(data.jabatan);
                $('[name="instansi"]').val(data.instansi);
                $('[name="divisi"]').val(data.divisi);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="mulai_kerja"]').val(data.mulai_kerja);
                $('[name="selesai_kerja"]').val(data.selesai_kerja);
                $('[name="area"]').val(data.area);

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