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
        <h1> Data Persediaan Novel </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pggna&act=view">Data Baranda 
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box-header">
    <a href="?pg=persediaan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Supplier</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
          
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM produk order by kd_brg asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama_barang]"?></td>
                        <td><?php echo "$r[stok]"?></td>
                        <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                        
                        <td><?php echo "$r[supplier]"?></td>
                       
                        
                       
                        <td><a href="?pg=persediaan&act=delete&id=<?php echo $r['kd_brg']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
    $nama_barang=$_POST['nama_barang'];
    $stok=$_POST['stok'];
    $harga=$_POST['harga'];
    $supplier=$_POST['supplier'];
    
   
//script validasi data
 
    $cek = mysql_num_rows(mysql_query("SELECT * FROM  WHERE 
  kode_barang='$kode_barang'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama Barang yang anda masukan sudah ada')
    window.location='?pg=persediaan&act=view'</script>";
    }else {
    $query = mysql_query("INSERT INTO produk VALUES ('','$_POST[nama_barang]',
                '$_POST[stok]','$_POST[harga]','$_POST[supplier]')");
                
    echo "<script>window.alert('Data Berhasil DI Simpan')
    window.location='?pg=persediaan&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Produk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=persediaan&act=view">Data Produk</a></li>
            <li class="active"><a href="#">Tambah Data Produk</a></li>
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
                      <label for="exampleInputEmail1">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Stok </label>
                      <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>  

                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
           <div class="form-group">
                      <label for="exampleInputEmail1">Supplier</label>
                      <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Supplier" required data-fv-notempty-message="Tidak boleh kosong">
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

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysql_query("DELETE FROM produk WHERE kd_brg='$_GET[id]'");
      echo "<script>window.location='?pg=persediaan&act=view'</script>";
      break;

    }
    ?>