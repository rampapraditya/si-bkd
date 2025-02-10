<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>plugins/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>izitoast/css/iziToast.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php echo $this->include('template/header'); ?>
            <?php echo $this->include('template/menu'); ?>
            <?php echo $this->renderSection('content'); ?>
            <?php echo $this->include('template/footer'); ?>
        </div>

        
        <script src="<?php echo base_url() ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/jQueryUI/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo base_url() ?>plugins/morris/morris.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo base_url() ?>plugins/knob/jquery.knob.js"></script>
        <script src="<?php echo base_url() ?>plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url() ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/fastclick/fastclick.min.js"></script>
        <script src="<?php echo base_url() ?>dist/js/app.min.js"></script>
        <script src="<?php echo base_url() ?>dist/js/demo.js"></script>
        <script src="<?php echo base_url(); ?>izitoast/js/iziToast.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                alert("A");
            });
        </script>
    </body>
</html>
