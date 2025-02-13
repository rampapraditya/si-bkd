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
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li <?php if($menu == '' || $menu == 'dashboard') { echo 'class="active"'; } ?> >
                <a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
            </li>
            <li class="treeview <?php if($menu == 'identitas' || $menu == 'profile' || $menu == 'gantipass') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>Setting</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'identitas') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('identitas'); ?>"><i class="fa fa-circle-o"></i> Identitas</a></li>
                    <li <?php if($menu == 'profile') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('profile'); ?>"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li <?php if($menu == 'gantipass') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('gantipass'); ?>"><i class="fa fa-circle-o"></i> Ganti password</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> Korps</a></li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Pangkat</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Satker</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Jabatan</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Administrasi</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Pengguna</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>