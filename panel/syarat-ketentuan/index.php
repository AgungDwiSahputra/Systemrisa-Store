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
    <meta name="description"
        content="Syarat dan Ketentuan pada SMM Panel Systemrisa Store">
    <meta name="keywords"
        content="<?= $keywords ?>">
    <meta name="author" content="<?= $author ?>">
    <meta name="generator" content="Systemrisa <?= $versi ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Syarat & Ketentuan</title>
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
                        <h4 class="page-title">Syarat & Ketentuan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Halaman</li>
                                    <li class="breadcrumb-item active" aria-current="page">Syarat & Ketentuan</li>
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
                                <i class="mdi mdi-alert-circle m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Syarat & Ketentuan</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Baca dan Pahami</h5>
                                </div>
                            </div>
                            <div class="card-body">
                              <h4>1. UMUM</h4>
                              <p>Anda hanya akan menggunakan situs web SYSTEMRISA STORE dengan cara yang mengikuti semua perjanjian yang dibuat dengan Instagram / Facebook / Twitter / Youtube / situs media sosial lainnya di halaman Ketentuan Layanan masing-masing.<br />Tarif SYSTEMRISA STORE dapat berubah sewaktu-waktu tanpa pemberitahuan. Kebijakan pembayaran / pengembalian dana tetap berlaku jika terjadi perubahan tarif.<br />SYSTEMRISA STORE tidak menjamin waktu pengiriman untuk layanan apa pun. Kami menawarkan estimasi terbaik kami kapan pesanan akan dikirimkan. Ini hanya perkiraan dan SYSTEMRISA STORE tidak akan mengembalikan pesanan yang sedang diproses jika Anda merasa terlalu lama.<br />SYSTEMRISA STORE berusaha keras untuk memberikan apa yang diharapkan dari kami oleh reseller kami. Dalam hal ini, kami berhak untuk mengubah jenis layanan jika kami menganggap perlu untuk menyelesaikan pesanan.</p>
                              <ul><br />
                              <li>Dengan melakukan pembelian pada panel SYSTEMRISA STORE, maka Anda otomatis menyetujui semua ketentuan yang berlaku dibawah ini baik Anda baca maupun tidak.</li><br />
                              <li>Kami berhak mengubah ketentuan perjanjian Layanan SYSTEMRISA STORE jika memang diperlukan tanpa pemberitahuan terlebih dahulu.</li><br />
                              <li>Anda diharapkan membaca semua ketentuan layanan, petunjuk dan pengumuman yang ada di dashboard sebelum melakukan pembelian untuk memastikan Anda mengikuti setiap perubahan pada ketentuan layanan kedepannya.</li><br />
                              <li>Tarif yang berlaku pada SYSTEMRISA STORE dapat berubah sewaktu-waktu yang akan diinfokan pada pengumuman di Dashboard Anda.</li><br />
                              <li>PENOLAKAN: SYSTEMRISA STORE tidak akan bertanggung jawab atas segala kerusakan yang Anda atau bisnis Anda mungkin alami.</li><br />
                              <li>KEWAJIBAN: SYSTEMRISA STORE sama sekali tidak bertanggung jawab atas setiap akun yang disuspend, penghapusan gambar, video dan semacamnya yang dilakukan oleh Instagram / Twitter / Facebook / Youtube / Google / Web Traffic dan lainnya.</li><br />
                              </ul><br />

                              <h4>2. LAYANAN</h4>
                              <ul><br />
                              <li>SYSTEMRISA STORE hanya digunakan untuk membuat akun Instagram / Twitter / Facebook / Youtube / Google / Web Traffic Anda &ldquo;<strong>terlihat</strong>&rdquo; popular saja.</li><br />
                              <li>Kami <strong>TIDAK</strong> dapat memberi jaminan bahwa followers/subscriber akan berinteraksi dengan Anda.</li><br />
                              <li>Kami <strong>TIDAK</strong> menjamin pengikut baru Anda akan berinteraksi dengan Anda, kami hanya menjamin Anda untuk mendapatkan pengikut yang Anda bayar.</li><br />
                              <li>Kami tidak memberikan jaminan untuk setiap layanan akan bertahan selamanya, Kami tidak akan bertanggung jawab atas hal itu dan tidak ada pengembalian deposit.</li><br />
                              <li>Pembelian pada umumnya selesai dalam hitungan menit atau jam tergantung dari layanan yang Anda pilih.</li><br />
                              <li>Setiap pesanan tidak bisa dibatalkan begitu saja, kecuali dibatalkan oleh server. Pastikan link yang Anda masukkan sudah benar sesuai petunjuk.</li><br />
                              <li>Untuk <strong>layanan non garansi tidak ada refund / refill</strong>, bahkan jika berkurang 5 menit sejak status orderan completed,&nbsp;<em>order with your own risk</em>.&nbsp;</li><br />
                              <li>Untuk layanan <strong>bergaransi</strong> apabila berkurang, silahkan <strong>request&nbsp;refill</strong>&nbsp;dengan menyertakan order id melalui Live Chat Website Pojok Kanan Bawah.</li><br />
                              <li>Silahkan follow up proses refill setelah 24 jam. Jika Request refill belum masuk bisa request refill lagi.</li><br />
                              <li>Jika tidak terjadi penambahan pada orderan Anda selama 24 jam silahkan <strong>request speed up</strong> dengan menyertakan order id melalui <a href="https://r-i-s-a.my.id/panel/kontak-kami/" target="_blank" rel="noopener">WA admin</a> untuk mempercepat pengerjaan orderan Anda. Melakukan komplain di sosial media kami tidak akan membantu menyelesaikan masalah Anda.</li><br />
                              <li>Jika sudah request speed up namun orderan tidak kunjung selesai selama 3 hari, Anda dapat <strong>request cancel</strong> dengan menyertakan order id melalui&nbsp;<a style="background-color: #ffffff;" href="https://r-i-s-a.my.id/panel/kontak-kami/" target="_blank" rel="noopener">WA admin</a>&nbsp;untuk membatalkan dan merefund orderan Anda.</li><br />
                              <li>Data username dan url yang Anda input saat proses order hanya untuk keperluan transaksi orderan dan kami tidak akan menyebarluaskannya.</li><br />
                              <li>Tidak ada pengembalian dana atau complain untuk layanan non komplain&nbsp;jika orderan selesai tapi yang masuk kurang(Tidak Masuk Sama Sekali) atau lambat masuk tidak boleh komplain.</li><br />
                              <li>Akun pribadi tidak akan mendapat pengembalian uang! Harap pastikan bahwa akun Anda bersifat publik sebelum memesan.</li><br />
                              </ul><br />

                              <h4>3. PEMBAYARAN / KEBIJAKAN PENGEMBALIAN DANA</h4>
                              <ul><br />
                              <li>Pastikan mentransfer hingga tiga digit terakhir untuk mempercepat proses penambahan saldo.</li><br />
                              <li>Orderan yang berstatus partial/cancel, saldo akan di refund otomatis ke akun Anda. Anda dapat mengeceknya dihalaman Saldo &gt; Refund List</li><br />
                              <li>Tidak ada pengembalian dana ke rekening Anda apabila deposit telah berhasil dilakukan.</li><br />
                              <li>Deposit tidak dapat diuangkan, kecuali Anda menjual kembali layanan yang ada di SYSTEMRISA STORE.</li><br />
                              <li>Apabila user menggunakan bukti transfer palsu, maka kami akan langsung membanned akun Anda tanpa pemberitahuan dan pengembalian dana.</li><br />
                              </ul><br />

                              <h4>5. LAIN - LAIN</h4>
                              <ul><br />
                              <li>Segala bentuk komplain dan konfirmasi top up akan dihandle oleh tim customer support kami.</li><br />
                              <li>Mohon hargai customer support kami dengan berbicara sopan dan tidak melakukan ancaman. Kami berhak menolak member yang tidak memenuhi kriteria ini di panel kami.<br /><br /></li><br />
                              </ul>
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