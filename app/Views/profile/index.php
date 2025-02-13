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
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $profile->username; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $profile->email; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nrp" class="col-sm-2 control-label">NRP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nrp" name="nrp" value="<?php echo $profile->nrp; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $profile->nama; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="satker" class="col-sm-2 control-label">Satker</label>
                                <div class="col-sm-10">
                                    <select id="satker" name="satker" class="form-control">
                                        <option value="-">- Pilih Satker -</option>
                                        <?php
                                        foreach ($satker as $row) {
                                            ?>
                                        <option <?php if($profile->idsatker == $row->idsatker){ echo 'selected'; } ?>  value="<?php echo $row->idsatker; ?>"><?php echo $row->namasatker; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pangkat" class="col-sm-2 control-label">Pangkat</label>
                                <div class="col-sm-10">
                                    <select id="pangkat" name="pangkat" class="form-control">
                                        <option value="-">- Pilih Pangkat -</option>
                                        <?php
                                        foreach ($pangkat as $row) {
                                            ?>
                                        <option <?php if($profile->idpangkat == $row->idpangkat){ echo 'selected'; } ?> value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="korps" class="col-sm-2 control-label">Korps</label>
                                <div class="col-sm-10">
                                    <select id="korps" name="korps" class="form-control">
                                        <option value="-">- Pilih Korps -</option>
                                        <?php
                                        foreach ($korps as $row) {
                                            ?>
                                        <option <?php if($profile->idkorps == $row->idkorps){ echo 'selected'; } ?> value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
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
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var satker = document.getElementById('satker').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        var foto = $('#foto').prop('files')[0];

        if(username === ""){
            iziToast.error({
                title: 'Info',
                message: "Username tidak boleh kosong",
                position: 'topRight'
            });
        }else if(email === ""){
            iziToast.error({
                title: 'Info',
                message: "Email tidak boleh kosong",
                position: 'topRight'
            });
        }else if(nama === ""){
            iziToast.error({
                title: 'Info',
                message: "Nama tidak boleh kosong",
                position: 'topRight'
            });
        }else if(satker === "-"){
            iziToast.error({
                title: 'Info',
                message: "Satker tidak boleh kosong",
                position: 'topRight'
            });
        }else if(pangkat === "-"){
            iziToast.error({
                title: 'Info',
                message: "Pangkat tidak boleh kosong",
                position: 'topRight'
            });
        }else if(korps === "-"){
            iziToast.error({
                title: 'Info',
                message: "Korps tidak boleh kosong",
                position: 'topRight'
            });
        }else{

            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('username', username);
            form_data.append('email', email);
            form_data.append('nrp', nrp);
            form_data.append('nama', nama);
            form_data.append('satker', satker);
            form_data.append('pangkat', pangkat);
            form_data.append('korps', korps);
            form_data.append('file', foto);

            $.ajax({
                url: "<?php echo base_url('profile/proses'); ?>",
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