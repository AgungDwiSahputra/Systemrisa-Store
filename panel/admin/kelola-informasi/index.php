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
  $tipe = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['tipe']))));
  $isi_informasi = addslashes(trim(mysqli_real_escape_string($konek, $_POST['isi_informasi'])));

  if (empty($tipe) OR empty($isi_informasi)) {
      alert('gagal', 'Masih ada data yang kosong', 'kelola-informasi');
  } else {
      if (strlen($isi_informasi) > 10000) {
          alert('gagal', 'Isi informasi terlalu panjang', 'kelola-informasi');
      } else {
          mysqli_query($konek, "INSERT INTO informasi (tipe, isi, tanggal) VALUES ('$tipe','$isi_informasi','$tanggal $waktu')");
          alert('berhasil', 'Informasi terbaru berhasil di publikasikan', 'kelola-informasi');
      }
  }

}

if (isset($_GET['id'])) {
  $idHapus = $_GET['id'];
  mysqli_query($konek, "DELETE FROM informasi WHERE id = '$idHapus'");
  alert('berhasil', 'Informasi berhasil di hapus', 'kelola-informasi');
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
    <title>Admin - Kelola Informasi</title>
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
                        <h4 class="page-title">Kelola Informasi</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>/admin">Dashboard Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kelola Informasi</li>
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
                                <i class="mdi mdi-projector-screen m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Kelola Informasi</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Tambah Informasi </h5>
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
                                  <label class="control-label">Judul</label>
                                    <input type="text" name="tipe" id="tipe" class="form-control" autocomplete="off">
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">Isi Informasi</label>
                                    <textarea id="mymce" name="isi_informasi"></textarea>
                                  </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-danger" type="reset">Reset</button>
                                    <button class="btn btn-info" type="submit" name="tombol">Tambah Informasi</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-orange">
                                <div class="col-lg-12 m-t-10">
                                    <i class="mdi mdi-book-open-page-variant m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Data Informasi</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">List Informasi</h5>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="alt_pagination" class="table table-striped table-bordered display" style="width:100%">
                                    <tbody>
                                    <?php
                                    $qinfo = mysqli_query($konek, "SELECT * FROM informasi ORDER BY id DESC");
                                    while ($rinfo = mysqli_fetch_assoc($qinfo)) :
                                    ?>
                                    <tr>
                                        <td>
                                            <i class="mdi mdi-calendar"></i><?= $rinfo['tanggal']; ?><br>
                                            <h5><?= $rinfo['tipe']; ?></h5>
                                            <?= $rinfo['isi']; ?>
                                        </td>
                                        <td align="center">
                                            <a href="?id=<?= $rinfo['id']; ?>"><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php if (mysqli_num_rows($qinfo) === 0): ?>
                                    <tr>
                                        <td colspan="4" align="center">Tidak ada informasi</td>
                                    </tr>
                                    <?php endif ?>
                                    </tbody>
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
    <!-- This Page JS -->
    <script src="../../assets/libs/tinymce/tinymce.min.js"></script>
    <script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>
</body>

</html>