<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Dosen <small>Maintenance data detil dosen</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li><a href="<?php echo base_url('pengguna'); ?>"> Pengguna</a></li>
            <li class="active">Detil Dosen</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fakultas dan Jurusan Dosen</h3>
                        <button type="button" class="btn btn-primary btn-sm pull-right" onclick="fakultas_jurusan('<?php echo $head->idusers; ?>');"><i class="fa fa-fw fa-refresh"></i> Fakultas & Jurusan</button>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $head->nama_pangkat.' '.$head->nama_korps.' '.$head->nama; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Fakultas</label>
                                <div class="col-sm-10">
                                <input id="fakultas" type="text" class="form-control" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input id="jurusan" type="text" class="form-control" autocomplete="off" readonly>
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
                    
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_fakultas_jurusan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Fakultas & Jurusan</h4>
            </div>
            <div class="modal-body">
                <form id="form_fakultas_jurusan" class="form-horizontal">
                    <input type="hidden" name="idusers_fakultas_jurusan" id="idusers_fakultas_jurusan" readonly autocomplete="off">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 control-label">Fakultas</label>
                        <div class="col-sm-9">
                            <select id="fakultas_modal" name="fakultas_modal" class="form-control" onchange="load_jurusan(this.value)">
                                <option value="-">- Pilih Fakultas -</option>
                                <?php
                                foreach ($fakultas as $row) {
                                    ?>
                                <option value="<?php echo $row->idfakultas; ?>"><?php echo $row->namafakultas; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 control-label">Jurusan</label>
                        <div class="col-sm-9">
                            <select id="jurusan_modal" name="jurusan_modal" class="form-control">
                                <option value="-">- Pilih Jurusan -</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveFakultasJurusan" type="button" class="btn btn-sm btn-primary" onclick="save_fak_jur();">Save</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        reload();
    });

    function reload(){
        $.ajax({
            url: "<?php echo base_url('pengguna/ajaxreload/').$head->idusers; ?>",
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                $('#fakultas').val(response.namafakultas);
                $('#jurusan').val(response.namajurusan);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function fakultas_jurusan(id){
        $('#form_fakultas_jurusan')[0].reset();
        $('#modal_fakultas_jurusan').modal('show');
        $('#idusers_fakultas_jurusan').val(id);
    }

    function load_jurusan(id){
        $.ajax({
            url: "<?php echo base_url('pengguna/loadjurusan/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#jurusan_modal').html(data.hasil);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error json " + errorThrown,
                    position: 'topRight'
                });
            }
        });
    }

    function save_fak_jur(){
        var idusers = document.getElementById('idusers_fakultas_jurusan').value;
        var fakultas_modal = document.getElementById('fakultas_modal').value;
        var jurusan_modal = document.getElementById('jurusan_modal').value;
        
        if (fakultas_modal === '-') {
            iziToast.error({
                title: 'Error',
                message: "Pilih fakultas terlebih dahulu",
                position: 'topRight'
            });
        } else if (jurusan_modal === '-') {
            iziToast.error({
                title: 'Error',
                message: "Pilih jurusan terlebih dahulu",
                position: 'topRight'
            });
            
        } else {
            $('#btnSaveFakultasJurusan').text('Saving...');
            $('#btnSaveFakultasJurusan').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('idusers', idusers);
            form_data.append('fakultas', fakultas_modal);
            form_data.append('jurusan', jurusan_modal);
            
            $.ajax({
                url: "<?php echo base_url('pengguna/proses_fak_jur') ?>",
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

                    $('#modal_fakultas_jurusan').modal('hide');
                    reload();

                    $('#btnSaveFakultasJurusan').text('Save');
                    $('#btnSaveFakultasJurusan').attr('disabled', false);
                }, error: function (response, status, xhr) {
                    var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                    $('meta[name="csrf-token"]').attr('content', csrfToken);

                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSaveFakultasJurusan').text('Save'); //change button text
                    $('#btnSaveFakultasJurusan').attr('disabled', false); //set button enable 
                }
            });
        }
    }
    
</script>
<?php echo $this->endSection(); ?>