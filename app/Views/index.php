<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $appname; ?></title>
        <meta name="csrf-token" content="<?= csrf_hash() ?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" href="<?php echo $logo; ?>" type="image/x-icon">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="<?php echo base_url(); ?>izitoast/css/iziToast.min.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?php echo $logo; ?>" style="width: 80px;">
                <br>
                <a href="<?php echo base_url('login'); ?>"><b><?php echo $appname; ?></b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div>
                    <div class="form-group has-feedback">
                        <input id="username" name="username" type="text" class="form-control" placeholder="Username" autocomplete="off">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="pass" name="pass" type="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-primary btn-block btn-flat" onclick="proses();">Sign In</button>
                        </div>
                    </div>
                </div>
                <a href="#">I forgot my password</a><br>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>izitoast/js/iziToast.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#username').keypress(function (e) {
                    var key = e.which;
                    if (key === 13) {
                        $('#pass').focus();
                        $('#pass').select();
                    }
                });

                $('#pass').keypress(function (e) {
                    var key = e.which;
                    if (key === 13) {
                        proses();
                    }
                });
            });

            

            function proses() {
                var username = document.getElementById('username').value;
                var pass = document.getElementById('pass').value;

                if (username === "") {
                    iziToast.error({
                        title: 'Error',
                        message: "Username tidak boleh kosong",
                        position: 'topRight'
                    });
                    
                } else if (pass === "") {
                    iziToast.error({
                        title: 'Error',
                        message: "Password tidak boleh kosong",
                        position: 'topRight'
                    });
                    
                } else {
                    $('#btnProses').text('Processing...');
                    $('#btnProses').attr('disabled', true);

                    var form_data = new FormData();
                    form_data.append('username', username);
                    form_data.append('password', pass);
                    
                    $.ajax({
                        url: "<?php echo base_url(); ?>login/proses",
                        dataType: 'JSON',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'POST',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                        },success: function (response, status, xhr) {
                            $('#btnProses').text('Sign In');
                            $('#btnProses').attr('disabled', false);
                            
                            var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                            $('meta[name="csrf-token"]').attr('content', csrfToken);
                            
                            if (response.pesan === "ok") {
                                window.location.href = "<?php echo base_url('dashboard'); ?>";
                            } else if (response.pesan === "okdosen") {
                                window.location.href = "<?php echo base_url('dashboard'); ?>";
                            } else {
                                iziToast.info({
                                    title: 'Info',
                                    message: response.pesan,
                                    position: 'topRight'
                                });
                            }

                        }, error: function (response, status, xhr) {
                            $('#btnProses').text('Sign In');
                            $('#btnProses').attr('disabled', false);
                            
                            var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                            $('meta[name="csrf-token"]').attr('content', csrfToken);
                            
                            iziToast.error({
                                title: 'Error',
                                message: response.pesan,
                                position: 'topRight'
                            });
                            
                        }
                    });
                }
            }
        </script>
    </body>
</html>
