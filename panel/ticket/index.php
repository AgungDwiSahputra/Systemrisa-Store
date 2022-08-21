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
  $isi_ticket = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['isi_ticket']))));
  $judul_ticket = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['judul_ticket']))));

  if (empty($isi_ticket) OR empty($judul_ticket)) {
      alert('gagal', 'Data ticket tidak boleh ada yang kosong', 'ticket');
  } else {
      if (strlen($judul_ticket) > 100) {
          alert('gagal', 'Judul ticket terlalu panjang', 'ticket');
      } else if (strlen($isi_ticket) > 250) {
          alert('gagal', 'Pesan ticket terlalu panjang', 'ticket');
      } else {
          $TicketNya = rand(000000,999999);
          mysqli_query($konek, "INSERT INTO id_ticket (username, ticket_id, judul, status, tanggal) VALUES ('$username','$TicketNya','$judul_ticket','Unread-Admin','$tanggal $waktu')");
          mysqli_query($konek, "INSERT INTO pesan_ticket (username, ticket_id, pesan, tanggal) VALUES ('$username','$TicketNya','$isi_ticket','$tanggal $waktu')");
          mkdir($TicketNya);
          $handle = fopen($TicketNya . "/index.php", "w");
$isi = '<?php
$id_N = "'.$TicketNya.'";
require "../file_ticket.php";
?>';
          fwrite($handle, $isi);
          alert('berhasil', 'Ticket berhasil di buat dengan ID : ' . $TicketNya, 'ticket/' . $TicketNya);
      }
  }

}

/* Menghitung Semua Data yang ada di Database Tiket */
$data =array();
$query = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username'");
while(($row = mysqli_fetch_array($query)) != null){
    $data[] = $row;
}
$j_tiket = count($data);

/* Menghitung Semua Data yang ada di Database Tiket */
$data1 =array();
$query1 = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' AND status = 'Unread-Admin'");
while(($row1 = mysqli_fetch_array($query1)) != null){
    $data1[] = $row1;
}
$j_tiket_unR_admin = count($data1);

/* Menghitung Semua Data yang ada di Database Tiket */
$data2 =array();
$query2 = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' AND status = 'Unread-Member'");
while(($row2 = mysqli_fetch_array($query2)) != null){
    $data2[] = $row2;
}
$j_tiket_unR_member = count($data2);

/* Menghitung Semua Data yang ada di Database Tiket */
$data3 =array();
$query3 = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' AND status = 'Read-Admin'");
while(($row3 = mysqli_fetch_array($query3)) != null){
    $data3[] = $row3;
}
$j_tiket_R_admin = count($data3);

/* Menghitung Semua Data yang ada di Database Tiket */
$data4 =array();
$query4 = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' AND status = 'Read-Member'");
while(($row4 = mysqli_fetch_array($query4)) != null){
    $data4[] = $row4;
}
$j_tiket_R_member = count($data4);
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
    <title>Tiket</title>
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
                        <h4 class="page-title">Tiket</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tiket</li>
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
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Column -->
                                    <div class="col-md-12 col-lg-12 col-xlg-12">
                                        <div class="card card-hover">
                                            <div class="box bg-info text-center">
                                                <h1 class="font-light text-white"><?= $j_tiket ?></h1>
                                                <h6 class="text-white">Total Tiket</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-12 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-danger text-center">
                                                <h1 class="font-light text-white"><?= $j_tiket_unR_admin ?></h1>
                                                <h6 class="text-white">Menunggu Balasan</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-12 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <h1 class="font-light text-white"><?= $j_tiket_unR_member ?></h1>
                                                <h6 class="text-white">Belum Dilihat</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-12 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-megna text-center">
                                                <h1 class="font-light text-white"><?= $j_tiket_R_member ?></h1>
                                                <h6 class="text-white">Sudah Dilihat</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-12 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <h1 class="font-light text-white"><?= $j_tiket_R_admin ?></h1>
                                                <h6 class="text-white">Sudah Dilihat Admin</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="buat();" class="btn btn-rounded btn-block btn-info"><i class="fa fa-plus text-default"></i> Buat Tiket</button>
                                <br>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th hidden>No</th>
                                                <th width="50">Status</th>
                                                <th width="500">Judul</th>
                                                <th>Tiket ID</th>
                                                <th width="300">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $qTicket = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' ORDER BY id DESC");
                                            while($rTicket = mysqli_fetch_assoc($qTicket)) :
                                            ?>
                                            <tr>
                                                <td hidden><?= $no?></td>
                                                <td>
                                                  <?php 
                                                  if ($rTicket['status'] == "Unread-Admin") {
                                                      echo '<span class="label label-danger">Menunggu</span>';
                                                  } else if ($rTicket['status'] == "Unread-Member") {
                                                      echo '<span class="label label-warning">Menunggu</span>';
                                                  } else if ($rTicket['status'] == "Read-Member") {
                                                      echo '<span class="label label-megna">Dilihat</span>';
                                                  } else if ($rTicket['status'] == "Read-Admin") {
                                                      echo '<span class="label label-success">Dilihat</span>';
                                                  } else {
                                                      echo $rTicket['status'];
                                                  }
                                                  ?>
                                                </td>
                                                <td><a href="<?= $rTicket['ticket_id']; ?>" class="font-medium link"><?= $rTicket['judul']; ?></a></td>
                                                <td><a href="<?= $rTicket['ticket_id']; ?>" class="font-bold link"><?= $rTicket['ticket_id']; ?></a></td>
                                                <td><?= $rTicket['tanggal']; ?></td>
                                            </tr>
                                            <?php $no++; endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th hidden>No</th>
                                                <th width="50">Status</th>
                                                <th width="500">Judul</th>
                                                <th>Tiket ID</th>
                                                <th width="300">Tanggal</th>
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
    function buat() {
      $("#myModal").modal('show');
    }
    </script>
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->