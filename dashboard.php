<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

       <br/>
       <br/>
       <br/>
   

         <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
		<div class="callout callout-danger">
                <h4>Selamat Datang Di Sistem Stok Barang</h4>
                </p>
              </div>
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Info Admin</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">

                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Username</th>
                                <th>:</th>
                                <td>Mabertha Asasiyah Berliana
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <th>:</th>
                                <td><?php date_default_timezone_set("Asia/Jakarta"); echo $date = date(' H:i:s'); ?></td>
                            </tr>
                            
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-6">


                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Last Login</th>
                                <th>:</th>
                                <td><?php echo date('d-m-Y'); ?></td>
                            </tr>
                            <tr>
                                <th>IP Address</th>
                                <th>:</th>
                                <td><?php echo $_SERVER["REMOTE_ADDR"]; ?></td>
                            </tr>
                            <tr>
                                <th>Server</th>
                                <th>:</th>
                                <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
                            </tr>
                            <tr>
                                <th>Browser</th>
                                <th>:</th>
                                <td>WWW.sukses itu butuh kerja keras dan usaha karna masa depan ditangan kita.co.id</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
				
			
		</div>
      </div>
	 