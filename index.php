<?php
error_reporting(0);
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISTEM STOK</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/skin-purple-light.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <!-- Boostrap Sub Menu -->
    <link rel="stylesheet" href="dist/css/bootstrap-submenu.min.css">

    <link href="dist/slider/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="dist/slider/js-image-slider.js" type="text/javascript"></script>

    <script src="plugins/slider/js/jssor.slider-21.1.6.min.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SISTEM STOK </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SISTEM STOK  </b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                
                  <img src="dist/img/images.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"> <?php echo strtoupper($_SESSION['username']);?> </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/images.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo" $_SESSION[namalengkap] "?> - ADMINISTRATOR
                   
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
					<div class="pull-left">
                      <a href="?pg=admin&act=view" class="btn btn-default btn-flat">Setting</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu Utama</li>
            <li >
              <a href="?pg=dashboard">
                <i class="fa fa-dashboard"></i> <span>Home</span>
              </a>
            </li>
                        
          <li class="treeview">
             <a href="?pg=persediaan&act=view">
               <i class="fa fa-circle-o"></i> 
                <span>Tabel Persediaan</span> 
              </a>
            </li>

            <li class="treeview">
              <a href="?pg=beli&act=view">
                <i class="fa fa-shopping-cart"></i>
                <span>Tabel Pembelian</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="?pg=setor&act=view">
                <i class="fa fa-files-o"></i>
                <span>Tabel Setor</span> 
              </a>
            </li>

             <li class="treeview">
              <a href="?pg=brgmasuk&act=view">
                <i class="fa fa-circle-o"></i>
                <span>Tabel Barang Masuk</span> 
              </a>
            </li>

            <li class="treeview">
            <a href="?pg=anggota&act=view">
            <i class="fa fa-user"></i>
            <span>Tabel Anggota</span>
            </a>
            </li>

            <li class="treeview">
            <a href="?pg=undian&act=view">
            <i class="fa fa-heart"></i>
            <span>Tabel Undian</span>
            </a>
            </li>



          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <?php
      include "content.php";
      ?>
      <!-- /.content-wrapper -->


      <footer class="main-footer">
        <div align="center" class="pull-center hidden-xs">
          <b><strong >Copyright &copy; 2019 <a href="webphpmysql.com">@mabertha.ab</a>.</strong></b>
        </div>
        
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="dist/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- daterangepicker -->
    <script src="dist/js/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
     <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- Donut Chart -->
    <script src="plugins/chartjs/Chart.Doughnut.js"></script>

    <!-- Fileinput.js -->
    <script src="bootstrap/js/photo_adm.js"></script>

    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>

    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true
        });
      });
    </script>
    
    <!-- page script Select2 Elements -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
         });
    </script>
    
    <!-- page script Submenu -->
    <script src="dist/js/bootstrap-submenu.min.js"></script>

    <!-- page script Dropdown Submenu -->
    <script type="text/javascript">
    $(document).ready(function() {

    $( ".dropdown-submenu" ).click(function(event) {
        // stop bootstrap.js to hide the parents
        event.stopPropagation();
        // hide the open children
        $( this ).find(".dropdown-submenu").removeClass('open');
        // add 'open' class to all parents with class 'dropdown-submenu'
        $( this ).parents(".dropdown-submenu").addClass('open');
        // this is also open (or was)
        $( this ).toggleClass('open');
      });
  });
    </script>

    <!-- page script datepicker -->
    <script>
    $(document).ready(function(){
      var date_input=$('input[id="date"]'); //our date input has the name "date"
      var container=$('.content form').length>0 ? $('.content form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
  </body>
</html>
