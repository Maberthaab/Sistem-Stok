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
            <li class="active"><a href="?pg=beli&act=view">Data Penjualan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box-header">
    <a href="?pg=belian&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                   
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID Pembelian</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah Beli</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                      
                                                        $no = 1;
                                                        $cari ="";
                                                        if (isset($_POST['cari'])) {
                                                            $cari = $_POST['cari'];
                                                        }
                                                        $query = "SELECT * FROM pembelian 
                                                               
                                                                where nama_barang like '%".$cari."%'";
                                                        $sql = mysqli_query($connect, $query);

                                                        while($data = mysqli_fetch_array($sql)){
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $no++;?></td>
                                                            <td><?php echo $data['id_pembelian'];?></td>
                                                            <td><?php echo $data['kode_barang'];?></td>
                                                            <td><?php echo $data['nama_barang'];?></td>
                                                            <td><?php echo $data['jumlah_beli'];?></td>
                                                            <td><?php echo $data['harga'];?></td>
                                                            <td><?php echo $data['total'];?></td>
                                                            <td><a href="pembelian_edit_form.php?id_pembelian=<?php echo $data['id_pembelian'];?>" class="btn btn-success"><i class="fa fa-user-edit"></i>Edit</a>
                                                                <a href="pembelian_hapus.php?id_pembelian=<?php echo $data["id_pembelian"]; ?>" onclick=" return confirm('Anda Yakin Menghapus Data Ini');" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
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

   