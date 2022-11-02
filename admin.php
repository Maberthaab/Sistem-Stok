<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA USER //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=admin&act=view">Data Pengguna</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=admin&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM users  order by id_user asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[username]"?></td>
                        
                        <?php
                        if ($r['level_user']=="admin"){
                          $level_user = "admin";
                        } else {
                          $level_user = "user";
                        }
                        ?>

                        <td><?php echo "$level_user"?></td>
                       <td><a href="?pg=admin&act=delete&id=<?php echo $r['id_user']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    </tbody>
                  </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
	</div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->

      <?php
      break;
      // PROSES TAMBAH DATA PENGGUNA //
      case 'add':
      if (isset($_POST['add'])) {
                $query = mysql_query("INSERT INTO users VALUES ('','$_POST[nama]','$_POST[username]',
                md5('$_POST[password]'),'$_POST[level_user]')");
                echo "<script>window.location='?pg=admin&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=admin&act=view">Data Pengguna</a></li>
            <li class="active"><a href="#">Tambah Data Pengguna</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Username" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Level</label> <br>
                      <label class="radio-inline">
                      <input type="radio" name="level_user" id="level_user" value="admin" required data-fv-notempty-message="Tidak boleh kosong"> Admin 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="level_user" id="level_user" value="user" required data-fv-notempty-message="Tidak boleh kosong"> User
                      </label>
                    </div>
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'add' class="btn btn-info">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


       <?php
      break;
      // PROSES EDIT DATA PENGGUNA //
      case 'edit':
      $d = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id_user='$_GET[id]'"));
            if (isset($_POST['update'])) {

            if (empty($_POST[password])) {

                mysql_query("UPDATE users SET username='$_POST[username]',
                  level_user='$_POST[level_user]' WHERE iduser='$_POST[id]'");
                echo "<script>window.location='?pg=admin&act=view'</script>";
            } else {
              mysql_query("UPDATE users SET username='$_POST[username]', 
                password=md5('$_POST[password]'), level_user='$_POST[level_user]',
                 WHERE iduser='$_POST[id]'");
                echo "<script>window.location='?pg=admin&act=view'</script>";
            }
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=admin&act=view">Data Pengguna</a></li>
            <li class="active">Update Data Pengguna</li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nama'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['username'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      <input type="hidden" class="form-control" id="id" name="id" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['iduser'];?>">
                      <p class="text-red">Apabila password tidak diubah dikosongkan saja</p>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Level</label> <br>
                      <?php
                      if ($d['level_user'] == 'admin'){
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="level_user" id="level_user" value="admin" required data-fv-notempty-message="Tidak boleh kosong" checked> Admin 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="level_user" id="level_user" value="user" required data-fv-notempty-message="Tidak boleh kosong"> User
                      </label>
                      <?php
                      } else if ($d['level_user'] == 'user') {
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="level_user" id="level_user" value="admin" required data-fv-notempty-message="Tidak boleh kosong"> Admin 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="level_user" id="level_user" value="user" required data-fv-notempty-message="Tidak boleh kosong" checked> User
                      </label>
                      <?php
                      }
                      ?>
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-info">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysql_query("DELETE FROM users WHERE id_user='$_GET[id]'");
      echo "<script>window.location='?pg=admin&act=view'</script>";
      break;

    }
    ?>