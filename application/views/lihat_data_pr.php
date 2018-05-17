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
        Data PR
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data PR</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              <div class="row">
                <!-- /.col -->
                <form action="<?php echo base_url() ?>index.php/home/updateDataPRSimpan" id="form" method="post" enctype='multipart/form-data'>
                  <input type="text" id="id" name="id" value="<?php echo $pr[0]->id ?>" style="display:none">
                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="mataPelajaranChoose">Mata Pelajaran:</label>
                      <button type="button" id="mataPelajaranChoose" data-toggle="modal" data-target="#mataPelajaranModal">Choose</button>
                    </div>
                  </div> -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="mataPelajaranNama">Mata Pelajaran:</label>
                      <input type="text" class="form-control" id="mataPelajaranId" value="<?php echo $pr[0]->id_mata_pelajaran ?>" name="id_mata_pelajaran" style="display:none">
                      <input type="text" class="form-control" id="mataPelajaranNama" value="<?php echo $pr[0]->nama_mata_pelajaran ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="guruNama">Guru:</label>
                      <input type="text" class="form-control" id="guruId" value="<?php echo $pr[0]->id_guru ?>" name="id_guru" style="display:none">
                      <input type="text" class="form-control" id="guruNama" value="<?php echo $pr[0]->nama_guru ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="kelasNama">Kelas:</label>
                      <input type="text" class="form-control" id="kelasId" value="<?php echo $pr[0]->id_kelas ?>" name="id_kelas" style="display:none">
                      <input type="text" class="form-control" id="kelasNama" value="<?php echo $pr[0]->nama_kelas ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi:</label>
                      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" readonly><?php echo $pr[0]->deskripsi ?></textarea>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="gambar">Gambar:</label>
                      <input type="file" class="form-control-file" id="gambar" name="gambar[]" onchange="updateGambar(this);" multiple>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div id="gambarLihat">

                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama">Nama:</label>
                      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pr[0]->nama ?>" readonly>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                      <input type="submit" class="btn btn-default" name="button" id="update">
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
  
  $(document).ready(function() {
    var gambar = <?php echo $pr[0]->gambar ?>;
    console.log(gambar);
    for (var i = 0; i < gambar.length; i++) {
      var temp = '';
      temp += "<div class='col-md-3'>";
      temp += "<img src = '" +  "<?php echo base_url() ?>" + "./uploads/" + gambar[i] + "' class='img-thumbnail'>";
      temp += "</div>";
      $("#gambarLihat").append(temp);
    }
  });
  
function updateGambar(input) {
  if (input.files) {
    $("#gambarLihat").html("");
    var filesAmount = input.files.length;

    for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var gambar='';
          gambar += "<div class='col-md-3'>";
          gambar += "<img src = '" +  event.target.result + "' class='img-thumbnail'>";
          gambar += "</div>";
          $("#gambarLihat").append(gambar);

        }

        reader.readAsDataURL(input.files[i]);
    }
  }
}
</script>
</body>
</html>
