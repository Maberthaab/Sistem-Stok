<?php
error_reporting
?>

<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA PRODUK //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Anggota </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=anggota&act=view">Data Baranl   
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=anggota&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Umur</th>
                        <th>Edit</th> 
                        <th>Delete</th>
                      </tr>
                    </thead>
					
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM tb_anggota order by id_anggota asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama_anggota]"?></td>
                        <td><?php echo "$r[alamat]"?></td>
                        <td><?php echo "$r[pekerjaan]"?></td>

                        <td><?php echo "$r[umur]"?></td>
                                               
                        <td><a href="?pg=anggota&act=edit&id=<?php echo $r['id_anggota']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=anggota&act=delete&id=<?php echo $r['id_anggota']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH DATA PRODUK //
      case 'add':
//proses
    if(isset($_POST['add'])) {
    $nama_anggota=$_POST['nama_anggota'];
    $alamat=$_POST['alamat'];
    $pekerjaan=$_POST['pekerjaan'];
    $umur=$_POST['umur'];
  
   
//script validasi data
 
    $cek = mysql_num_rows(mysql_query("SELECT * FROM tb_anggota WHERE 
	id_anggota='$id_anggota'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama Anggota yang anda masukan sudah ada')
    window.location='?pg=anggota&act=view'</script>";
    }else {
    $query = mysql_query("INSERT INTO tb_anggota VALUES ('','$_POST[nama_anggota]',
                '$_POST[alamat]','$_POST[pekerjaan]','$_POST[umur]')");
                
    echo "<script>window.alert('Data Berhasil DI Simpan')
    window.location='?pg=anggota&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Anggota</h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=anggota&act=view">Data Produk</a></li>
            <li class="active"><a href="#">Tambah Data Anggota</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">

                     <?php
                      //memulai mengambil datanya
                      $sql = mysql_query("select * from tb_anggota");
                      
                      $num = mysql_num_rows($sql);
                      
                      if($num <> 0)
                      {
                      $kode = $num + 1;
                      }else
                      {
                      $kode = 1;
                      }
                      
                      //mulai bikin kode
                      $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);
                      $tahun = date('Ym');
                      $kode_jadi = "Nice$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">ID Anggota</label>
                      <input type="text" class="form-control" id="id_anggota" name="id_anggota" placeholder="ID Anggota" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="id_anggota" name="id_anggota" placeholder="Id Anggota" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                       <div class="form-group">
                      <label for="exampleInputEmail1">Nama Anggota</label>
                      <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Nama Anggota" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>

                       <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat " required data-fv-notempty-message="Tidak boleh kosong">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Pekerjaan</label>
                      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                 
					 <div class="form-group">
                      <label for="exampleInputEmail1">Umur</label>
                      <input type="text" class="form-control" id="umur" name="umur" placeholder="Umur" required data-fv-notempty-message="Tidak boleh kosong">
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
     //  PROSES EDIT DATA PRODUK //
      case 'edit':
      $d = mysql_fetch_array(mysql_query("SELECT * FROM tb_anggota WHERE id_anggota='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysql_query("UPDATE tb_anggota SET nama_anggota='$_POST[nama_anggota]',
                  alamat='$_POST[alamat]',pekerjaan='$_POST[pekerjaan]',umur='$_POST[umur]' WHERE id_anggota='$_POST[id]'");
                echo "<script>window.location='?pg=anggota&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=anggota&act=view">Data Produk</a></li>
            <li class="active">Update Data Anggota</li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Anggota</label>
                      <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Nama Anggota" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nama_anggota'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value= "<?php echo $d['alamat'];?>">
                      <input type="hidden" class="form-control" id="id" name="id" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['id_anggota'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pekerjaan</label>
                      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value= "<?php echo $d['pekerjaan'];?>">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Umur</label>
                      <input type="text" class="form-control" id="umur" name="umur" placeholder="umur" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['umur'];?>">
                    </div>
                   
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-info">Update</button>
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
      mysql_query("DELETE FROM tb_anggota WHERE id_anggota='$_GET[id]'");
      echo "<script>window.location='?pg=anggota&act=view'</script>";
      break;

    }
    ?>