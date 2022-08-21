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
    <title>Riwayat Pembelian</title>
    <!-- This page plugin CSS -->
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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
                        <h4 class="page-title">Riwayat Pembelian</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
                                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pembelian</li>
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
                                <i class="mdi mdi-cart m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Riwayat Pembelian</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">List Pembelian Kamu</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
                                        <thead class="bg-megna">
                                            <tr class="font-bold">
                                              <th hidden>No</th>
                                              <th width="10">Order&nbsp;ID</th>
                                              <th>Layanan</th>
                                              <th>Target</th>
                                              <th>Harga</th>
                                              <th>Status</th>
                                              <th>Pengembalian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                          $no = 1;
                                          $q = mysqli_query($konek, "SELECT * FROM riwayat WHERE username = '$username' ORDER BY id DESC");
                                          while($r = mysqli_fetch_assoc($q)) :
                                          ?>
                                          <tr>
                                            <td hidden><?= $no; ?></td>
                                            <td align="center"><div style="cursor:pointer" onclick="detail('<?= $r['order_id']; ?>');"><i class="fas fa-plus-circle text-success"></i>&nbsp;<?= $r['order_id']; ?></div></td>
                                            <td><?= $r['service']; ?></td>
                                            <td>
                                                <input type="text" class="form-control" id="dataCopy" value="<?= $r['target']; ?>" readonly>
                                            </td>
                                            <td>Rp&nbsp;<?= number_format($r['harga'],0,',','.'); ?></td>
                                            <td>
                                              <?php 
                                              $statusPembelian = $r['status'];
                                                if ($statusPembelian == "Pending") {
                                                  echo '<span class="label label-warning">Pending</span>';
                                                } else if ($statusPembelian == "Success" || $statusPembelian == "Sukses") {
                                                  echo '<span class="label label-success">Success</span>';
                                                } else if ($statusPembelian == "Gagal" || $statusPembelian == "Canceled" || $statusPembelian == "Error") {
                                                  echo '<span class="label label-danger">'.$statusPembelian.'</span>';
                                                  $trx = $r['order_id'];
                                                  $harga = $r['harga'];
                                                  $awal_saldo = $dataUser['saldo'];
                                                  $saldo_jadi = $dataUser['saldo'] + $harga;
                                                  $refund = $r['refund'];
                                                  if ($refund < '1') {
                                                    $kembali = mysqli_query($konek, "UPDATE user SET saldo = saldo+$harga WHERE username = '$username'");
                                                    $bukti_kembali = mysqli_query($konek, "INSERT INTO saldo (username, aksi, saldo_aktifity, tanggal, efek, saldo_awal, saldo_jadi) VALUES ('$username','Pengembalian dana. ID Pesanan: $trx','$harga','$tanggal $waktu', '+ Saldo','$awal_saldo','$saldo_jadi')");
                                                    if ($kembali && $bukti_kembali) {
                                                      mysqli_query($konek, "UPDATE riwayat SET harga = '0' WHERE username = '$username' AND order_id = $trx");
                                                      mysqli_query($konek, "UPDATE riwayat SET refund = '1' WHERE username = '$username' AND order_id = $trx");
                                                    }
                                                  }
                                                } else if ($statusPembelian == "Partial") {
                                                  echo '<span class="label label-danger">'.$statusPembelian.'</span>';
                                                  $trx = $r['order_id'];
                                                  $service = $r['service'];
                                                  $harga = $r['harga'];
                                                  $awal_saldo = $dataUser['saldo'];
                                                  $jumlah_awal = $r['jumlah'];
                                                  $jumlah_kurang = $r['remains'];
                                                  $jumlah_jadi = $jumlah_awal - $jumlah_kurang;
                                                  $queryService = mysqli_query($konek, "SELECT * FROM service WHERE service = '$service'");
                                                  $harga_asli = mysqli_fetch_assoc($queryService);
                                                  $harga_jadi = ($harga_asli['harga'] / 1000) * $jumlah_jadi;
                                                  $harga_total = $harga - $harga_jadi;
                                                  $saldo_jadi = $dataUser['saldo'] + $harga_total;
                                                  $refund = $r['refund'];
                                                  if ($refund < '1') {
                                                    $kembali = mysqli_query($konek, "UPDATE user SET saldo = saldo+$harga_total WHERE username = '$username'");
                                                    $bukti_kembali = mysqli_query($konek, "INSERT INTO saldo (username, aksi, saldo_aktifity, tanggal, efek, saldo_awal, saldo_jadi) VALUES ('$username','Pengembalian dana. ID Pesanan: $trx','$harga_total','$tanggal $waktu', '+ Saldo','$awal_saldo','$saldo_jadi')");
                                                    if ($kembali && $bukti_kembali) {
                                                      mysqli_query($konek, "UPDATE riwayat SET harga = '$harga_jadi' WHERE username = '$username' AND order_id = $trx");
                                                      mysqli_query($konek, "UPDATE riwayat SET refund = '1' WHERE username = '$username' AND order_id = $trx");
                                                    }
                                                  }
                                                } else {
                                                  echo '<span class="label label-primary">'.$statusPembelian.'</span>';
                                                }
                                              ?>
                                            </td>
                                            <td align="center">
                                              <?php
                                                $refund = $r['refund'];
                                                if ($refund > '0') {
                                                  echo '<span class="label label-success"><i class="fa fa-check"></i></span>';
                                                } else{
                                                  echo '<span class="label label-danger"><i class="mdi mdi-close-outline"></i></span>';
                                                }
                                              ?>
                                            </td>
                                          </tr>
                                        <?php $no++; endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th hidden>No</th>
                                              <th width="10">Order&nbsp;ID</th>
                                              <th>Layanan</th>
                                              <th>Target</th>
                                              <th>Harga</th>
                                              <th>Status</th>
                                              <th>Pengembalian</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel"><span id="title_n"></span></h5>
          </div>
          <div class="modal-body">
            <div id="data_detail"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
    <!--This page plugins -->
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script>
    $(document).ready( function () {
      $('#datatable').DataTable();
    });
  </script>

  <script>
    function detail(trx) {
      $("#title_n").html('Detail Pembelian ' + trx);
      $.ajax({
        url : 'get-detail.php',
        data    : 'trx='+trx,
        type    : 'POST',
        dataType: 'html',
        success : function(msg){
                 $("#data_detail").html(msg);
                 $("#myModal").modal('show');
            }
      });
    }
  </script>
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->