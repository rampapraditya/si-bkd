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
            <li class="treeview <?php if($menu == 'identitas' || $menu == 'profile' || $menu == 'ganti-password') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Profil</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'identitas') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('identitas'); ?>"><i class="fa fa-circle-o"></i> Data pribadi</a></li>
                    <li <?php if($menu == 'profile') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('profile'); ?>"><i class="fa fa-circle-o"></i> Inpassing</a></li>
                    <li <?php if($menu == 'ganti-password') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('ganti-password'); ?>"><i class="fa fa-circle-o"></i> Jabatan Fungsional</a></li>
                    <li <?php if($menu == 'ganti-password') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('ganti-password'); ?>"><i class="fa fa-circle-o"></i> Kepangkatan</a></li>
                    <li <?php if($menu == 'ganti-password') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('ganti-password'); ?>"><i class="fa fa-circle-o"></i> Penempatan</a></li>
                </ul>
            </li>
            
        </ul>
    </section>
</aside>