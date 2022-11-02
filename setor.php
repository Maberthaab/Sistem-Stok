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
        <h1> Data Setoran </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=setor&act=view">Data Setor</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=setor&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                      
                        <th>Tanggal Setor</th>                     
                        <th>Nama Barang</th>
                         <th>Jumlah Setor</th>
                         <th>Harga</th>
                         <th>Total Setor
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysql_query("SELECT * FROM tb_setor r join produk p 
                    on (p.kd_brg=r.kd_brg)  order by id_setor asc");
                    $no = 1;
                      while ($r=mysql_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl_setor=tgl_indo($r['tgl_setor']);?>
                         <td><?php echo "$tgl_setor"?></td>

                        <td><?php echo "$r[nama_barang]"?></td>
                       
                         <td><?php echo "$r[jml_setor]"?></td>
                         <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                       
                       <td><?php echo "Rp.". number_format("$r[harga_setor]",'0','.','.')?></td>
                       
                        

                        <td><a href="?pg=setor&act=edit&id=<?php echo $r['id_setor']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>

                        <td><a href="?pg=setor&act=delete&id=<?php echo $r['id_setor']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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

        $harga_setor= $_POST[jml_setor] * $ambilProduk[harga];
        $sisaStok = $ambilProduk[stok] + $_POST[jml_setor];

        if ($_POST[jml_setor] > $ambilProduk[stok]){
          echo "<SCRIPT language=Javascript>
          alert('Gagal Menambahkan')
          </script>
          <script>window.location='?pg=setor&act=add'</script>";
        } else {

                $query = mysql_query("INSERT INTO tb_setor VALUES ('$_POST[id_setor]', '$_POST[tgl_setor]', '$_POST[kd_brg]',
                '$_POST[jml_setor]','$harga_setor')");

                mysql_query("update produk set stok = '$sisaStok'
                             where kd_brg = '$_POST[kd_brg]'");
                echo "<script>window.alert('Data Berhasil DI Simpan')
				window.location='?pg=setor&act=view'</script>";
              }
            }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=setor&act=view">Data Penjualan</a></li>
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
                      $sql = mysql_query("select * from tb_setor");
                      
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
                      $kode_jadi = "Imut_dong$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">ID Setor</label>
                      <input type="text" class="form-control" id="id_setor" name="id_setor" placeholder="ID Setor" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="id_setor" name="id_setor" placeholder="ID Setor" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                   
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Setor</label>
                      <input class="form-control" id="date" name="tgl_setor" placeholder="MM/DD/YYY" type="text"/>
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
                      <label for="exampleInputEmail1">Jumlah Setor</label>
                      <input type="number" class="form-control" id="jml_setor" name="jml_setor" placeholder="Jumlah Setor" required data-fv-notempty-message="Tidak boleh kosong">
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
      $d = mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE kd_brg='$_GET[id]'"));
            if (isset($_POST['update'])) {


 $harga_setor= $_POST[jml_setor] * $ambilProduk[harga];
        $krgStok = $bilProduk[stok] - $_POST[jml_setor];

                mysql_query("UPDATE tb_setor SET kd_brg ='$kd_brg', tgl_setor ='$_POST[tgl_setor]', nama_barang ='$_POST[nama_barang]',
                  jml_setor ='$_POST[jml_setor]' WHERE id_setor ='$_POST[id]'");
               echo "<script>window.location='?pg=setor&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> TABEL SETOR </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=setor&act=view">Tabel Setor</a></li>
            <li class="active">Update Tabel Setor</li>
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
                      <label for="exampleInputEmail1">Tanggal Setor</label>
                      <input class="form-control" id="date" name="tgl_setor" placeholder="MM/DD/YYY" type="text"/>
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
                      <label for="exampleInputEmail1">Jumlah Setor </label>
                      <input type="number" class="form-control" id="jml_setor" name="jml_setor" placeholder="Jumlah Setor " value= "<?php echo $d['jml_setor'];?>">
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
      $ambilProduk = mysql_fetch_array(mysql_query("select * from tb_setor r
        join produk p on (r.kd_brg=p.kd_brg) where id_setor='$_GET[id]'"));

      $stokproduk = $ambilProduk[jml_setor] - $ambilProduk[stok];

      mysql_query("update produk set stok = '$stokproduk'
                    where kd_brg = '$ambilProduk[kd_brg]'");

      mysql_query("DELETE FROM tb_setor WHERE id_setor='$_GET[id]'");
      echo "<script>window.location='?pg=setor&act=view'</script>";
      break;

    }
    ?>
    