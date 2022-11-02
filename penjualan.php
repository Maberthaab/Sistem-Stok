<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA Penjualan //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan&act=view">Data Penjualan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=penjualan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
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
                     
                        <th>Harga Produk</th>
                         <th>Stok</th>
                        <th>Jumlah Pembelian</th>
                        <th>Total Penjualan</th>
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

                         <td><?php echo "$r[stok]"?></td>
                        
                        <td><?php echo "$r[jumlah_beli]"?></td>
                       
                        <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                      
                        <td><?php echo "Rp.". number_format("$r[total]",'0','.','.')?></td>
                        <td><a href="?pg=penjualan&act=delete&id=<?php echo $r['id_pembelian']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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

        $total_penjualan = $_POST[jumlah_beli] * $ambilProduk[harga];
        $sisaStok = $ambilProduk[stok] - $_POST[jumlah_beli];

        if ($_POST[jumlah_beli] > $ambilProduk[stok]){
          echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan')
          </script>
          <script>window.location='?pg=penjualan&act=add'</script>";
        } else {

                $query = mysql_query("INSERT INTO tb_pembelian VALUES ('$_POST[id_pembelian]', '$_POST[kd_brg]',
                
                '$_POST[jumlah_beli]','$total')");

                mysql_query("update produk set stok = '$sisaStok'
                             where kd_brg = '$_POST[kd_brg]'");
                echo "<script>window.alert('Data Berhasil DI Simpan')
				window.location='?pg=penjualan&act=view'</script>";
              }
            }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan&act=view">Data Penjualan</a></li>
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
                      <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" placeholder="Nomor Pembelian" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="id_pembelian" name="id_pembelian" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Produk</label> <br>
                      <select class="form-control select2" name="kd_brg" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama Produk ---">
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


      <?php
      break;
      
    // PROSES HAPUS DATA REALISASI //
      case 'delete':
      $ambilProduk = mysql_fetch_array(mysql_query("select * from penjualan r
        join produk p on (r.id_produk=p.id_produk) where nopenjualan='$_GET[id]'"));

      $stokproduk = $ambilProduk[itemterjual] + $ambilProduk[stokproduk];

      mysql_query("update produk set stokproduk = '$stokproduk'
                    where id_produk = '$ambilProduk[id_produk]'");

      mysql_query("DELETE FROM penjualan WHERE nopenjualan='$_GET[id]'");
      echo "<script>window.location='?pg=penjualan&act=view'</script>";
      break;

    }
    ?>
    