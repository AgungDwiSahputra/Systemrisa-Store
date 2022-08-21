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
    <title>Pertanyaan Umum</title>
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
                        <h4 class="page-title">Pertanyaan Umum</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Halaman</li>
                                    <li class="breadcrumb-item active" aria-current="page">Pertanyaan Umum</li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row draggable-cards m-t-20" id="draggable-area">
                    <div class="col-md-12 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-info">
                                <div class="col-lg-12 m-t-10">
                                <i class="mdi mdi-comment-multiple-outline m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Pertanyaan Umum</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Beberapa Pertanyaan yang sering di ajukan oleh Member Kami</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <div id="accordion">
                              <div class="card">
                                <a href="#panel-body-1" class="btn btn-dark text-light" data-toggle="collapse">Apa itu <?= $web_service['nama']; ?>?</a>
                                <div id="panel-body-1" class="card-body collapse show">
                                  <b><?= $web_service['nama']; ?></b> - ADALAH sebuah platform SMM Panel Termurah dan Terbaik di Indonesia yang menyediakan berbagai Layanan Social Media yang bergerak terutama di Indonesia. Anda dapat menambah Followers, Likes, Views, Subscriber, untuk beragam Social Media: Instagram, Youtube, Facebook, Twitter dengan harga Termurah.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-2" class="btn btn-dark text-light" data-toggle="collapse">Apa itu layanan No Complain?</a>
                                <div id="panel-body-2" class="card-body collapse">
                                  Layanan No Complain adalah layanan yang dilarang untuk komplain jika orderan selesai tapi yang masuk kurang atau lambat masuk tidak boleh komplain.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-3" class="btn btn-dark text-light" data-toggle="collapse">Bagaimana cara membuat pesanan?</a>
                                <div id="panel-body-3" class="card-body collapse">
                                  Untuk membuat pesanan sangatlah mudah, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan patikan akun Anda memiliki Saldo yang cukup, lalu menuju halaman Pembelian dengan mengklik menu Pembelian Baru. Pilih Kategori dan Layanan yang ingin di beli lalu akan tampil detail layanan, masukan jumlah beli dan target lalu klik tombol Beli Sekarang.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-4" class="btn btn-dark text-light" data-toggle="collapse">Bagaimana cara melakukan deposit/isi saldo?</a>
                                <div id="panel-body-4" class="card-body collapse">
                                  Untuk melakukan deposit/isi saldo, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman Deposit Saldo dengan mengklik menu Deposit Saldo. Kami menyediakan deposit melalui BANK/PULSA/PULSA MKIOS/Lainnya.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-5" class="btn btn-dark text-light" data-toggle="collapse">Bagaimana jika orderan saya EROR/CANCEL/PARTIAL?</a>
                                <div id="panel-body-5" class="card-body collapse">
                                Mohon menunggu paling lambat 3x24 jam, orderan stuck kemungkinan dikarenakan server yang sedang overload. Harap bersabar dan jika lebih dari 3x24 jam orderan tetap stuck, segera hubungi Admin atau buat Tiket bantuan.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-6" class="btn btn-dark text-light" data-toggle="collapse">Bagaimana jika orderan saya STUCK di PENDING?</a>
                                <div id="panel-body-6" class="card-body collapse">
                                Mohon menunggu paling lambat 3x24 jam, orderan stuck kemungkinan dikarenakan server yang sedang overload. Harap bersabar dan jika lebih dari 3x24 jam orderan tetap stuck, segera hubungi Admin atau buat Tiket bantuan.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-7" class="btn btn-dark text-light" data-toggle="collapse">Bagaimana cara Systemrisa Store melayani membernya?</a>
                                <div id="panel-body-7" class="card-body collapse">
                                Jika Anda mengalami kendala saat menggunakan layanan Systemrisa Store, kami memberikan bantuan dengan tanggap dan cepat melalui WA <a href="https://api.whatsapp.com/send?phone=+6281298623982">+6281298623982</a>. Silahkan tambahkan nomor WA kami ke kontak Anda untuk mendapatkan informasi penting dari kami.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-8" class="btn btn-dark text-light" data-toggle="collapse">Apakah Layanan Systemrisa Store dapat menyebabkan akun sosmed tersuspend?</a>
                                <div id="panel-body-8" class="card-body collapse">
                                Layanan di Systemrisa Store hanya membutuhkan url / username target saja, dimana hal tersebutlah yang dibutuhkan seseorang untuk memfollow / like postingan kita. Sehingga akun social media Anda tidak didaftarkan ke program apapun yang melanggar ketentuan social media. Logikanya apabila dapat menyebabkan akun tersuspend maka Anda dapat mensuspend akun artis hanya dengan tau username nya saja bukan? Dengan demikian kami tetap menyarankan Anda untuk menggunakan layanan Systemrisa Store dengan bijak. Maksudnya adalah jangan juga menambahkan puluhan ribu follower ke akun yang baru beberapa jam dibuat, karena hal tersebut juga tidak masuk akal dan mungkin akan menimbulkan kecurigaan terhadap akun Anda.
                                </div>
                              </div>

                              <div class="card">
                                <a href="#panel-body-9" class="btn btn-dark text-light" data-toggle="collapse">Apakah semua layanan di Systemrisa Store bergaransi?</a>
                                <div id="panel-body-9" class="card-body collapse">
                                Iya, tapi tidak semua layanan bergaransi hanya saja layanan yang kami berikan label garansi.
                                </div>
                              </div>
                            </div>
                            </div>
                        </div>
                    </div>
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