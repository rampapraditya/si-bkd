<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Identitas <small>Maintenance Indentitas Instansi</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Beranda</a></li>
            <li class="active">Identitas</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Identitas</h3>
                    </div>
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="appname" class="col-sm-2 control-label">Nama Aplikasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="appname" name="appname" value="<?php echo $appname; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ins" class="col-sm-2 control-label">Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ins" name="ins" value="<?php echo $namains; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="slogan" class="col-sm-2 control-label">Slogan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slogan" name="slogan" value="<?php echo $slogan; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tahun" class="col-sm-2 control-label">Tahun Berdiri</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tahun" name="tahun" onkeypress="return hanyaAngka(event, false);" value="<?php echo $tahun; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pimpinan" class="col-sm-2 control-label">Nama Pimpinan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="pimpinan" name="pimpinan" type="text" value="<?php echo $pimpinan; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="alamat" name="alamat" type="text" value="<?php echo $alamat; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kdpos" class="col-sm-2 control-label">Kode POS</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="kdpos" name="kdpos" type="text" onkeypress="return hanyaAngka(event, false);" value="<?php echo $kdpos; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlp" class="col-sm-2 control-label">Telepon</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="tlp" name="tlp" type="text" value="<?php echo $tlp; ?>" onkeypress="return hanyaAngka(event, false);" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website" class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="website" name="website" type="text" value="<?php echo $website; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-sm-2 control-label">Logo</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="logo" name="logo" type="file">
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