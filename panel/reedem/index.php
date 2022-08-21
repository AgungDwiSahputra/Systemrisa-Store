<?php
session_start();
require '../include/function.php';

if (!isset($_SESSION['username'])) {
  header('location:../login');
  exit();
}

$username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
$dataUser = mysqli_fetch_assoc($queryUser);

if (isset($_POST['tombol'])) {
    if (isset($_POST['code'])) {
        $code = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['code']))));
  
        $q = mysqli_query($konek, "SELECT * FROM voucher WHERE code_voucher = '$code'");
        $queryReedem = mysqli_fetch_assoc($q);
  
        if (empty($code)) {
          alert("gagal", "Masih ada data yang kosong", "reedem");
        } else if ($code !== $queryReedem['code_voucher']) {
          alert("gagal", "Code Voucher yang Kamu masukan salah", "reedem");
        } else if ($queryReedem['status'] == "1") {
          alert("gagal", "Code Voucher sudah di gunakan", "reedem");
        } else if (mysqli_num_rows($q) !== 1) {
          alert("gagal", "Code Voucher yang Kamu masukan salah", "reedem");
        } else if ($code == $queryReedem['code_voucher']) {
            $qReedem = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
            $fReedem = mysqli_fetch_assoc($qReedem);
            $dapatSaldo = $queryReedem['jumlah'];
            $saldoSekarang = $fReedem['saldo'];
            $saldoJadi = $fReedem['saldo'] + $dapatSaldo;
            $tAmbil = "$tanggal, $waktu";
            mysqli_query($konek, "UPDATE user SET saldo = saldo+$dapatSaldo WHERE username = '$username'");
            mysqli_query($konek, "INSERT INTO saldo (username, aksi, saldo_aktifity, tanggal, efek, saldo_awal, saldo_jadi) VALUES ('$username','Melakukan Reedem Voucher', '$dapatSaldo','$tanggal $waktu','+ Saldo','$saldoSekarang','$saldoJadi')");
            mysqli_query($konek, "UPDATE voucher SET username = '$username', status = '1', tanggal_ambil = '$tAmbil' WHERE code_voucher = '$code'");
            alert("berhasil", "Code Voucher Berhasil di Guanakan...", "reedem");
        } else {
          alert("gagal", "Code Voucher yang Kamu masukan salah", "reedem");
        }
      } else {
        alert("gagal", "Code Voucher yang Kamu masukan salah", "reedem");
      }
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
    <title>Reedem Voucher</title>
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


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php 
if ($maintenance['status'] == 'on') {
    header("location:../../maintenance/");
}else{
?>
<!-- ==================================================================== -->


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
        
        <?php require '../property/nav.php'; ?>

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
                        <h4 class="page-title">Reedem Voucher</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Deposit</li>
                                    <li class="breadcrumb-item active" aria-current="page">Reedem Voucher</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-6 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                <div><span class="text-info display-5"><i class="mdi mdi-wallet"></i></span></div>
                            </div>
                            <div class=""><h5>Sisa Saldo</h5>
                                <h4 class="text-info m-b-0 font-medium"> Rp. <?= number_format($dataUser['saldo'],0,',','.'); ?></h4></div>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row draggable-cards m-t-20" id="draggable-area">
                    <div class="offset-3"></div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-info">
                                <div class="col-lg-12 m-t-10">
                                <i class="mdi mdi-barcode-scan m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Reedem Voucher</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Masukan Code Voucher Kamu</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <form class="form-horizontal" role="form" action="" method="POST">
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
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Code Voucher</label>
                                            <input type="text" placeholder="Masukan code voucher" class="form-control" name="code" require>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-info" type="submit" name="tombol">Reedem Voucher</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="offset-3"></div>
                </div>
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


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->