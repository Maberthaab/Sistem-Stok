<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN PENJUALAN //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Penjualan</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> Tabel Seto</a></li>
             </ol>
        </section>

<!--<section class="content">
  <div class="row">
  <div class="col-md-5">
  <form action="?pg=lappj&act=cek" method="POST">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
      <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
      </div>
  </div>
  <div class="col-md-5">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
      <input class="form-control" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="text" required/>
      </div>
  </div>
  
  <div class="col-md-2">
      <div class="form-group">
      <label for="exampleInputEmail1">Mulai Pencarian</label><br>
      <input type="submit" value="Pencarian" class="btn btn-info">
      </div>
  </div>
  </form>-->

<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box-header">
    <a href="?pg=persediaan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div>
    
  <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                   
                        <th>Tanggal Setor</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Setor</th>
                        <th>Harga</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                    <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                    
                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[harga],-"?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[isv_sales],-"?></td>
                    </tr>
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

  case 'cek':
  // menampilkan pertanyaan pertama
  $sqlp = "SELECT * FROM penjualan r
          JOIN produk p ON ( r.id_produk = p.id_produk) where
          tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
          ORDER BY nopenjualan ASC";

  $rs=mysql_query($sqlp);
  $data=mysql_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Penjualan</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> Laporan Penjualan</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
      <div class="col-md-5">
      <form action="?pg=lappj&act=cek" method="POST">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
          <input class="form-control" id="date" name="tglpenjualanaw" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
          <input class="form-control" id="date" name="tglpenjualanak" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn bg-orange">
          </div>
      </div>
      </form>

      <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-info">
                      <div class="box-body">
                      <div class="table-responsive">
                      <table class="table table-hover responsive">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>No Penjualan</th>
                            <th>Tanggal Penjualan</th>
                            <th>Nama Produk</th>
                            <th>Stok Produk</th>
                            <th>Jumlah Item Terjual</th>
                            <th>Harga Produk</th>
                            <th>Total Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT * FROM penjualan r
                        JOIN produk p ON ( r.id_produk = p.id_produk) where
                        tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                        ORDER BY nopenjualan ASC");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[nopenjualan]"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                            
                            <td align="center"><?php echo "$tglpenjualan"?></td>
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[stokproduk]"?></td>
                            <td align="center"><?php echo "$r[itemterjual]"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysql_fetch_array(mysql_query("SELECT sum(total_penjualan) as total_penjualan, 
                        sum(harga) as harga_produk, sum(itemterjual) as itemterjual FROM penjualan r  
                        join produk p on (r.id_produk=p.id_produk)
                        where 
                        tglpenjualan BETWEEN '$_POST[tglpenjualanaw]' 
                        AND  '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC"));
                        ?>
						
                        <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[itemterjual]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td align = "center"><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>
                      </div><!-- /.box-body -->
                  </div>
                  </div><!-- /.box -->
                  </div> <!-- /.col -->
      </div>
        <!-- /.row (main row) -->

      <div class="row">
              <div class="col-md-4 col-md-offset-8">
              <form role="form" action="cetak_pdf.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-danger">
                  <i class="fa fa-file-pdf-o">   Simpan ke PDF</i>  
                  </button>
                  </div>
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanaw']?>">
                  <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" placeholder="Nama Konsumen" value= "<?php echo $_POST['tglpenjualanak']?>">
                  </div>
              </form>
          </div>
          </div>
          </div>

    </section> <!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->

<?php
} else { 
  ?>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1> Silahkan pilih</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> laporan Penjualan</a></li>
             </ol>
      </section>

      <section class="content">
          <div class="box box-success">
              <div class="box-body">
                  <div class="form-group">
                  <?php
                  echo " <p> Maaf untuk pencarian yang anda cari tidak tersedia. <br>
                  Silahkan coba lakukan pencarian ulang. Terima Kasih </p>";
                  
                  ?>
                  </div>
              </div>
          </div>
      </section> <!-- /.content -->
    </div> <!-- /.container -->
  </div> <!-- /.content-wrapper -->

  <?php
  }
  ?>

<?php
break;
}
?>