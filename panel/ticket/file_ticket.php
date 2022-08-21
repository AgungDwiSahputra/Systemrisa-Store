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

if ($dataUser['level'] === "Member") {
  $qn = mysqli_query($konek, "SELECT * FROM id_ticket WHERE ticket_id = '$id_N' AND username = '$username'");
} else {
  $qn = mysqli_query($konek, "SELECT * FROM id_ticket WHERE ticket_id = '$id_N'");
}

$fn = mysqli_fetch_assoc($qn);

if (mysqli_num_rows($qn) === 0) {
  require '../../404.shtml';
  die();
}

if ($dataUser['level'] === "Admin") {
  if ($fn['status'] === "Unread-Admin") {
      mysqli_query($konek, "UPDATE id_ticket SET status = 'Read-Admin' WHERE ticket_id = '$id_N'");
  }
} else {
  if ($fn['status'] === "Unread-Member") {
      mysqli_query($konek, "UPDATE id_ticket SET status = 'Read-Member' WHERE ticket_id = '$id_N'");
  }
}

if (isset($_POST['pesan'])) {
$pesan = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['pesan'])));
if (!empty($pesan)) {
  mysqli_query($konek, "INSERT INTO pesan_ticket (username, ticket_id, pesan, tanggal) VALUES ('$username','$id_N','$pesan','$tanggal $waktu')");
  if ($dataUser['level'] === "Member") {
          mysqli_query($konek, "UPDATE id_ticket SET status = 'Unread-Admin' WHERE ticket_id = '$id_N'");
      } else {
          mysqli_query($konek, "UPDATE id_ticket SET status = 'Unread-Member' WHERE ticket_id = '$id_N'");
      }
  alert('berhasil', 'Pesan berhasil di kirimkan', $id_N);
}
}

function get_levelTicket($user) {
  global $konek;
  $q = mysqli_query($konek, "SELECT * FROM user WHERE username = '$user'");
  $f = mysqli_fetch_assoc($q);
  return $f['level'];
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
    <title>Tiket ID #<?= $id_N; ?></title>
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


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php 
if ($maintenance['status'] == 'on') {
    header("location:../../../maintenance/");
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
        
      <?php 
      if ($dataUser['level'] === "Admin"){ 
        require '../../property/nav_admin.php';
      } else{
        require '../../property/nav.php';
      }?>

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
                        <h4 class="page-title">Tiket</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                    <?php if ($dataUser['level'] === "Admin"){ ?>
                                      <a href="<?= $link ?>/admin">Dashboard Admin</a></li>
                                    <?php } else{?>
                                      <a href="<?= $link ?>">Dashboard</a></li>
                                    <?php }?>
                                    <li class="breadcrumb-item">
                                    <?php if ($dataUser['level'] === "Admin"){ ?>
                                      <a href="<?= $link ?>/admin/kelola-ticket/">Kelola Tiket</a>
                                    <?php } else{?>
                                      <a href="<?= $link ?>/ticket">Tiket</a>
                                    <?php }?>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $id_N; ?></li>
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
                <!-- ============================================================== -->
                <!-- Mail Compose -->
                <!-- ============================================================== -->
                <div class="p-20">
                    <div class="card card-hover">
                        <div class="card-header bg-info">
                            <div class="col-lg-12 m-t-10">
                            <i class="mdi mdi-email-open m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Tiket ID #<?= $id_N; ?></h4>
                                <h5 class="card-subtitle text-white-50 mt-1">Kirim tiket sesuai kendala yang dialami</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chat-box scrollable" style="height:calc(100vh - 300px);">
                                <!--chat Row -->
                                <ul class="chat-list">
                                <?php 
                                $qTicket = mysqli_query($konek, "SELECT * FROM pesan_ticket WHERE ticket_id = '$id_N' ORDER BY id ASC");
                                while($rTicket = mysqli_fetch_assoc($qTicket)) :
                                ?>
                                <?php if ($rTicket['username'] === $username): ?>
                                    <!--chat Row -->
                                    <li class="odd chat-item">
                                        <div class="chat-content">
                                            <div class="box bg-light-inverse"><?= $rTicket['pesan']; ?></div>
                                            <br>
                                        </div>
                                        <div class="chat-time"><?= lalu($rTicket['tanggal']); ?></div>
                                    </li>
                                    <!--chat Row -->
                                    <?php else : ?>
                                    <!--chat Row -->
                                    <li class="chat-item">
                                        <div class="chat-img"><img <?php if ($rTicket['username'] == 'admin') {echo 'src="../../assets/images/users/foto_ku.jpg"';} else {echo 'src="../../assets/images/users/1.jpg"';} ?> alt="user"></div>
                                        <div class="chat-content">
                                            <h6 class="font-medium"><?= $rTicket['username']; ?></h6>
                                            <div class="box bg-light-info"><?= $rTicket['pesan']; ?></div>
                                        </div>
                                        <div class="chat-time"><?= lalu($rTicket['tanggal']); ?></div>
                                    </li>
                                    <!--chat Row -->
                                <?php endif ?>
                                <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body border-top">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-9">
                                    <div class="input-field m-t-0 m-b-0">
                                        <input id="textarea1" placeholder="Ketik Pesan..." class="form-control border-0" type="text" name="pesan" autocomplete="off" autofocus="autofocus">
                                    </div>
                                </div>
                                <div class="col-3">
                                  <button class="btn-circle btn-lg btn-cyan float-right text-white" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                  </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


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
            <h5 class="modal-title">
              Buat Tiket
            </h5>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
              <!-- Alert with content -->
              <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                  <h4 class="text-info"><i class="mdi mdi-alert-circle"></i> Penting!!</h4> Hello <?= $_SESSION['username']?>, Isi Subjek Dengan Judul Masalah. Misal Ingin Complain Masalah Orderan Maka Isi Dengan Kata Kata "<b>Komplain</b>", Jika Ingin Submit Refill Silahkan Isi subjek dengan kata kata "<b>Refill</b>" . Kemudian di kolom Pesan isikan masalah anda dan sertakan order id nya.
Terimakasih.
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Judul Ticket" name="judul_ticket" autocomplete="off">
              </div>
              <div class="form-group">
                <textarea name="isi_ticket" style="height: 100px;" id="isi_ticket" cols="30" rows="10" placeholder="Isi Ticket" class="form-control"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
              <button type="submit" name="tombol" class="btn btn-info">Kirim</button>
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
                                      
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->