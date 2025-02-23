<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $nama; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if($menu == '' || $menu == 'dashboard'){ echo 'active'; } ?>"><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview <?php if($menu == 'data-pribadi' || $menu == 'inpasing' || $menu == 'jabatan-fungsional' || $menu == 'kepangkatan' || $menu == 'penempatan') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Profil</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'data-pribadi') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('data-pribadi'); ?>"><i class="fa fa-circle-o"></i> Data pribadi</a></li>
                    <li <?php if($menu == 'inpasing') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('inpasing'); ?>"><i class="fa fa-circle-o"></i> Inpassing</a></li>
                    <li <?php if($menu == 'jabatan-fungsional') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('jabatan-fungsional'); ?>"><i class="fa fa-circle-o"></i> Jabatan Fungsional</a></li>
                    <li <?php if($menu == 'kepangkatan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('kepangkatan'); ?>"><i class="fa fa-circle-o"></i> Kepangkatan</a></li>
                    <li <?php if($menu == 'penempatan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('penempatan'); ?>"><i class="fa fa-circle-o"></i> Penempatan</a></li>
                </ul>
            </li>
            
        </ul>
    </section>
</aside>