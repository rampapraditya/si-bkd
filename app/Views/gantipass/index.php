<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Ganti Password <small>Maintenance Password Pengguna</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"> Dashboard</a></li>
            <li class="active">Ganti Password</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Ganti Password</h3>
                    </div>
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass_lama" class="col-sm-2 control-label">Password Lama</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pass_lama" name="pass_lama" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass_baru" class="col-sm-2 control-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pass_baru" name="pass_baru" autocomplete="off">
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
        var pass_lama = document.getElementById('pass_lama').value;
        var pass_baru = document.getElementById('pass_baru').value;

        if(pass_lama === ""){
            iziToast.error({
                title: 'Info',
                message: "Password lama tidak boleh kosong",
                position: 'topRight'
            });
        }else if(pass_baru === ""){
            iziToast.error({
                title: 'Info',
                message: "Password baru tidak boleh kosong",
                position: 'topRight'
            });
        }else{
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('pass_lama', pass_lama);
            form_data.append('pass_baru', pass_baru);

            $.ajax({
                url: "<?php echo base_url('ganti-password/proses'); ?>",
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
    }

</script>

<?php echo $this->endSection(); ?>