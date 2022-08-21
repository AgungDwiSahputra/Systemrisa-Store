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
        content="Daftar Layanan pada SMM Panel Systemrisa Store">
    <meta name="keywords"
        content="<?= $keywords ?>">
    <meta name="author" content="<?= $author ?>">
    <meta name="generator" content="Systemrisa <?= $versi ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Daftar Layanan</title>
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
                        <h4 class="page-title">Daftar Layanan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Layanan</li>
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
                                <i class="mdi mdi-package-variant m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Daftar Layanan</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Kumpulan layanan-layanan yang tersedia</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
                                        <thead class="bg-megna">
                                            <tr class="font-bold">
                                              <th>No</th>
                                              <th>Layanan</th>
                                              <th>Kategori</th>
                                              <th>Harga 1k</th>
                                              <th>Min</th>
                                              <th>Max</th>
                                              <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $no = 1;
                                        $q = mysqli_query($konek, "SELECT * FROM service ORDER BY category ASC");
                                        while($r = mysqli_fetch_assoc($q)) :
                                        ?>
                                        <tr>
                                          <td><?= $no; ?></td>
                                          <td><?= $r['service']; ?></td>
                                          <td><?= $r['category']; ?></td>
                                          <td>Rp&nbsp;<?= number_format($r['harga'],0,',','.'); ?></td>
                                          <td><?= number_format($r['min'],0,',','.'); ?></td>
                                          <td><?= number_format($r['max'],0,',','.'); ?></td>
                                          <td><?= str_replace("buzzerpanel", "Systemrisa Store", $r['note']); ?></td>
                                        </tr>
                                        <?php $no++; endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>No</th>
                                              <th>Layanan</th>
                                              <th>Kategori</th>
                                              <th>Harga<br>(per 1k)</th>
                                              <th>Min</th>
                                              <th>Max</th>
                                              <th>Catatan</th>
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