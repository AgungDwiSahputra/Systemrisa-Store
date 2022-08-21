<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php require '../panel/include/function.php';
//------------------------------------------------------------
//MAINTENANCE
$query4 = mysqli_query($konek, "SELECT * FROM maintenance");
$maintenance = mysqli_fetch_assoc($query4);
//------------------------------------------------------------
if ($maintenance['status'] == 'on') {
?>

<!DOCTYPE html>
<html dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../panel/assets/images/favicon.png" />
  <title>Maintenance Page</title>
  <!-- Custom CSS -->
  <link href="../panel/dist/css/style.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div class="main-wrapper">
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
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="error-box">
      <div class="error-body text-center">
        <img src="../panel/assets/images/favicon.png" width="100px" />
        <h4 class="text-dark font-24">SYSTEMRISA STORE</h4>
        <div class="m-t-30">
			<hr width="500px">
          <h3>Server sedang Maintenance</h3>
			<hr width="500px">
          <h5 class="m-b-0 text-muted font-medium">
            Teknisi sedang Memperbaiki Website.
          </h5>
          <h5 class="text-muted font-medium">
            Tolong check kembali setelah beberapa menit.
          </h5>
        </div>
        <div class="m-t-30"><i class="ti-settings font-24"></i></div>
        <div class="m-t-30">
          <a href="https://api.whatsapp.com/send?phone=+6282110860615&text=Assalamu'alaikum...">
            <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i
                  class="fas fa-phone"></i>&nbsp;&nbsp;</span>Pesan WhatsApp</button>
          </a>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- All Required js -->
  <!-- ============================================================== -->
  <script src="../panel/assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../panel/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../panel/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- ============================================================== -->
  <!-- This page plugin js -->
  <!-- ============================================================== -->
  <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
  </script>
</body>

</html>


<?php
}else {
  header("location:../panel/");
}
?>