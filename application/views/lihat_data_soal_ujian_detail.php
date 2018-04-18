<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url() . "assets/"; ?>https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url() ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="<?php echo base_url() . "assets/"; ?>#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>


    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?=$sidebar ?>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Soal Ujian Detail
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Soal Ujian Detail</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              <div class="row">
                <!-- /.col -->
                <form action="<?php echo base_url() ?>index.php/home/updateDataSoalUjianDetailSimpan" id="form" method="post" enctype='multipart/form-data'>
                  <input type="text" id="id" name="id" value="<?php echo $soal_ujian_detail[0]->id ?>" style="display:none">
                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="soalUjianChoose">Soal Ujian:</label>
                      <button type="button" id="soalUjianChoose" data-toggle="modal" data-target="#soalUjianModal">Choose</button>
                    </div>
                  </div> -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="soalUjianNama">Soal Ujian:</label>
                      <input type="text" class="form-control" id="soalUjianId" value="<?php echo $soal_ujian_detail[0]->id_soal_ujian ?>" name="id_soal_ujian" style="display:none">
                      <input type="text" class="form-control" id="soalUjianNama" value="<?php echo $soal_ujian_detail[0]->nama_soal_ujian ?>" readonly>
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="jenisSoalUjianDetailChoose">Jenis Soal Ujian Detail:</label>
                      <button type="button" id="jenisSoalUjianDetailChoose" data-toggle="modal" data-target="#jenisSoalUjianDetailModal">Choose</button>
                    </div>
                  </div> -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="jenisSoalUjianDetailNama">Jenis Soal Ujian Detail:</label>
                      <input type="text" class="form-control" id="jenisSoalUjianDetailId" value="<?php echo $soal_ujian_detail[0]->id_jenis_soal_ujian_detail ?>" name="id_jenis_soal_ujian_detail" style="display:none">
                      <input type="text" class="form-control" id="jenisSoalUjianDetailNama" value="<?php echo $soal_ujian_detail[0]->nama_jenis_soal_ujian_detail ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="soalTulisan">Soal:</label>
                      <textarea class="form-control" id="soalTulisan" name="soal_tulisan" rows="3" readonly><?php echo $soal_ujian_detail[0]->soal_tulisan ?></textarea>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="soalGambar">Soal:</label>
                      <input type="file" class="form-control-file" id="soalGambar" name="soal_gambar[]" onchange="updateSoalGambar(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="soalGambarLihat">

                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <p>*Untuk uraian, kosongkan semua data untuk pilihan jawaban</p>
                  </div> -->

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanTulisanA">Pilihan Jawaban A:</label>
                      <input type="text" class="form-control" id="pilihanJawabanTulisanA" name="pilihan_jawaban_tulisan_a" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanGambarA">Pilihan Jawaban A:</label>
                      <input type="file" class="form-control-file" id="pilihanJawabanGambarA" name="pilihan_jawaban_gambar_a[]" onchange="updatePilihanJawabanGambarA(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="pilihanJawabanGambarALihat">
                      
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanTulisanB">Pilihan Jawaban B:</label>
                      <input type="text" class="form-control" id="pilihanJawabanTulisanB" name="pilihan_jawaban_tulisan_b" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanGambarB">Pilihan Jawaban B:</label>
                      <input type="file" class="form-control-file" id="pilihanJawabanGambarB" name="pilihan_jawaban_gambar_b[]" onchange="updatePilihanJawabanGambarB(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="pilihanJawabanGambarBLihat">
                      
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanTulisanC">Pilihan Jawaban C:</label>
                      <input type="text" class="form-control" id="pilihanJawabanTulisanC" name="pilihan_jawaban_tulisan_c" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanGambarC">Pilihan Jawaban C:</label>
                      <input type="file" class="form-control-file" id="pilihanJawabanGambarC" name="pilihan_jawaban_gambar_c[]" onchange="updatePilihanJawabanGambarC(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="pilihanJawabanGambarCLihat">
                      
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanTulisanD">Pilihan Jawaban D:</label>
                      <input type="text" class="form-control" id="pilihanJawabanTulisanD" name="pilihan_jawaban_tulisan_d" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanGambarD">Pilihan Jawaban D:</label>
                      <input type="file" class="form-control-file" id="pilihanJawabanGambarD" name="pilihan_jawaban_gambar_d[]" onchange="updatePilihanJawabanGambarD(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="pilihanJawabanGambarDLihat">
                      
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanTulisanE">Pilihan Jawaban E:</label>
                      <input type="text" class="form-control" id="pilihanJawabanTulisanE" name="pilihan_jawaban_tulisan_e" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="pilihanJawabanGambarE">Pilihan Jawaban E:</label>
                      <input type="file" class="form-control-file" id="pilihanJawabanGambarE" name="pilihan_jawaban_gambar_e[]" onchange="updatePilihanJawabanGambarE(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="pilihanJawabanGambarELihat">
                      
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <p>*Untuk kunci jawaban pilihan ganda, input karakter a atau b atau c atau d atau e</p>
                  </div> -->

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="kunciJawaban">Kunci Jawaban:</label>
                      <input type="text" class="form-control" id="kunciJawaban" value="<?php echo $soal_ujian_detail[0]->kunci_jawaban ?>" name="kunci_jawaban" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                      <input type="submit" class="btn btn-default" name="button" id="simpan">
                  </div> -->

                </form>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>

  <div id="soalUjianModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Data soal ujian</h4>
        </div>
        <div class="modal-body">
          <div id="dataSoalUjian">

          </div>
          <div class="row">
            <button id="dataSoalUjianPrev" onclick="loadDataSoalUjianPrev()">prev</button>
            <button id="dataSoalUjianNext" onclick="loadDataSoalUjianNext()">next</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <div id="jenisSoalUjianDetailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Data jenis soal ujian detail</h4>
        </div>
        <div class="modal-body">
          <div id="dataJenisSoalUjianDetail">

          </div>
          <div class="row">
            <button id="dataJenisSoalUjianDetailPrev" onclick="loadDataJenisSoalUjianDetailPrev()">prev</button>
            <button id="dataJenisSoalUjianDetailNext" onclick="loadDataJenisSoalUjianDetailNext()">next</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <!-- /.content-wrapper -->
  <?=$footer ?>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() . "assets/"; ?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() . "assets/"; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() . "assets/"; ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() . "assets/"; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() . "assets/"; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . "assets/"; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() . "assets/"; ?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() . "assets/"; ?>dist/js/demo.js"></script>

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">

</script>

<script type="text/javascript">
  var pageSoalUjian = 1;
  var pageJenisSoalUjianDetail = 1;
  var pageSoalUjianTotal;
  var pageJenisSoalUjianDetailTotal;
  var recordPerPage = 3;
  $(document).ready(function() {
    var soalGambar = <?php echo $soal_ujian_detail[0]->soal_gambar ?>;
    for (var i = 0; i < soalGambar.length; i++) {
      var gambar = "";
      gambar += "<div class='col-md-3'>";
      gambar += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + soalGambar[i] + "' class='img-thumbnail'>";
      gambar += "</div>";
      $("#soalGambarLihat").append(gambar);
    }
    var pilihanJawabanTulisan = <?php echo $soal_ujian_detail[0]->pilihan_jawaban_tulisan ?>;
    $("#pilihanJawabanTulisanA").val(pilihanJawabanTulisan[0]);
    $("#pilihanJawabanTulisanB").val(pilihanJawabanTulisan[1]);
    $("#pilihanJawabanTulisanC").val(pilihanJawabanTulisan[2]);
    $("#pilihanJawabanTulisanD").val(pilihanJawabanTulisan[3]);
    $("#pilihanJawabanTulisanE").val(pilihanJawabanTulisan[4]);
    
    var pilihanJawabanGambar = <?php echo $soal_ujian_detail[0]->pilihan_jawaban_gambar ?>;
    for (var i = 0; i < pilihanJawabanGambar[0].length; i++) {
      var gambar = "";
      gambar += "<div class='col-md-3'>";
      gambar += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + pilihanJawabanGambar[0][i] + "' class='img-thumbnail'>";
      gambar += "</div>";
      $("#pilihanJawabanGambarALihat").append(gambar);
    }

    for (var i = 0; i < pilihanJawabanGambar[1].length; i++) {
      var gambar = "";
      gambar += "<div class='col-md-3'>";
      gambar += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + pilihanJawabanGambar[1][i] + "' class='img-thumbnail'>";
      gambar += "</div>";
      $("#pilihanJawabanGambarBLihat").append(gambar);
    }

    for (var i = 0; i < pilihanJawabanGambar[2].length; i++) {
      var gambar = "";
      gambar += "<div class='col-md-3'>";
      gambar += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + pilihanJawabanGambar[2][i] + "' class='img-thumbnail'>";
      gambar += "</div>";
      $("#pilihanJawabanGambarCLihat").append(gambar);
    }

    for (var i = 0; i < pilihanJawabanGambar[3].length; i++) {
      var gambar = "";
      gambar += "<div class='col-md-3'>";
      gambar += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + pilihanJawabanGambar[3][i] + "' class='img-thumbnail'>";
      gambar += "</div>";
      $("#pilihanJawabanGambarDLihat").append(gambar);
    }

    for (var i = 0; i < pilihanJawabanGambar[4].length; i++) {
      var gambar = "";
      gambar += "<div class='col-md-3'>";
      gambar += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + pilihanJawabanGambar[4][i] + "' class='img-thumbnail'>";
      gambar += "</div>";
      $("#pilihanJawabanGambarELihat").append(gambar);
    }
  });
  banyakDataSoalUjian(recordPerPage);
  banyakDataJenisSoalUjianDetail(recordPerPage);
  function banyakDataSoalUjian(recordPerPage) {
    $.ajax({
      url:"<?php echo base_url() ?>index.php/home/banyakDataSoalUjian/" + recordPerPage,
      type:"get",
      success:function(data) {
        // console.log(data);
        pageSoalUjianTotal = data;
      }
    });
  }
  function banyakDataJenisSoalUjianDetail(recordPerPage) {
    $.ajax({
      url:"<?php echo base_url() ?>index.php/home/banyakDataJenisSoalUjianDetail/" + recordPerPage,
      type:"get",
      success:function(data) {
        // console.log(data);
        pageJenisSoalUjianDetailTotal = data;
      }
    });
  }
  loadDataSoalUjian(pageSoalUjian);
  loadDataJenisSoalUjianDetail(pageJenisSoalUjianDetail);
  function loadDataSoalUjian(page) {
    $.ajax({
      url:"<?php echo base_url() ?>index.php/home/loadDataSoalUjian/" + page + "/" + recordPerPage,
      type:"get",
      success:function(data) {
        console.log(data);
        $("#dataSoalUjian").html(data);
      }
    });
  }
  function loadDataJenisSoalUjianDetail(page) {
    $.ajax({
      url:"<?php echo base_url() ?>index.php/home/loadDataJenisSoalUjianDetail/" + page + "/" + recordPerPage,
      type:"get",
      success:function(data) {
        // console.log(data);
        $("#dataJenisSoalUjianDetail").html(data);
      }
    });
  }
  function loadDataSoalUjianPrev() {
    if (pageSoalUjian - 1 >= 1) {
      pageSoalUjian--;
        console.log(pageSoalUjian);
      loadDataSoalUjian(pageSoalUjian);
    }
  }
  function loadDataJenisSoalUjianDetailPrev() {
    if (pageJenisSoalUjianDetail - 1 >= 1) {
      pageJenisSoalUjianDetail--;
        console.log(pageJenisSoalUjianDetail);
      loadDataJenisSoalUjianDetail(pageJenisSoalUjianDetail);
    }
  }
  function loadDataSoalUjianNext() {
    if (pageSoalUjian < pageSoalUjianTotal) {
      pageSoalUjian++;
      console.log(pageSoalUjian);
      loadDataSoalUjian(pageSoalUjian);
    }
  }
  function loadDataJenisSoalUjianDetailNext() {
    if (pageJenisSoalUjianDetail < pageJenisSoalUjianDetailTotal) {
      pageJenisSoalUjianDetail++;
      console.log(pageJenisSoalUjianDetail);
      loadDataJenisSoalUjianDetail(pageJenisSoalUjianDetail);
    }
  }
  function chooseSoalUjian(soalUjianId, soalUjianNama) {
    console.log("haha");
    $("#soalUjianId").val(soalUjianId);
    $("#soalUjianNama").val(soalUjianNama);
  }
  function chooseJenisSoalUjianDetail(jenisSoalUjianDetailId, jenisSoalUjianDetailNama) {
    $("#jenisSoalUjianDetailId").val(jenisSoalUjianDetailId);
    $("#jenisSoalUjianDetailNama").val(jenisSoalUjianDetailNama);
  }
//   $("#form").submit(function() {
//     var pilihan_jawaban_tulisan = [];
//     pilihan_jawaban_tulisan.push($("#pilihanJawabanTulisanA").val());
//     pilihan_jawaban_tulisan.push($("#pilihanJawabanTulisanB").val());
//     pilihan_jawaban_tulisan.push($("#pilihanJawabanTulisanC").val());
//     pilihan_jawaban_tulisan.push($("#pilihanJawabanTulisanD").val());
//     pilihan_jawaban_tulisan.push($("#pilihanJawabanTulisanE").val());

//     var pilihan_jawaban_gambar = [];
//     pilihan_jawaban_gambar.push($("#pilihanJawabanGambarA")[0].files);
//     pilihan_jawaban_gambar.push($("#pilihanJawabanGambarB")[0].files);
//     pilihan_jawaban_gambar.push($("#pilihanJawabanGambarC")[0].files);
//     pilihan_jawaban_gambar.push($("#pilihanJawabanGambarD")[0].files);
//     pilihan_jawaban_gambar.push($("#pilihanJawabanGambarE")[0].files);

//     console.log(pilihan_jawaban_gambar);
//     $.ajax({
//       type: "POST",
//       url: "<?php echo base_url() ?>index.php/home/tambahDataSoalUjianDetailSimpan",
//       // data: {
//       //   // soal_ujian : $("#soalUjianNama").val(),
//       //   // jenis_soal_ujian_detail : $("#jenisSoalUjianDetailNama").val(),
//       //   // soal_tulisan : $("#soalTulisan").val(),
//       //   soal_gambar : $("#soalGambar")[0].files[0].name
//       //   // pilihan_jawaban_tulisan : pilihan_jawaban_tulisan,
//       //   // pilihan_jawaban_gambar : pilihan_jawaban_gambar,
//       //   // kunci_jawaban : $("#kunciJawaban").val()
//       // },
//       data : new FormData(this),
//       dataType: "json",
//       complete: function(result){
//         console.log("blabla");
//         toastr.success('Data soal ujian berhasil ditambah');
//         $("#soalUjianNama").val("");
//         $("#jenisSoalUjianDetailNama").val("");
//         $("#soalTulisan").val("");
//         $("#soalGambar").val("");
//         $("#pilihanJawabanTulisanA").val("");
//         $("#pilihanJawabanTulisanB").val("");
//         $("#pilihanJawabanTulisanC").val("");
//         $("#pilihanJawabanTulisanD").val("");
//         $("#pilihanJawabanTulisanE").val("");
//         $("#pilihanJawabanGambarA").val("");
//         $("#pilihanJawabanGambarB").val("");
//         $("#pilihanJawabanGambarC").val("");
//         $("#pilihanJawabanGambarD").val("");
//         $("#pilihanJawabanGambarE").val("");
//         $("#kunciJawaban").val("");
//       }
//   });
// });
function updateSoalGambar(input) {
  if (input.files) {
    $("#soalGambarLihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#soalGambarLihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
function updatePilihanJawabanGambarA(input) {
  if (input.files) {
    $("#pilihanJawabanGambarALihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#pilihanJawabanGambarALihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
function updatePilihanJawabanGambarB(input) {
  if (input.files) {
    $("#pilihanJawabanGambarBLihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#pilihanJawabanGambarBLihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
function updatePilihanJawabanGambarC(input) {
  if (input.files) {
    $("#pilihanJawabanGambarCLihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#pilihanJawabanGambarCLihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
function updatePilihanJawabanGambarD(input) {
  if (input.files) {
    $("#pilihanJawabanGambarDLihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#pilihanJawabanGambarDLihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
function updatePilihanJawabanGambarE(input) {
  if (input.files) {
    $("#pilihanJawabanGambarELihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#pilihanJawabanGambarELihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
</script>
</body>
</html>
