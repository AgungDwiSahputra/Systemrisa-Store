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
  $metode = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['metode'])));
  $jumlah = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['quantity'])));

  if (empty($metode) OR empty($jumlah)) {
      alert('gagal', 'Masih ada data yang kosong', 'deposit');
  } else {
      $id = rand(000000,999999);
      $qDeposit = mysqli_query($konek, "SELECT * FROM metode WHERE id = '$metode'");
      if (mysqli_num_rows($qDeposit) === 1 ) {
          $fDeposit = mysqli_fetch_assoc($qDeposit);
          if ($jumlah > 1000000) {
              alert('gagal', 'Jumlah maksimal deposit tidak sesuai', 'deposit');
          } else if ($jumlah < 20000) {
              alert('gagal', 'Jumlah minimum deposit tidak sesuai', 'deposit');
          } else {

              if ($fDeposit['tipe'] === "BANK") {
                  $noHP = "";
                  $saldoDidapat = ($jumlah * $fDeposit['rate']) + rand(000,999);
                  $tampilTF = $saldoDidapat;
                  $totalJumlah = $jumlah + rand(000,999);
              } else {
                  $noHP = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['noHP'])));
                  $saldoDidapat = $jumlah * $fDeposit['rate'];
                  $tampilTF = $jumlah;
              }

              $tipeDeposit = $fDeposit['tipe'];
              $metodeDeposit = $fDeposit['metode'];
              $tujuanDeposit = $fDeposit['tujuan'];
			  include("mail.php");
              mysqli_query($konek, "INSERT INTO deposit (id_deposit, username, jumlah_deposit, saldo_didapat, pengirim, tipe_deposit, metode_deposit, tujuan_deposit, status, tanggal, waktu) VALUES ('$id','$username','$tampilTF','$saldoDidapat','$noHP','$tipeDeposit','$metodeDeposit','$tujuanDeposit','Menunggu','$tanggal','$waktu')");

              alert('berhasil', 'Silahkan transfer sebesar ' . number_format($totalJumlah,0,',','.') . ' ke ' . $tujuanDeposit . ' via ' . $metodeDeposit . ' sebelum 24 jam.', 'deposit');

          }

      } else {
          alert('gagal', 'Metode deposit tidak di temukan', 'deposit');
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
    <title>Deposit Baru</title>
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
                        <h4 class="page-title">Deposit Baru</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Deposit</li>
                                    <li class="breadcrumb-item active" aria-current="page">Deposit Baru</li>
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
                    <div class="col-md-7 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-info">
                                <div class="col-lg-12 m-t-10">
                                <i class="mdi mdi-credit-card-plus m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Deposit Baru</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Pilih salah satu dari metode pembayaran</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <form class="form-horizontal" role="form" action="" method="POST">
                                <div class="form-group">
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
                                  <label class="control-label">Tipe</label>
                                  <select name="tipe" id="tipe" class="form-control">
                                      <option value="0">Pilih salah satu</option>
                                      <?php 
                                      $queryKat = mysqli_query($konek, "SELECT DISTINCT tipe FROM metode ORDER BY tipe ASC");
                                      while ($rowKat = mysqli_fetch_assoc($queryKat)) :
                                      ?>
                                      <option value="<?= $rowKat['tipe']; ?>"><?= $rowKat['tipe']; ?></option>
                                      <?php endwhile; ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Metode</label>
                                    <select name="metode" id="metode" class="form-control">
                                        <option value="0">Pilih Kategori</option>
                                    </select>
                                </div>

                                <div class="form-group hide" id="noHP">
                                    <label class="control-label">No HP</label>
                                    <input type="number" class="form-control" name="noHP" autocomplete="off" placeholder="Masukan nomor kamu">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Jumlah Deposit</label>
                                            <input type="hidden" class="form-control" id="rate">
                                            <input type="number" class="form-control" name="quantity" id="quantity" onkeyup="getcut(this.value).value;" require>
                                            <small id="note"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Saldo Didapat</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  Rp
                                                </div>
                                              </div>
                                              <input type="text" class="form-control" disabled="disabled" readonly="readonly" id="cutbalance">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-danger" type="reset">Reset</button>
                                    <button class="btn btn-info" type="submit" name="tombol">Deposit Baru</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-orange">
                                <div class="col-lg-12 m-t-10">
                                    <i class="mdi mdi-book-open-page-variant m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Petunjuk Deposit</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Wajib dibaca</h5>
                                </div>
                            </div>
                            <div class="card-body">
                              <b>Panduan Top Up :</b>
                              <ul>
                                <li>1. Silahkan pilih Tipe Pembayaran</li>
                                <li>2. Silahkan pilih bank tujuanmu</li>
                                <li>3. Masukkan nominal isi saldo yang Anda inginkan (min Rp 20.000)</li>
                                <li>4. Pada halaman selanjutnya akan muncul no rekening tujuan dan nominal yang harus ditransfer (hingga 3 digit random terakhir).</li>
                              </ul>
                              <b>PENTING :</b>
                              <ul>
                              <li>Anda hanya dapat memiliki maksimal 2 permintaan deposit Pending, jadi jangan melakukan spam dan segera lunasi pembayaran.</li>
                              <li>Jika permintaan deposit tidak dibayar dalam waktu lebih dari 12 jam, maka permintaan deposit akan otomatis dibatalkan.</li>
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

    <script type="text/javascript">
        var htmlobjek;
        function getcut(quantity){
            var rate = $("#rate").val();
            var hasil = eval(quantity) * rate;
            var balik = hasil.toFixed(0);

            var number_string = balik.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
          
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
          
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            $('#cutbalance').val(rupiah);
        } 

        $(document).ready(function(){
        
            $("#tipe").change(function(){
                var tipe = $("#tipe").val();

                if (tipe === "Pulsa Transfer") {
                    $("#noHP").removeClass('hide');
                } else {
                    $("#noHP").addClass('hide');
                }
            
                $.ajax({
                    url : 'get-tipe.php',
                    data    : 'tipe='+tipe,
                    type    : 'POST',
                    dataType: 'html',
                    success : function(msg){
                              $("#metode").html(msg);
                        }
                });
            });
        
            $("#metode").change(function(){
            var metode = $("#metode").val();
            
            $.ajax({
                url: 'get-tipe.php',
                data: 'note='+metode,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#note").removeClass('hide')
                    $("#note").html(msg);
                }
            });

            $.ajax({
                url: 'get-tipe.php',
                data: 'rate='+metode,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#rate").val(msg);
                }
            });
          });
        
        });
    </script>
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->