<?php echo $this->extend("template/index"); ?>
<?php echo $this->section("content"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1> Dashboard <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-default">
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo $foto; ?>" alt="User Avatar">
                        </div>
                        <h3 class="widget-user-username">Selamat Datang, <?php echo $nama; ?></h3>
                        <h5 class="widget-user-desc">STTAL • Fakultas <?php echo $namafakultas; ?> • <?php echo $namajurusan; ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body" style="text-align: center;">
                        <h3><?php echo $appname; ?></h3>
                        <img src="<?php echo $logo; ?>" style="width: 150px; height: auto; margin-top: 20px;">
                        <p style="margin-top: 50px;"><?php echo $alamat . ' - '; ?><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
                        <p style="margin-top: 5px;"><?php echo "Telp : " . $tlp; if(strlen($email) > 0){ echo ', Email : ' . $email; } ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php echo $this->endSection(); ?>