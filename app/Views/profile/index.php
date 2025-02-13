<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Profile <small>Maintenance Profile Pengguna</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Dashboard</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Profile</h3>
                    </div>
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nrp" class="col-sm-2 control-label">NRP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nrp" name="nrp" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="satker" class="col-sm-2 control-label">Satker</label>
                                <div class="col-sm-10">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pangkat" class="col-sm-2 control-label">Pangkat</label>
                                <div class="col-sm-10">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="korps" class="col-sm-2 control-label">Korps</label>
                                <div class="col-sm-10">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="col-sm-2 control-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="foto" name="foto" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button id="btnSave" type="button" class="btn btn-primary" onclick="proses();">Save</button>
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    $(document).ready(function () {

    });

    function proses() {
        $('#btnSave').text('Saving...');
        $('#btnSave').attr('disabled', true);

        var appname = document.getElementById('appname').value;
        var ins = document.getElementById('ins').value;
        var slogan = document.getElementById('slogan').value;
        var tahun = document.getElementById('tahun').value;
        var pimpinan = document.getElementById('pimpinan').value;
        var alamat = document.getElementById('alamat').value;
        var kdpos = document.getElementById('kdpos').value;
        var tlp = document.getElementById('tlp').value;
        var website = document.getElementById('website').value;
        var logo = $('#logo').prop('files')[0];

        var form_data = new FormData();
        form_data.append('appname', appname);
        form_data.append('ins', ins);
        form_data.append('slogan', slogan);
        form_data.append('tahun', tahun);
        form_data.append('pimpinan', pimpinan);
        form_data.append('alamat', alamat);
        form_data.append('kdpos', kdpos);
        form_data.append('tlp', tlp);
        form_data.append('website', website);
        form_data.append('file', logo);

        $.ajax({
            url: "<?php echo base_url('identitas/proses'); ?>",
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

                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled', false);
            }, error: function (response, status, xhr) {
                var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                $('meta[name="csrf-token"]').attr('content', csrfToken);

                iziToast.error({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

</script>

<?php echo $this->endSection(); ?>