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
        <h1> Data Persediaan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pembelian&act=view">Data Baranda 
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box-header">
    <a href="?pg=pembelian&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Jumlah Beli</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
          
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM tb_pembelian order by id_pembelian asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama_brg]"?></td>
                        <td><?php echo "$r[kd_brg]"?></td>
                        <td><?php echo "$r[jumlah_beli]"?></td>
                        <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                        <td><?php echo "$r[total]"?></td>
                       
                        
                       
                        <td><a href="?pg=pembelian&act=delete&id_pembelian=<?php echo $r['id_pembelian']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
    $nama_brg=$_POST['nama_brg'];
    $kd_brg=$_POST['kd_brg'];
    $jumlah_beli=$_POST['jumlah_beli'];
    $harga=$_POST['harga'];
    $total=$_POST['total'];
    
   
//script validasi data
 
    $cek = mysql_num_rows(mysql_query("SELECT * FROM  WHERE 
  id_pembelian='$id_pembelian'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama Barang Yang Anda Masukan Sudah Ada')
    window.location='?pg=pembelian&act=view'</script>";
    }else {
    $query = mysql_query("INSERT INTO tb_pembelian VALUES ('','$_POST[nama_brg]'','$_POST[kd_brg]',
                '$_POST[jumlah_beli]','$_POST[harga]','$_POST[total]')");
                
    echo "<script>window.alert('Data Berhasil Di Simpan')
    window.location='?pg=pembelian&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Produk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pembelian&act=view">Data Pembelian</a></li>
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
                      <input type="text" class="form-control" id="nama_brg" name="nama_brg" placeholder="Nama Barang" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                              <div class="form-group">
                      <label for="exampleInputEmail1">Kode Barang</label>
                      <input type="text" class="form-control" id="kd_brg" name="kd_brg" placeholder="Kode Barang" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Beli </label>
                      <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli" placeholder="Jumlah Beli" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>  

                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
           <div class="form-group">
                      <label for="exampleInputEmail1">Total</label>
                      <input type="text" class="form-control" id="total" name="total" placeholder="Total" required data-fv-notempty-message="Tidak boleh kosong">
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