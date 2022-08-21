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

if (isset($_POST['tambah'])) {
  $code = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['code'])));
  $jumlah = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['jumlah'])));

  if (empty($code) OR empty($jumlah)) {
      alert('gagal', 'Voucher gagal di tambahkan', 'kelola-voucher');
  } else {
      mysqli_query($konek, "INSERT INTO voucher (username, code_voucher, jumlah, status, tanggal, waktu, tanggal_ambil) VALUES ('','$code','$jumlah','0','$tanggal','$waktu','')");
      alert('berhasil', 'Voucher berhasil di tambahkan', 'kelola-voucher');
  }

}

if (isset($_POST['edit'])) {
$code = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['code'])));
$jumlah = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['jumlah'])));

if (empty($code) OR empty($jumlah)) {
    alert('gagal', 'Voucher gagal di Edit', 'kelola-voucher');
} else {
    mysqli_query($konek, "UPDATE voucher SET code_voucher = '$code', jumlah = '$jumlah' WHERE code_voucher = '$code'");
    //alert('berhasil', 'Voucher berhasil di Edit', 'kelola-voucher');
}

}

if (isset($_GET['id'])) {
    $idHapus = $_GET['id'];
    mysqli_query($konek, "DELETE FROM voucher WHERE id = '$idHapus'");
    alert('berhasil', 'Informasi berhasil di hapus', 'kelola-voucher');
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
    <title>Admin - Kelola Voucher</title>
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
                        <h4 class="page-title">Kelola Voucher</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>/admin">Dashboard Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kelola Voucher</li>
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
                                <i class="mdi mdi-server m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Kelola Voucher</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">List Voucher yang Admin Buat</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-1">
                                        <button class="btn btn-lg btn-info btn-block" onclick="tambahLayanan();">Tambah Voucher</button>
                                    </div>
                                </div>
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
                                              <th width="20px">No</th>
                                              <th>Username</th>
                                              <th>Kode Voucher</th>
                                              <th>Jumlah</th>
                                              <th>status</th>
                                              <th>Tanggal Buat</th>
                                              <th>Tanggal Ambil</th>
                                              <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $no = 1;
                                        $q = mysqli_query($konek, "SELECT * FROM voucher ORDER BY id ASC");
                                        while($r = mysqli_fetch_assoc($q)) :
                                        ?>
                                        <tr>
                                          <td width="20px"><?= $no; ?></td>
                                          <td><?= $r['username']; ?></td>
                                          <td><?= $r['code_voucher']; ?></td>
                                          <td>Rp&nbsp;<?= number_format($r['jumlah'],0,',','.'); ?></td>
                                          <td><?= $r['status']; ?></td>
                                          <td><?= $r['tanggal']; ?>, <?= $r['waktu']; ?></td>
                                          <td><?= $r['tanggal_ambil']; ?></td>
                                          <td align="center">
                                            <a href="?id=<?= $r['id']; ?>"><i class="fas fa-trash text-danger"></i></a>&nbsp;|&nbsp;<i class="mdi mdi-lead-pencil text-success" style="cursor:pointer" onclick="edit('<?= $r['id']; ?>');"></i>
                                          </td>
                                        </tr>
                                        <?php $no++; endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th width="20px">No</th>
                                              <th>Username</th>
                                              <th>Kode Voucher</th>
                                              <th>Jumlah</th>
                                              <th>status</th>
                                              <th>Tanggal Buat</th>
                                              <th>Tanggal Ambil</th>
                                              <th>Aksi</th>
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
            <h5 class="modal-title" id="myModalLabel">Edit Voucher</h5>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
                <div id="data_detail"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success waves-effect" name="edit">Edit Voucher</button>
          </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- sample tambahLayanan content -->
    <div id="tambahLayanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahLayananLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahLayananLabel">Tambah Voucher</h5>
          </div>
          <div class="modal-body">
          <form action="" method="POST">
            <div class="form-group row ">
                <div class="col-12 ">
                <label>Code Voucher</label>
                    <input class="form-control form-control-md" type="text" name="code" required=" " placeholder="Code Voucher">
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-12 ">
                <label>Jumlah</label>
                    <input class="form-control form-control-md" type="number" name="jumlah" required=" " placeholder="Jumlah pada Voucher">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success waves-effect" name="tambah">Tambahkan Voucher</button>
          </div>
          </form>
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
    function edit(id) {
      $("#myModal").modal('show');
      $.ajax({
          url : 'get-data.php',
          data    : 'id='+id,
          type    : 'POST',
          dataType: 'html',
          success : function(msg){
                   $("#data_detail").html(msg);
              }
      });
    }
    function tambahLayanan() {
      $("#tambahLayanan").modal('show');
    }
  </script>
</body>

</html>