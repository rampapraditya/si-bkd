<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $appname; ?></title>
        <meta name="csrf-token" content="<?= csrf_hash() ?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="SI-BKD SEKOLAH TINGGI TEKNOLOGI ANGKATAN LAUT" />
        <meta name="keywords" content="SI-BKD, STTAL, PRAMEDIA">
        <meta name="author" content="Rampa Praditya" />
        <link rel="icon" href="<?php echo $logo; ?>" type="image/x-icon">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="<?php echo base_url(); ?>izitoast/css/iziToast.min.css">
        <script src="<?php echo base_url(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php echo $this->include('template/header'); ?>
            <?php echo $this->include('template/menu'); ?>
            <?php echo $this->renderSection('content'); ?>
            <?php echo $this->include('template/footer'); ?>
        </div>
        
        
        <!-- jQuery 3 -->
        <script src="<?php echo base_url(); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>dist/js/adminlte.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>izitoast/js/iziToast.min.js"></script>
        <script type="text/javascript">
            
            function back(){
                window.history.back();
            }
            
            function hanyaAngka(e, decimal) {
                var key;
                var keychar;
                if (window.event) {
                    key = window.event.keyCode;
                } else if (e) {
                    key = e.which;
                } else {
                    return true;
                }
                keychar = String.fromCharCode(key);
                if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
                    return true;
                } else if ((("0123456789").indexOf(keychar) > -1)) {
                    return true;
                } else if (decimal && (keychar == ".")) {
                    return true;
                } else {
                    return false;
                }
            }
            
            function batas_angka(input, batas) {
                if (input.value < 0){ input.value = 0;}
                if (input.value > batas) {input.value = batas;}
            }
        </script>
    </body>
</html>
