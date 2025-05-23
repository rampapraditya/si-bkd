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
                    <i class="fa fa-gear"></i> <span>Setting</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'identitas') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('identitas'); ?>"><i class="fa fa-circle-o"></i> Identitas</a></li>
                    <li <?php if($menu == 'profile') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('profile'); ?>"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li <?php if($menu == 'ganti-password') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('ganti-password'); ?>"><i class="fa fa-circle-o"></i> Ganti password</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'jabatan-fungsional' || $menu == 'golongan' || $menu == 'korps' || $menu == 'pangkat' || $menu == 'satker' || $menu == 'jabatan' || $menu == 'fakultas') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'jabatan-fungsional') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('jabatan-fungsional'); ?>"><i class="fa fa-circle-o"></i> Jabatan Fungsional</a></li>
                    <li <?php if($menu == 'golongan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('golongan'); ?>"><i class="fa fa-circle-o"></i> Golongan</a></li>
                    <li <?php if($menu == 'korps') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('korps'); ?>"><i class="fa fa-circle-o"></i> Korps</a></li>
                    <li <?php if($menu == 'pangkat') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pangkat'); ?>"><i class="fa fa-circle-o"></i> Pangkat</a></li>
                    <li <?php if($menu == 'satker') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('satker'); ?>"><i class="fa fa-circle-o"></i> Satker</a></li>
                    <li <?php if($menu == 'jabatan') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('jabatan'); ?>"><i class="fa fa-circle-o"></i> Hak Akses</a></li>
                    <li <?php if($menu == 'fakultas') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('fakultas'); ?>"><i class="fa fa-circle-o"></i> Fakultas dan Jurusan</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'pengguna') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Administrasi</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li <?php if($menu == 'pengguna') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengguna'); ?>"><i class="fa fa-circle-o"></i> Pengguna</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'pengajaran' || $menu == 'bim-mhs' || $menu == 'pengujian-mhs' || $menu == 'pembinaan-mhs' || $menu == 'visit-sci' || $menu == 'datasering' || $menu == 'orasi' || $menu == 'pemb-dosen' || $menu == 'tugas-tambahan') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Pelaks Pendidikan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'pengajaran') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengajaran'); ?>"><i class="fa fa-circle-o"></i> Pengajaran</a></li>
                    <li <?php if($menu == 'bim-mhs') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('bim-mhs'); ?>"><i class="fa fa-circle-o"></i> Bimbingan Mahasiswa</a></li>
                    <li <?php if($menu == 'pengujian-mhs') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengujian-mhs'); ?>"><i class="fa fa-circle-o"></i> Pengujian Mahasiswa</a></li>
                    <li <?php if($menu == 'pembinaan-mhs') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pembinaan-mhs'); ?>"><i class="fa fa-circle-o"></i> Pembinaan Mahasiswa</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'penelitian' || $menu == 'publikasi' || $menu == 'paten') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-flask"></i> <span>Pelaks. Penelitian</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'penelitian') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('penelitian'); ?>"><i class="fa fa-circle-o"></i> Penelitian</a></li>
                    <li <?php if($menu == 'publikasi') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('publikasi'); ?>"><i class="fa fa-circle-o"></i> Publikasi karya</a></li>
                    <li <?php if($menu == 'paten') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('paten'); ?>"><i class="fa fa-circle-o"></i> Paten / HKI</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($menu == 'pengabdian' || $menu == 'pembicara' || $menu == 'pengelolajurnal' || $menu == 'jabstruktural') { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-link"></i> <span>Pelaks. Pengabdian</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($menu == 'pengabdian') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengabdian'); ?>"><i class="fa fa-circle-o"></i> Pengabdian</a></li>
                    <li <?php if($menu == 'pembicara') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pembicara'); ?>"><i class="fa fa-circle-o"></i> Pembicara</a></li>
                    <li <?php if($menu == 'pengelolajurnal') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('pengelolajurnal'); ?>"><i class="fa fa-circle-o"></i> Pengelola jurnal</a></li>
                    <li <?php if($menu == 'jabstruktural') { echo 'class="active"'; } ?> ><a href="<?php echo base_url('jabstruktural'); ?>"><i class="fa fa-circle-o"></i> Jabatan struktural</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>