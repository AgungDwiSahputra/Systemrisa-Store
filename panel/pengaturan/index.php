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
    $passwordL = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['passwordL']))));
    $passwordB = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['passwordB']))));
    $kpasswordB = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['kpasswordB']))));

    if (empty($passwordL) OR empty($passwordB) OR empty($kpasswordB)) {
        alert('gagal', 'Masih ada data yang kosong', 'pengaturan');
    } else {
        if (strlen($passwordB) > 6 AND strlen($passwordB) < 25) {
            if ($passwordB === $kpasswordB) {
                if (password_verify($passwordL, $dataUser['password'])) {
                    $newPas = password_hash($passwordB, PASSWORD_DEFAULT);
                    mysqli_query($konek, "UPDATE user SET password = '$newPas' WHERE username = '$username'");
                    alert('berhasil', 'Password baru berhasil di simpan', 'pengaturan');
                } else {
                    alert('gagal', 'Password lama tidak sesuai', 'pengaturan');
                }
            } else {
                alert('gagal', 'Konfirmasi password tidak sesuai', 'pengaturan');
            }
        } else {
            alert('gagal', 'Password minimal 7 dan maksimal 24 karakter', 'pengaturan');
        }
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
    <title>Pengaturan Akun</title>
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
                        <h4 class="page-title">Pengaturan Akun</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
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
                <!-- ============================================================== -->
                <!-- Login box.scss -->
                <!-- ============================================================== -->
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                        <i class="fas fa-cogs m-r-5 display-7 float-left"></i><h4 class="card-title">Pengaturan Akun</h4>
                            <h5 class="card-subtitle">Ganti Password</h5>
                        </div>
                    </div>
						<!-- Form -->
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
                        <form class="needs-validation" action="" method="POST">
                            <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltipUsername">Password Lama</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="text" name="passwordL" class="form-control" id="validationTooltipUsername" placeholder="Password Lama" aria-describedby="validationTooltipUsernamePrepend" required>
                                <div class="invalid-tooltip">
                                    Masukan Password Lama Kamu!
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltipUsername">Password Baru</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="passwordB" class="form-control" id="validationTooltipUsername" placeholder="Password Baru" aria-describedby="validationTooltipUsernamePrepend" required>
                                <div class="invalid-tooltip">
                                    Masukan Password Baru!
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltipUsername">Ketik Ulang Password Baru</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="kpasswordB" class="form-control" id="validationTooltipUsername" placeholder="Ketik Ulang Password Baru" aria-describedby="validationTooltipUsernamePrepend" required>
                                <div class="invalid-tooltip">
                                    Masukan Password Baru!
                                </div>
                                </div>
                            </div>
                            </div>
                            <button class="btn btn-danger mt-4" type="reset">Reset</button>
                            <button class="btn btn-info mt-4" type="submit" name="tombol">Selesai</button>
                        </form>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Login box.scss -->
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