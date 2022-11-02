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
        <h1> Data Pembelian </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=beli&act=view">Data Pembelian</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=beli&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
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
                      
                       
                        <th>Jumlah Beli</th>
                         <th>Harga</th>
                         <th>Total </th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM tb_pembelian r join produk p 
                    on (p.kd_brg=r.kd_brg)  order by id_pembelian asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                       
                        <td><?php echo "$r[nama_barang]"?></td>
                       
                         <td><?php echo "$r[jumlah_beli]"?></td>
                         <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                       
                        <td><?php echo "Rp.". number_format("$r[total]",'0','.','.')?></td>

                        <td><a href="?pg=beli&act=edit&id=<?php echo $r['id_pembelian']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>

                        <td><a href="?pg=beli&act=delete&id=<?php echo $r['id_pembelian']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH DATA REALISASI //
      case 'add':
      if (isset($_POST['add'])) {

        $ambilProduk = mysql_fetch_array(mysql_query("select * from produk where kd_brg = '$_POST[kd_brg]'"));

        $total= $_POST[jumlah_beli] * $ambilProduk[harga];
        $sisaStok = $ambilProduk[stok] - $_POST[jumlah_beli];

        if ($_POST[jumlah_beli] > $ambilProduk[stok]){
          echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan')
          </script>
          <script>window.location='?pg=beli&act=add'</script>";
        } else {

                $query = mysql_query("INSERT INTO tb_pembelian VALUES ('$_POST[id_pembelian]','$_POST[kd_brg]',
                '$_POST[jumlah_beli]','$total')");

                mysql_query("update produk set stok = '$sisaStok'
                             where kd_brg = '$_POST[kd_brg]'");
                echo "<script>window.alert('Data Berhasil DI Simpan')
				window.location='?pg=beli&act=view'</script>";
              }
            }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=beli&act=view">Data Penjualan</a></li>
            <li class="active"><a href="#">Tambah Data Penjualan</a></li>
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
                      $sql = mysql_query("select * from tb_pembelian");
                      
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
                      $kode_jadi = "RPL1$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">Nomor Penjualan</label>
                      <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="id_pembelian" name="id_pembelian" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Barang</label> <br>
                      <select class="form-control select2" name="kd_brg" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama Barang ---">
                      <?php
                      $tampil=mysql_query("SELECT * FROM produk ORDER BY kd_brg");
                      while($r=mysql_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['kd_brg']?>"><?php echo $r['nama_barang'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Pembelian</label>
                      <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli" placeholder="Jumlah Pembelian" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name ='add' class="btn btn-info">Simpan</button>
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


<!---- UPDATE --->

  <?php
      break;
      // PROSES EDIT DATA PRODUK //
      case 'edit':
      $d = mysql_fetch_array(mysql_query("SELECT * FROM tb_pembelian WHERE id_pembelian='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysql_query("UPDATE tb_pembelian SET 
                  jumlah_beli='$_POST[jumlah_beli]' WHERE id_pembelian='$_POST[id]'");
               echo "<script>window.location='?pg=beli&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> TABEL PEMBELIAN </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=beli&act=view">Tabel Pembelian</a></li>
            <li class="active">Update Tabel Pembelian</li>
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
                      <label for="exampleInputEmail1">Nama Barang</label> <br>
                      <select class="form-control select2" name="kd_brg" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama Barang ---">
                      <?php
                      $tampil=mysql_query("SELECT * FROM produk ORDER BY kd_brg");
                      while($r=mysql_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['kd_brg']?>"><?php echo $r['nama_barang'] ?></option>
                      <?php
                    }
                    ?>
                     </optgroup>
                      </select>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Beli </label>
                      <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli" placeholder="Jumlah Beli " value= "<?php echo $d['jumlah_beli'];?>">
                    </div>

           </div>
           </div>
           </div>
           </div>

          
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
      
    // PROSES HAPUS DATA REALISASI //
      case 'delete':
      $ambilProduk = mysql_fetch_array(mysql_query("select * from tb_pembelian r
        join produk p on (r.kd_brg=p.kd_brg) where id_pembelian='$_GET[id]'"));

      $stokproduk = $ambilProduk[jumlah_beli] + $ambilProduk[stok];

      mysql_query("update produk set stok = '$stokproduk'
                    where kd_brg = '$ambilProduk[kd_brg]'");

      mysql_query("DELETE FROM tb_pembelian WHERE id_pembelian='$_GET[id]'");
      echo "<script>window.location='?pg=beli&act=view'</script>";
      break;

    }
    ?>
    