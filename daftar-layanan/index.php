<?php session_start();
require '../include/koneksi/koneksi.php';
require '../web_service/w_service.php';
?>
<!-- Masuk ke HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $web_service['nama']; ?> - SMM Panel Termurah No.1 di Indonesia</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =================TABEL CSS================= -->
  <!-- Fonts and icons -->
  <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Lato:300,400,700,900"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

</head>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php 
if ($maintenance['status'] == 'on') {
  require '../maintenance/index.php';
}else{
?>
<!-- ==================================================================== -->



<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto" class="logo mr-auto"><img src="../assets/img/apple-touch-icon.png" alt="" class="img-fluid"></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="../">Beranda</a></li>
          <li><a href="../#about">Tentang Kami</a></li>
          <li><a href="../#why-us">Cara Pesan</a></li>
          <li class="active"><a href="#hero">Daftar Layanan</a></li>
        </ul>
      </nav><!-- .nav-menu -->
      <?php 
      if (!isset($_SESSION['username'])) {
        echo '<a href="../panel/login" class="get-started-btn scrollto">Pesan Sekarang</a>';
      } else{
        echo '<a href="../panel/" class="get-started-btn scrollto"> Masuk ke Akun</a>';
      }
      ?>
    </div>
  </header><!-- End Header -->

  <main id="main" style="color: white !important;">

    <!-- ======= Services Section ======= -->
    <section id="hero" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title mt-4">
          <h2 style="color: white !important;">Daftar Layanan</h2>
            <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" cellpadding="50px" cellspacing="0" style="color: white !important;">
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>Layanan</th>
                          <th>Harga<br>(per 1k)</th>
                          <th>Min</th>
                          <th>Max</th>
                          <th>Kategori</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        $q = mysqli_query($konek, "SELECT * FROM service ORDER BY harga DESC");
                        while($r = mysqli_fetch_assoc($q)) :
                        ?>
                        <tr style="text-align: left !important;">
                          <td><?= $no; ?></td>
                          <td><?= $r['service']; ?></td>
                          
                          <td>Rp&nbsp;<?= number_format($r['harga'],0,',','.'); ?></td>
                          <td><?= number_format($r['min'],0,',','.'); ?></td>
                          <td><?= number_format($r['max'],0,',','.'); ?></td>
                          <td><?= $r['category']; ?></td>
                        </tr>
                      <?php $no++; endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-contact">
            <h3 class="logo mr-auto"class="logo mr-auto"><img src="../assets/img/apple-touch-icon.png" class="img-fluid" width="160px"></h3>
            <p>
              <?php echo $web_service['alamat']; ?><br><br>
              <strong>No. Whatsapp:</strong> <?php echo $web_service['no_telepon']; ?><br>
              <strong>Email:</strong> <?php echo $web_service['email']; ?><br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Bantusan Tautan</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="../">Beranda</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../#about">Tentang Kami</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../#why-us">Cara Pesan</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Sosisal Media</h4>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/systemrisa_store" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://instagram.com/systemrisa_store" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
            <br><br>
            <!-- JAM DIGITAL -->
            <style>
             
              .jam-digital {
                overflow: hidden;
                width: 220px;
                border: 5px solid #efefef;
              }
              .kotak{
                float: left;
                width: 70px;
                height: 60px;
                background: linear-gradient(blue, #00FFFF);
              }
              .jam-digital p {
                color: #fff;
                font-size: 30px;
                text-align: center;
                margin: 10px 0 auto;
              }
             
             
            </style>
             
            <h4>Jam Indonesia</h4>
            <div class="jam-digital">
              <div class="kotak">
                <p id="jam"></p>
              </div>
              <div class="kotak">
                <p id="menit"></p>
              </div>
              <div class="kotak">
                <p id="detik"></p>
              </div>
            </div>
             
            <script>
              window.setTimeout("waktu()", 1000);
             
              function waktu() {
                var waktu = new Date();
                setTimeout("waktu()", 1000);
                document.getElementById("jam").innerHTML = waktu.getHours();
                document.getElementById("menit").innerHTML = waktu.getMinutes();
                document.getElementById("detik").innerHTML = waktu.getSeconds();
              }
            </script>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $web_service['nama']; ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Dibuat Oleh <b>Agung Dwi Sahputra</b>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>


  <!-- JAVASCRIPT TABEL -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <!-- jQuery UI -->
  <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
  
  <!-- jQuery Scrollbar -->
  <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

  <script >
    $(document).ready(function() {
      $('#basic-datatables').DataTable({
      });

      $('#multi-filter-select').DataTable( {
        "pageLength": 5,
        initComplete: function () {
          this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value=""></option></select>')
            .appendTo( $(column.footer()).empty() )
            .on( 'change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
                );

              column
              .search( val ? '^'+val+'$' : '', true, false )
              .draw();
            } );

            column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
          } );
        }
      });

      // Add Row
      $('#add-row').DataTable({
        "pageLength": 5,
      });

      var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $('#addRowButton').click(function() {
        $('#add-row').dataTable().fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action
          ]);
        $('#addRowModal').modal('hide');

      });
    });
  </script>

</body>

</html>


<!-- ================================================== -->
<?php } ?>