<?php
session_start();
require '../../include/function.php';

if (!isset($_SESSION['username'])) {
  header('location:../../login');
  exit();
}

$username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
$dataUser = mysqli_fetch_assoc($queryUser);

if ($dataUser['level'] !== "Admin") {
  require '../../404.shtml';
  die();
}


if (isset($_POST['tombol_simpan'])) {
  $status = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['status']))));
  $trx = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['trx']))));

  if (empty($status) OR empty($trx)) {
      alert('gagal', 'Gaga mengupdate pembelian', 'kelola-pembelian');
  } else {
      mysqli_query($konek, "UPDATE riwayat SET status = '$status' WHERE order_id = '$trx'");
      alert('berhasil', 'Status pembelian berhasil di update', 'kelola-pembelian');
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
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Admin - Kelola Pembelian</title>
    <!-- This page plugin CSS -->
    <link href="../../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
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
        
        <?php require '../../property/nav_admin.php'; ?>

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
                        <h4 class="page-title">Kelola Pembelian</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>/admin">Dashboard Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kelola Pembelian</li>
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
                                <i class="mdi mdi-cart m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Kelola Pembelian</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">List Semua Pembelian Users(Member / Admin)</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
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
                                          $q = mysqli_query($konek, "SELECT * FROM riwayat ORDER BY id DESC LIMIT 100");
                                          while($r = mysqli_fetch_assoc($q)) :
                                          ?>
                                          <tr>
                                            <td hidden><?= $no; ?></td>
                                            <td align="center"><div style="cursor:pointer" onclick="detail('<?= $r['order_id']; ?>');"><i class="fas fa-plus-circle text-success"></i>&nbsp;<?= $r['order_id']; ?></div></td>
                                            <td><?= $r['service']; ?></td>
                                            <td>
                                              <input type="text" class="form-control" value="<?= $r['target']; ?>" readonly>
                                            </td>
                                            <td>Rp&nbsp;<?= number_format($r['harga'],0,',','.'); ?></td>
                                            <td>
                                              <?php 
                                              // contoh mengecek status pesanan
                                              $cek_status = $api->status(array(
                                                'id' => $r['order_id'] // id pesanan
                                              ));
                                              $get_start_count = $cek_status['data']['start_count'];
                                              $get_remains = $cek_status['data']['remains'];
                                              $order_id = $r['order_id'];
                                              mysqli_query($konek, "UPDATE riwayat SET start_count = '$get_start_count' WHERE order_id = '$order_id'");
                                              mysqli_query($konek, "UPDATE riwayat SET remains = '$get_remains' WHERE order_id = '$order_id'");
                                              if ($cek_status) {
                                              $statusPembelian = $cek_status['data']['status'];
                                                if ($statusPembelian == "Pending") {
                                                  echo '<span class="label label-warning">Pending</span>';
                                                  $order_id = $r['order_id'];
                                                  mysqli_query($konek, "UPDATE riwayat SET status = 'Pending' WHERE order_id = '$order_id'");
                                                } else if ($statusPembelian == "Success" || $statusPembelian == "Sukses") {
                                                  echo '<span class="label label-success">Success</span>';
                                                  $order_id = $r['order_id'];
                                                  mysqli_query($konek, "UPDATE riwayat SET status = 'Success' WHERE order_id = '$order_id'");
                                                } else if ($statusPembelian == "Gagal" || $statusPembelian == "Canceled" || $statusPembelian == "Error") {
                                                  echo '<span class="label label-danger">'.$statusPembelian.'</span>';
                                                  $order_id = $r['order_id'];
                                                  mysqli_query($konek, "UPDATE riwayat SET status = '$statusPembelian' WHERE order_id = '$order_id'");
                                                } else if ($statusPembelian == "Partial") {
                                                  echo '<span class="label label-danger">Partial</span>';
                                                  $order_id = $r['order_id'];
                                                  mysqli_query($konek, "UPDATE riwayat SET status = 'Partial' WHERE order_id = '$order_id'");
                                                } else {
                                                  echo '<span class="label label-primary">'.$statusPembelian.'</span>';
                                                  $order_id = $r['order_id'];
                                                  mysqli_query($konek, "UPDATE riwayat SET status = '$statusPembelian' WHERE order_id = '$order_id'");
                                                }
                                              } else{
                                                echo '<span class="badge badge-danger">Sambungan Terputus</span>';
                                              }
                                              ?>
                                            </td>
                                            <td align="center">
                                              <?php
                                                if ($cek_status) {
                                                  $refund = $r['refund'];
                                                    if ($refund > '0') {
                                                      echo '<span class="label label-success"><i class="fa fa-check"></i></span> <span class="label label-light-success"><i class="fa fa-check"></i></span>';
                                                    } else{
                                                      echo '<span class="label label-danger"><i class="mdi mdi-close-outline"></i></span> <span class="label label-light-danger"><i class="mdi mdi-close-outline"></i></span>';
                                                    }
                                                } else{
                                                  echo '<span class="badge badge-danger">Sambungan Terputus</span>';
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

            <?php require '../../property/footer.php';?>


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
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/app.init.overlay.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="../../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 charts -->
    <script src="../../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../../assets/extra-libs/c3/c3.min.js"></script>
    <!--chartjs -->
    <script src="../../assets/libs/chart.js/dist/Chart.min.js"></script>
    <!--This page plugins -->
    <script src="../../assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="../../dist/js/pages/datatable/datatable-basic.init.js"></script>
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