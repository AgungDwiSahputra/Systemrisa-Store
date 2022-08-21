<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aktivasi Email - SYSTEMRISA STORE</title>
  <meta name="author" content="https://r-i-s-a.com">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" align="center">
  <br>
    <?php
         require "../include/function.php";
         $token=$_GET['t'];
         $sql_cek=mysqli_query($konek,"SELECT * FROM user WHERE token='$token' AND status='Off'");
         $jml_data=mysqli_num_rows($sql_cek);
         if ($jml_data>0) {
             //update data users status aktif
             $aktif = mysqli_query($konek,"UPDATE user SET status='On' WHERE token='$token' AND status='Off'");
			 if($aktif){
             	echo '<div class="alert alert-success">Akun Kamu telah terverifikasi, silahkan <a href="../login/">Login</a></div>';
			 }
         }else{
                    //data tidak di temukan
                     echo '<div class="alert alert-warning">
                        Token tidak di temukan!!!
                        </div>';
                   }
    ?>
</div>
</body>
</html>