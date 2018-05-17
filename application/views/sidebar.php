<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url() . "assets/"; ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin</p>
        <a href="<?php echo base_url() . "assets/"; ?>#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url() . 'index.php/home' ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url() . "assets/"; ?>#">
          <i class="fa fa-files-o"></i>
          <span>Data</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() ?>index.php/home/dataGuru"><i class="fa fa-circle-o"></i> Data guru</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataMurid"><i class="fa fa-circle-o"></i> Data murid</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataKelas"><i class="fa fa-circle-o"></i> Data kelas</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataTahunAjaran"><i class="fa fa-circle-o"></i> Data tahun ajaran</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataMataPelajaran"><i class="fa fa-circle-o"></i> Data mata pelajaran</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataJudulUjian"><i class="fa fa-circle-o"></i> Data judul ujian</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataJenisSoalUjian"><i class="fa fa-circle-o"></i> Data jenis soal ujian</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataSoalUjian"><i class="fa fa-circle-o"></i> Data soal ujian</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataPR"><i class="fa fa-circle-o"></i> Data pr</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataMateriPelajaran"><i class="fa fa-circle-o"></i> Data materi pelajaran</a></li>
          <li><a href="<?php echo base_url() ?>index.php/home/dataJadwalUjian"><i class="fa fa-circle-o"></i> Data jadwal ujian</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
