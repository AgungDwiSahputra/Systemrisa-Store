<?php
session_start();
require '../include/function.php';

if (isset($_SESSION['username'])) {
    header('location:../');
    exit();
}
if (isset($_POST['tombol'])) {
  if (isset($_POST['username']) AND isset($_POST['password'])) {

      $username = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username']))));
      $password = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password']))));

      $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
      $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];

      $q = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
      $queryLogin = mysqli_fetch_assoc($q);

      if (empty($username) || empty($password)) {
        alert("gagal", "Masih ada data yang kosong", "login");
      } else if (strlen($username) < 5 || strlen($username) > 24) {
        alert("gagal", "Username tidak valid", "login");
      } else if (strlen($password) < 5 || strlen($password) > 24) {
        alert("gagal", "Password tidak valid", "login");
      } else if ($username !== $queryLogin['username']) {
        alert("gagal", "Username atau Password salah", "login");
      } else if ($queryLogin['status'] === "Off") {
        alert("gagal", "Akun Kamu belum di Verifikasi", "login");
      } else if (mysqli_num_rows($q) !== 1) {
        alert("gagal", "Username atau Password salah", "login");
      } else if (password_verify($password, $queryLogin['password'])) {
        $_SESSION['username'] = $queryLogin['username'];
        header("location:../");
        exit();
      } else {
        alert("gagal", "Username atau password salah", "login");
      }
    } else {
      alert("gagal", "Username atau password salah", "login");
    }
}

?>

<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Halaman Masuk pada SMM Panel Systemrisa Store">
    <meta name="keywords"
        content="<?= $keywords ?>">
    <meta name="author" content="<?= $author ?>">
    <meta name="generator" content="Systemrisa <?= $versi ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Login Panel</title>
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
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><i class="fas fa-key"></i></span>
                        <h5 class="font-medium m-b-20">Silahkan Login</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
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
                            <form class="form-horizontal m-t-20" id="loginform" method="POST" action="#">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="username" class="form-control form-control-md" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-md" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Tetap Masuk</label>
                                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Lupa Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" name="tombol" type="submit">Masuk</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Kamu belum memiliki Akun? <a href="../register" class="text-info m-l-5"><b>Daftar</b></a>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                    <a href="<?= $link_awal?>" class="text-info m-l-5"><b>kembali ke tampilan awal</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <span class="db"><i class="fas fa-recycle"></i></span>
                        <h5 class="font-medium m-b-20">Pengembalian Akun</h5>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="#" method="POST">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <span>Klik Tombol di Bawah dan masukan Username Kamu</span>
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20">
                                <div class="col-12">
                                    <a href="https://api.whatsapp.com/send?phone=+6282110860615&text=Assalamu'alaikum...%0AUntuk%20Admin,%0ASaya%20telah%20kehilangan%20Password%20Akun%20Saya,%20dengan%20Username%20->%20"><button class="btn btn-block btn-lg btn-danger" type="button" name="kirim_recovery">Kirim Pengajuan</button></a>
                                    <small>* Kamu Harus menggunakan Android untuk pengajuan Pengembalian Akun, dikarenakan Tombol tersebut langsung menuju ke Whatsapp Admin</small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->