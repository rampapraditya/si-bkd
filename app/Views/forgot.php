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
        <style>
            html, body {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
            
            .stretch-background {
                width: 100vw;
                height: 100vh;
                background: url('images/back.jpeg') no-repeat center center fixed;
                background-size: cover;
            }
        </style>
    </head>
    <body class="hold-transition login-page stretch-background">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?php echo $logo; ?>" style="width: 80px;">
                <br>
                <a href="<?php echo base_url('login'); ?>"><b><?php echo $appname; ?></b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Enter your username and we'll send you a link to reset your password.</p>
                <div>
                    <div class="form-group has-feedback">
                        <input id="username" name="username" type="text" class="form-control" placeholder="Username" autocomplete="off">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            
                        </div>
                        <div class="col-xs-4">
                            <button id="btnProses" type="button" class="btn btn-primary btn-block btn-flat" onclick="proses();">Send Email</button>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url('login'); ?>">Sign in to start your session</a><br>
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
                
                if (username === "") {
                    iziToast.error({
                        title: 'Error',
                        message: "Username tidak boleh kosong",
                        position: 'topRight'
                    });
                    
                } else {
                    $('#btnProses').text('Processing...');
                    $('#btnProses').attr('disabled', true);

                    var form_data = new FormData();
                    form_data.append('username', username);
                    
                    $.ajax({
                        url: "<?php echo base_url(); ?>forgot/proses",
                        dataType: 'JSON',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'POST',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                        },success: function (response, status, xhr) {
                            $('#btnProses').text('Send Email');
                            $('#btnProses').attr('disabled', false);
                            
                            var csrfToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                            $('meta[name="csrf-token"]').attr('content', csrfToken);
                            
                            iziToast.warning({
                                title: 'Info',
                                message: response.pesan,
                                position: 'topRight'
                            });

                        }, error: function (response, status, xhr) {
                            $('#btnProses').text('Send Email');
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
