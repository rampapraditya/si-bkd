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
            <li class="treeview <?php if($menu == 'data-pribadi' || $menu == 'inpasing' || $menu == 'jab-fungsi-dosen' || $menu == 'kepangkatan' || $menu == 'penempatan') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Profil</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'data-pribadi') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('data-pribadi'); ?>"><i class="fa fa-circle-o"></i> Data pribadi</a></li>
                    <li <?php if($menu == 'inpasing') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('inpasing'); ?>"><i class="fa fa-circle-o"></i> Inpassing</a></li>
                    <li <?php if($menu == 'jab-fungsi-dosen') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('jab-fungsi-dosen'); ?>"><i class="fa fa-circle-o"></i> Jabatan Fungsional</a></li>
                    <li <?php if($menu == 'kepangkatan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('kepangkatan'); ?>"><i class="fa fa-circle-o"></i> Kepangkatan</a></li>
                    <li <?php if($menu == 'penempatan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('penempatan'); ?>"><i class="fa fa-circle-o"></i> Penempatan</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'pend-formal' || $menu == 'diklat' || $menu == 'riwayat-kerja') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-graduation-cap"></i> <span>Kualifikasi</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'pend-formal') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pend-formal'); ?>"><i class="fa fa-circle-o"></i> Pendidikan Formal</a></li>
                    <li <?php if($menu == 'diklat') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('diklat'); ?>"><i class="fa fa-circle-o"></i> Diklat</a></li>
                    <li <?php if($menu == 'riwayat-kerja') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('riwayat-kerja'); ?>"><i class="fa fa-circle-o"></i> Riwayat Pekerjaan</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'pengajaran' || $menu == 'bim-mhs' || $menu == 'pengujian-mhs' || $menu == 'bahan-ajar' || $menu == 'pembinaan-mhs' || $menu == 'visit-sci' || $menu == 'datasering' || $menu == 'orasi' || $menu == 'pemb-dosen' || $menu == 'tugas-tambahan') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Pelaks Pendidikan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'pengajaran') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengajaran'); ?>"><i class="fa fa-circle-o"></i> Pengajaran</a></li>
                    <li <?php if($menu == 'bim-mhs') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('bim-mhs'); ?>"><i class="fa fa-circle-o"></i> Bimbingan Mahasiswa</a></li>
                    <li <?php if($menu == 'pengujian-mhs') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengujian-mhs'); ?>"><i class="fa fa-circle-o"></i> Pengujian Mahasiswa</a></li>
                    <li <?php if($menu == 'bahan-ajar') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('bahan-ajar'); ?>"><i class="fa fa-circle-o"></i> Bahan Ajar</a></li>
                    <li <?php if($menu == 'pembinaan-mhs') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pembinaan-mhs'); ?>"><i class="fa fa-circle-o"></i> Pembinaan Mahasiswa</a></li>
                    <li <?php if($menu == 'visit-sci') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('visit-sci'); ?>"><i class="fa fa-circle-o"></i> Visiting Scientist</a></li>
                    <li <?php if($menu == 'datasering') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('datasering'); ?>"><i class="fa fa-circle-o"></i> Datasering</a></li>
                    <li <?php if($menu == 'orasi') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('orasi'); ?>"><i class="fa fa-circle-o"></i> Orasi Ilmiah</a></li>
                    <li <?php if($menu == 'pemb-dosen') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pemb-dosen'); ?>"><i class="fa fa-circle-o"></i> Pembimbing dosen</a></li>
                    <li <?php if($menu == 'tugas-tambahan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('tugas-tambahan'); ?>"><i class="fa fa-circle-o"></i> Tugas tambahan</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>