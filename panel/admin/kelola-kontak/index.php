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

if (isset($_POST['tombol'])) {
  $nama = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['nama'])));
  $jabatan = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['jabatan'])));
  $wa = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['wa'])));
  $nama_facebook = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['nama_facebook'])));
  $link_facebook = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['link_facebook'])));
  $username_ig = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username_ig'])));

  if (empty($nama) OR empty($jabatan) OR empty($wa) OR empty($nama_facebook) OR empty($link_facebook) OR empty($username_ig)) {
      alert('gagal', 'Masih ada data yang kosong', 'kelola-kontak');
  } else {
      mysqli_query($konek, "INSERT INTO kontak (nama, fb, link_fb, wa, ig, jabatan) VALUES ('$nama','$nama_facebook','$link_facebook','$wa','$username_ig', '$jabatan')");
      alert('berhasil', 'Kontak baru berhasil di tambahkan', 'kelola-kontak');
  }
}

if (isset($_GET['id'])) {
  $idN = $_GET['id'];
  mysqli_query($konek, "DELETE FROM kontak WHERE id = '$idN'");
  alert('berhasil', 'Kontak berhasil di hapus', 'kelola-kontak');
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
    <title>Admin - Kelola Kontak</title>
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
                        <h4 class="page-title">Kelola Kontak</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>/admin">Dashboard Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kelola Kontak</li>
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
                <div class="col-md-5 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-info">
                                <div class="col-lg-12 m-t-10">
                                <i class="mdi mdi-contacts m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Kelola Kontak</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Tambah Kontak Admin/Customer</h5>
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
                                  <label class="control-label">Nama</label>
                                  <input type="text" class="form-control" autocomplete="off" name="nama">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Jabatan</label>
                                  <input type="text" class="form-control" autocomplete="off" name="jabatan">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Kontak Whatsapp</label>
                                    <input type="numer" class="form-control" autocomplete="off" name="wa">
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Nama Facebook</label>
                                  <input type="text" class="form-control" autocomplete="off" name="nama_facebook">
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Link Facebook</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        https://facebook.com/
                                      </div>
                                    </div>
                                    <input type="text" name="link_facebook" class="form-control" autocomplete="off">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Username Instagram</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        https://instagram.com/
                                      </div>
                                    </div>
                                    <input type="text" name="username_ig" class="form-control" autocomplete="off">
                                  </div>
                                </div>

                                <div class="form-group text-right">
                                    <button class="btn btn-danger" type="reset">Reset</button>
                                    <button class="btn btn-info" type="submit" name="tombol">Tambah Kontak</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-orange">
                                <div class="col-lg-12 m-t-10">
                                    <i class="mdi mdi-book-open-page-variant m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Data Kontak</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">List Kontak yang sudah ditambahkan</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
                                        <thead class="bg-warning">
                                            <tr class="font-bold">
                                              <th hidden>No</th>
                                              <th>Nama</th>
                                              <th>Jabatan</th>
                                              <th>Whatsapp</th>
                                              <th>Facebook</th>
                                              <th>Instagram</th>
                                              <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $no = 1;
                                            $qInfo = mysqli_query($konek, "SELECT * FROM kontak ORDER BY id DESC");
                                            while($rInfo = mysqli_fetch_assoc($qInfo)) :
                                            ?>
                                            <tr>
                                              <td hidden><?= $no; ?></td>
                                              <td><?= $rInfo['nama']; ?></td>
                                              <td><?= $rInfo['jabatan']; ?></td>
                                              <td><?= $rInfo['wa']; ?></td>
                                              <td><a href="https://facebook.com/<?= $rInfo['link_fb']; ?>"><?= $rInfo['fb']; ?></a></td>
                                              <td><a href="https://instagram.com/<?= $rInfo['ig']; ?>"><?= $rInfo['ig']; ?></a></td>
                                              <td align="center">
                                                <a href="?id=<?= $rInfo['id']; ?>"><i class="fas fa-trash text-danger"></i></a>
                                                <hr>
                                                <div style="cursor:pointer" onclick="detail('<?= $rInfo['id']; ?>');"><i class="fas fa-pencil-alt text-success"></i></div>
                                              </td>
                                            </tr>
                                            <?php $no++; endwhile; ?>
                                            <?php if (mysqli_num_rows($qInfo) === 0 ): ?>
                                            <tr>
                                              <td colspan="5" align="center">Tidak ada metode</td>
                                            </tr>
                                        <?php endif ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th hidden>No</th>
                                              <th>Nama</th>
                                              <th>Jabatan</th>
                                              <th>Whatsapp</th>
                                              <th>Facebook</th>
                                              <th>Instagram</th>
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
      $("#title_n").html('Detail Kontak');
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