<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pengguna</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- penutup -->
  <!-- jQuery 3 -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
  <!-- penutup -->
  <body>
  	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href=""><img alt="Brand" src="<?=base_url('assets/open-book.png');?>" style="height: 30px"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href=""><b style="font-size: 20px">Perpus</b></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
        <li><a href="<?=base_url('pengguna/pinjam/tampil_cart') ?>"><i class="glyphicon glyphicon-shopping-cart"></i> Keranjang Pinjam</a></li>
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/dist/img/'.$user['gambar']); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$user['nama_user']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/dist/img/'.$user['gambar']); ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $user['nama_user'] ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="">
                  <a href="<?php echo base_url('login/logout') ?>" class="btn btn-block btn-flat btn-primary">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">

<div class="row">

        <div class="col-lg-3">

          <div class="list-group">
            <a class="list-group-item"><strong>KATEGORI</strong></a>
            <a href="<?php echo base_url()?>pengguna/pinjam/index/" class="list-group-item">Semua</a>
            <?php
                foreach ($kategori as $row) 
            {
      ?>
            <a href="<?php echo base_url()?>pengguna/pinjam/index/<?php echo $row['id_kategori'];?>" class="list-group-item"><?php echo $row['nama_kategori'];?></a>
            <?php
            }
      ?>
          </div><br>

           <div class="list-group">
           <a href="<?php echo base_url()?>pengguna/pinjam/tampil_cart" class="list-group-item"><strong><i class="glyphicon glyphicon-shopping-cart"></i> KERANJANG PINJAM</strong></a>
          <?php 
      
        $cart= $this->cart->contents();

// If cart is empty, this will show below message.
      if(empty($cart)) {
        ?>
                <a class="list-group-item">Keranjang Pinjam Kosong</a>
                <?php
      }
      else
        {
          $grand_total = 0;
          foreach ($cart as $item)
            {
              $grand_total+=$item['subtotal'];
        ?>
                <a class="list-group-item"><?php echo $item['name']; ?> </a>
                <?php 
            }
        ?>

                <?php   
        }
 ?>
      </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

<div class="row">

  <?=$contents; ?>

  </div>
          <!-- /.row -->
   </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>


<footer class="page-footer" style="background-color: #e3f2fd;">
	<div class="footer-copyright text-center py-3">© 2019 Copyright Smk 3
  </div>
</footer>
  	
  </body>
  </html>