<?php
session_start();
require '../include/function.php';

if (!isset($_SESSION['username'])) {
  header('location:../');
  exit();
}

$username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
$dataUser = mysqli_fetch_assoc($queryUser);

if ($dataUser['level'] !== "Admin") {
  require '../404.shtml';
  die();
}

function jumlah($qu) {
global $konek;
$q = mysqli_query($konek, $qu);
return number_format(mysqli_num_rows($q),0,',','.');
}

function total($qu, $mi) {
global $konek;
$q = mysqli_query($konek, $qu);
$a = 0;
while ($f = mysqli_fetch_assoc($q)) {
  $a += $f[$mi];
}
return number_format($a,0,',','.');
}

/* PENAMPILAN DATA PROFILE */
$profile = $api->profile();


//UNTUK MAINTENANCE
//ON
if (isset($_POST['on'])) {

$query = mysqli_query($konek, "UPDATE maintenance SET status = 'on'");
alert('berhasil', 'Server MODE MAINTENANCE <b>(ON)</b>', 'admin');
}
//OFF
if (isset($_POST['off'])) {

$query = mysqli_query($konek, "UPDATE maintenance SET status = 'off'");
alert('berhasil', 'Server MODE MAINTENANCE <b>(OFF)</b>', 'admin');
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Dashboard Admin - Panel</title>
    <!-- Custom CSS -->
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        
        <?php require '../property/nav_admin.php'; ?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h4 class="page-title">Dashboard Admin</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard Admin</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php if (isset($_COOKIE['gagal'])): ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                      <h4 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Terjadi kesalahan</h4> <?= $_COOKIE['gagal']; ?>
                  </div>
                  <?php endif ?>
                  <?php if (isset($_COOKIE['berhasil'])): ?>
                      <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                          <h3 class="text-success"><i class="fa fa-check-circle"></i> Berhasil</h3> <?= $_COOKIE['berhasil']; ?>
                  </div>
                <?php endif ?>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-6">
                        <div class="card border-bottom border-danger">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2>Rp.&nbsp;<?= total("SELECT * FROM riwayat WHERE tanggal = '$tanggal'", 'harga'); ?></h2>
                                        <h6 class="text-danger">Total Pembelian Hari Ini</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-danger display-6"><i class="ti-shopping-cart-full"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-3">
                        <div class="card border-bottom border-success">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                      <form action="" method="POST">
                                        <button type="submit" name="on" class="btn waves-effect waves-light btn-outline-danger m-b-10 <?php if ($maintenance['status'] == 'off') {echo '';} else{echo 'active';}?>">Mode ON</button>
                                        <button type="submit" name="off" class="btn waves-effect waves-light btn-outline-success m-b-10 m-l-10 <?php if ($maintenance['status'] == 'on') {echo '';} else{echo 'active';}?>">Mode Off</button>
                                        <h6 class="text-success">Mode Maintenance</h6>
                                      </form>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-success display-6"><i class="ti-world"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card bg-info">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row">
                                    <div class="display-6 align-self-center"><i class="ti-user"></i></div>
                                    <div class="p-10 align-self-center">
                                        <h4 class="m-b-0">Nama WEBSITE</h4>
                                        <span>Admin</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0">
                                          <?php 
                                          if ($profile) {
                                              echo "".$profile['data']['full_name']; 
                                          } else{
                                              echo "Periksa Koneksi Kamu";
                                          }?>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card bg-info">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center display-6"><i class="ti-wallet"></i></div>
                                    <div class="p-10 align-self-center">
                                        <h4 class="m-b-0">Total Saldo WEBSITE</h4>
                                        <span>Admin</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0">
                                          <?php 
                                          if ($profile) {
                                              echo "Rp.&nbsp;".number_format($profile['data']['balance'],0,',','.');
                                          } else{
                                              echo "Periksa Koneksi Kamu";
                                          }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-primary"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0">Total Semua</h4>
                                        <span class="text-muted">Member</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0"><?= jumlah("SELECT * FROM user WHERE username != 'admin'"); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card bg-primary">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center display-6"><i class="ti-user"></i></div>
                                    <div class="p-10 align-self-center">
                                        <h4 class="m-b-0">Total Semua</h4>
                                        <span>Admin</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0"><?= jumlah("SELECT * FROM user WHERE username = 'admin'"); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0">Jumlah Semua Saldo</h4>
                                        <span class="text-muted">Member</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0">Rp.&nbsp;<?= total("SELECT * FROM user WHERE username != 'admin'", "saldo"); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card bg-success">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row">
                                    <div class="display-6 align-self-center"><i class="ti-wallet"></i></div>
                                    <div class="p-10 align-self-center">
                                        <h4 class="m-b-0">Jumlah Semua Saldo</h4>
                                        <span>Admin</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0">Rp.&nbsp;<?= total("SELECT * FROM user WHERE username = 'admin'", "saldo"); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-warning"><i class="ti-shopping-cart-full"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0">Total Semua Pembelian</h4>
                                        <span class="text-muted">Member</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0"><?= jumlah("SELECT * FROM riwayat WHERE username != 'admin'"); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card bg-orange">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row">
                                    <div class="display-6 align-self-center"><i class="ti-shopping-cart-full"></i></div>
                                    <div class="p-10 align-self-center">
                                        <h4 class="m-b-0">Total Semua Pembelian</h4>
                                        <span>Admin</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0"><?= jumlah("SELECT * FROM riwayat WHERE username = 'admin'"); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-shopping-cart-full"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0">Jumlah Semua Pembelian</h4>
                                        <span class="text-muted">Member</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0">Rp.&nbsp;<?= total("SELECT * FROM riwayat WHERE username != 'admin'", 'harga'); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row">
                                    <div class="display-6 align-self-center"><i class="ti-shopping-cart-full"></i></div>
                                    <div class="p-10 align-self-center">
                                        <h4 class="m-b-0">Jumlah Semua Pembelian</h4>
                                        <span>Admin</span>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <h2 class="font-medium m-b-0">Rp.&nbsp;<?= total("SELECT * FROM riwayat WHERE username = 'admin'", 'harga'); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- End Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container Fluid -->
            <!-- ============================================================== -->

            <?php require '../property/footer.php';?>


        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/app.init.overlay.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 charts -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <!--chartjs -->
    <script src="../assets/libs/chart.js/dist/Chart.min.js"></script>
</body>

</html>