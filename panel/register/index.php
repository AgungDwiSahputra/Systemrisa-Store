<?php
session_start();
require '../include/function.php';

if (isset($_SESSION['username'])) {
    header('location:../');
    exit();
}
if (isset($_POST['tombol'])) {
  if ($_SESSION['captcha'] === $_POST['captcha']) {
    if (isset($_POST['nama']) AND isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['kpassword']) AND isset($_POST['email']) AND isset($_POST['no_hp']) AND isset($_POST['setuju'])) {

      $nama = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['nama']))));
      $username = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username']))));
      $email = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['email']))));
      $no_hp = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['no_hp']))));
      $password = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password']))));
      $kpassword = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['kpassword']))));
      $setuju = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['setuju']))));
      $token=hash('sha256', md5(date('Y-m-d'))) ;
      
      if (empty($username) OR empty($email) OR empty($password) OR empty($kpassword) OR empty($setuju)) {
        alert('gagal', 'Masih ada data yang kosong','register');
      } else {
        $qUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
        
        if (strlen($username) < 6 OR strlen($username) > 24) {
          alert('gagal', 'Jumlah username min 6 dan max 24 karakter', 'register');
        } else if ($password !== $kpassword) {
          alert('gagal', 'Konfirmasi password tidak sesuai', 'register');
        } else if (strlen($password) < 6 OR strlen($password) > 24) {
          alert('gagal', 'Jumlah password min 6 dan max 24 karakter', 'register');
        } else if (mysqli_num_rows($qUser) > 0 ) {
          alert('gagal', 'Username sudah digunakan', 'register');
        } else {

          $password_hash = password_hash($password, PASSWORD_DEFAULT);
          $insert = mysqli_query($konek, "INSERT INTO user (nama, username, password, saldo, saldo_terpakai, email, token, no_hp, level, status, tanggal_reg) VALUES ('$nama', '$username','$password_hash','0','0','$email', '$token', '$no_hp','Member','Off','$tanggal $waktu')");
		  include("mail.php");
		  if ($insert) {
            alert('berhasil', 'Pendaftaran berhasil silahkan Cek Email untuk Verifikasi.', 'register');
          }
        }
      }
    } else {
      alert("gagal", "Masih ada data yang kosong", "register");
    }
  } else {
    alert("gagal", "Kode captcha tidak valid", "register");
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
        content="Halaman Pendaftaran pada SMM Panel Systemrisa Store">
    <meta name="keywords"
        content="<?= $keywords ?>">
    <meta name="author" content="<?= $author ?>">
    <meta name="generator" content="Systemrisa <?= $versi ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Register Panel</title>
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
                <div>
                    <div class="logo">
                        <span><i class="fas fa-user-plus"></i></span>
                        <h5 class="font-medium m-b-20">Pendaftaran</h5>
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
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" action="#" method="POST">
                                <div class="form-group row ">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-md" type="text" name="nama" required=" " placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-md" type="text" name="username" required=" " placeholder="Username">
                                        <small>* Masukan username untuk Login</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-md" type="email" name="email" required=" " placeholder="Email Aktif">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-md" type="number" minlength="11" name="no_hp" required=" " placeholder="Nomor Aktif">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-md" type="password" name="password" required=" " placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-md" type="password" name="kpassword" required=" " placeholder="Ketikan Ulang Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <img src="captcha.php" alt="captcha"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control form-control-md" type="number" required="" name="captcha" placeholder="Captcha">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 ">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="setuju" class="custom-control-input" required id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Saya menyetujui <a href="syarat-ketentuan.php">Syarat dan Ketentuan</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center ">
                                    <div class="col-xs-12 p-b-20 ">
                                        <button class="btn btn-block btn-lg btn-info" type="submit" name="tombol">Daftar</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10 ">
                                    <div class="col-sm-12 text-center ">
                                        Sudah memiliki Akun? <a href="../login" class="text-info m-l-5 "><b>Masuk</b></a>
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
    <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
    </script>
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->