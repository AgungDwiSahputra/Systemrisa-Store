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
  
    $category = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['category'])));
    $service = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['service'])));
    $target = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['target'])));
    $jumlah = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['quantity'])));

    if (empty($category) OR empty($service) OR empty($target) OR empty($jumlah)) {
        alert('gagal', 'Masih ada data yang kosong', 'pembelian');
    } else {
        $queryService = mysqli_query($konek, "SELECT * FROM service WHERE id = '$service' AND category = '$category'");
        if (mysqli_num_rows($queryService) === 1 ) {
            $fetchService = mysqli_fetch_assoc($queryService);

            if ($jumlah < $fetchService['min']) {
                alert('gagal', 'Jumlah minimum tidak sesuai', 'pembelian');
            } else if ($jumlah > $fetchService['max']) {
                alert('gagal', 'Jumlah maksimal tidak sesuai', 'pembelian');
            } else {
                $totalBayar = ($fetchService['harga'] / 1000) * $jumlah;

                if ($dataUser['saldo'] < $totalBayar) {
                    alert('gagal', 'Saldo tidak mencukupi silahkan deposit', 'pembelian');
                } else {


                    //Proses Pembelian
                    $awal_saldo = $dataUser['saldo'];
                    $saldo_jadi = $dataUser['saldo'] - $totalBayar;

                    // Api Pembelian
                    // Membuat pesanan
                    $order = $api->buy_sosmed(array(
                        'service' => $fetchService['provider_id'], // id layanan
                        'data' => $target,
                        'quantity' => $jumlah
                    ));
                    

                    if ($order['status'] == 'true') {
                        $trx = $order['data']['id'];
                        $serviceName = $fetchService['service'];
                        

                        mysqli_query($konek, "INSERT INTO riwayat (username, service, jumlah, harga, start_count, remains, order_id, status, target, tanggal, waktu) VALUES ('$username','$serviceName','$jumlah','$totalBayar','0','$jumlah','$trx','Pending','$target','$tanggal','$waktu')");
                        mysqli_query($konek, "UPDATE user SET saldo = saldo-$totalBayar WHERE username = '$username'");
                        mysqli_query($konek, "UPDATE user SET saldo_terpakai = saldo_terpakai+$totalBayar WHERE username = '$username'");
                        mysqli_query($konek, "INSERT INTO saldo (username, aksi, saldo_aktifity, tanggal, efek, saldo_awal, saldo_jadi) VALUES ('$username','Melakukan pembelian dengan ID : $trx','$totalBayar','$tanggal $waktu', '- Saldo','$awal_saldo','$saldo_jadi')");

                        alert('berhasil', 'Pembelian berhasil di antrikan dengan ID : ' . $trx, 'pembelian');;

                    } else {
                        alert('gagal', 'Gagal : ' . $order['data']['msg'], 'pembelian');
                    }

                }
            }

        } else {
            alert('gagal', 'Layanan tidak di temukan', 'pembelian');
        }
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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Pembelian Baru</title>
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
                        <h4 class="page-title">Pembelian Baru</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
                                    <li class="breadcrumb-item active" aria-current="page">Pembelian Baru</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-6 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                <div><span class="text-info display-5"><i class="mdi mdi-wallet"></i></span></div>
                            </div>
                            <div class=""><h5>Sisa Saldo</h5>
                                <h4 class="text-info m-b-0 font-medium"> Rp. <?= number_format($dataUser['saldo'],0,',','.'); ?></h4></div>
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
                    <div class="col-md-7 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-info">
                                <div class="col-lg-12 m-t-10">
                                <i class="mdi mdi-cart-plus m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Pembelian Baru</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Pilih sesuai kebutuhan Kamu</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
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
                                    <label class="control-label">Kategori</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="0">Pilih salah satu</option>
                                        <?php 
                                        $queryKat = mysqli_query($konek, "SELECT DISTINCT category FROM service ORDER BY category ASC");
                                        while ($rowKat = mysqli_fetch_assoc($queryKat)) :
                                        ?>
                                        <option value="<?= $rowKat['category']; ?>"><?= $rowKat['category']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Layanan</label>
                                    <select name="service" id="service" class="form-control">
                                        <option value="0">Pilih Kategori</option>
                                    </select>
                                </div>

                                <div id="note"></div>

                                <div class="form-group">
                                    <label class="control-label">Target Username / Link</label>
                                    <input type="text" id="target" class="form-control" name="target" autocomplete="off" required="required" placeholder="Masukan link/username">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Jumlah</label>
                                        <input type="hidden" class="form-control" id="rate">
                                        <input type="number" class="form-control" min=1 name="quantity" id="quantity" onkeyup="getcut(this.value).value;" required>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                            </div>
                                            <input type="text" class="form-control" disabled="disabled" readonly="readonly" id="cutbalance">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-danger" type="reset">Reset</button>
                                    <button class="btn btn-info" type="submit" name="tombol">Beli Sekarang</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="card card-hover">
                            <div class="card-header bg-orange">
                                <div class="col-lg-12 m-t-10">
                                    <i class="mdi mdi-book-open-page-variant m-r-5 display-7 float-left text-white"></i><h4 class="m-b-0 text-white">Petunjuk Pembelian</h4>
                                    <h5 class="card-subtitle text-white-50 mt-1">Wajib dibaca</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-center font-bold"><span>WAJIB BACA !!!</span></p>
                                <ol>
                                <li style="text-align: justify;">Pastikan Anda memenginput link/username yang benar sesuai yang ada di&nbsp;<span style="background-color: rgb(255, 255, 0);"><span style="font-weight: 700;">keterangan</span></span> dan Pastikan Link/Username<b>(tidak private, tidak salah input, atau semacamnya)</b>, karena kami tidak bisa membatalkan pesanan.</li>
                                <li style="text-align: justify;"><span style="font-weight: 700; background-color: rgb(255, 255, 0);">Jangan</span>&nbsp;menggunakan lebih dari satu layanan sekaligus untuk username/link yang sama. Harap tunggu status&nbsp;<span style="background-color: rgb(57, 123, 33);"><font color="#ffffff">completed</font></span>&nbsp;pada orderan sebelumnya baru melakukan orderan kepada username/ link yang sama. Hal ini&nbsp;<span style="background-color: rgb(255, 255, 0);"><span style="font-weight: 700;">tidak akan membantu mempercepat orderan</span></span>&nbsp;Anda karena kedua orderan bisa jadi berstatus completed tetapi hanya tercapai target dari salah satu orderan.</li>
                                <li style="text-align: justify;">Setelah order dimasukan, jika username/link yang diinput diganti pribadi atau diubah, orderan akan otomatis menjadi completed dan tidak ada pengembalian dana.</li>
                                <li style="text-align: justify;">Kesalahan member, bukan tanggung jawab admin, karena panel ini serba automatis, jadi hati-hati dan perhatiakan sebelum order!
                                <br>
                                </li>
                                <li style="text-align: justify;">Jika Orderan status&nbsp;<span style="background-color: rgb(231, 148, 57);"><font color="#ffffff">partial</font></span>&nbsp;&amp;&nbsp;<span style="background-color: rgb(206, 0, 0);"><font color="#ffffff">canceled</font></span>&nbsp;, saldo otomatis di refund dan bisa order ulang!</li>
                                <li style="text-align: justify; "><span style="background-color: rgb(156, 0, 255);"><font color="#ffffff">Jumlah maks</font></span>&nbsp;menunjukkan kapasitas layanan tersebut untuk satu target (akun/link) bukan menunjukkan kapasitas maks sekali order. Apabila Anda telah menggunakan semua kapasitas maks layanan,<span style="font-weight: 700;">&nbsp;Anda tidak bisa menggunakan layanan itu lagi</span>&nbsp;dan harus menggunakan layanan yang lain. Oleh karenannya kami menyediakan banyak layanan dengan kapasitas maks yang lebih besar.</li>
                                <li style="text-align: justify; ">Informasi yang terdapat pada kolom keterangan (speed, bersifat estimasi dan informasi untuk membedakan layanan yang satu dan lainnya. Informasi bisa jadi tidak akurat tergantung dari performa server dan jumlah orderan yang masuk pada server tersebut. Anda dapat report setelah 24 jam orderan disubmit.</li>
                                <li style="text-align: justify; ">Dengan melakukan orderan Anda dianggap sudah memahami <a href="https://r-i-s-a.my.id/panel/syarat-ketentuan/" target="_blank">Syarat dan Ketentuan</a>&nbsp;SYSTEMRISA STORE.</li>
                                </ol>
                                <p><small><strong>*Tidak ada pengembalian saldo apabila anda melanggar peraturan di atas!</strong></small></p>

                                <b>KETERANGAN PADA LAYANAN :</b>
                                <p>Layanan yang ditulis dalam format:<br />SERVICE NAME [MAXIMUM ORDER] [START TIME - SPEED]<br /> adalah Kecepatan pengiriman dimulai setelah waktu mulai.<br /> <br /> 🔥 = Layanan teratas.<br /> 💧 = Dripfeed aktif.<br /> ♻ = Mudah untuk Refill.<br /> 🛑 = Mudah untuk cancel<br /> <strong>Rxx</strong> = Periode isi ulang (xx merujuk pada waktu isi ulang, misalnya: R30 = Isi Ulang 30 Hari).<br /> <strong>ARxx</strong> = Periode Isi Ulang Otomatis (xx merujuk pada waktu isi ulang otomatis, misalnya: AR30 = Isi Ulang 30 Hari Otomatis).<br /> <br /> <br /> <strong>INSTANT</strong> pesanan mulai dapat memakan waktu hingga 1 jam untuk memulai. (1H waktu mulai pesanan biasanya membutuhkan beberapa menit untuk memulai).<br /> <strong>H</strong> seperti 1H, 12H, dll berarti Jam.<br /> <strong>HQ / LQ</strong> = Kualitas Tinggi / Kualitas Rendah.<br /> <strong>SPEED</strong> HINGGA xx / Hari, mis. Order 10K / Hari bisa 5K / Hari, kami menyatakan kecepatan maksimum, tolong jangan uraikan deskripsi untuk bantuan lebih lanjut.<br /> <br /> <br /> Layanan dalam kategori "Layanan Murah (Mungkin Menghadapi Beberapa Masalah)" dapat menghadapi beberapa masalah (Waktu mulai, Kecepatan, dan pengiriman dapat memakan waktu lebih lama daripada yang dinyatakan). Pesan dengan risiko Anda sendiri dari mereka.<br /> <br /> Layanan dalam kategori <strong>Top Best Seller</strong>, adalah layanan Berkualitas Tinggi dan sering dipesan oleh pengguna kami.</p>

                                <b>Langkah-langkah membuat pesanan baru :</b>
                                <ul>
                                <li>Pilih salah satu Kategori.</li>
                                <li>Pilih salah satu Layanan yang ingin dipesan.</li>
                                <li>Masukkan Target pesanan sesuai ketentuan yang diberikan layanan tersebut.</li>
                                <li>Masukkan Jumlah Pesanan yang diinginkan.</li>
                                <li>Klik Submit untuk membuat pesanan baru.</li>
                                </ul>
                                <b>CATATAN :</b>
                                <ul>
                                <li>Untuk pemesanan follower mohon untuk masukkan username saja di bagian kolom data/target.</li>
                                <li>Untuk pemesanan likes di mohon untuk masukkan link foto di bagian kolom data/target.</li>
                                <li>Patikan akun instagram tidak di private.</li>
                                <li>Apabila orderan tidak mengalami perubahasan status atau masih dalam status pending/proccess dalam 3x24 jam, dimohon untuk kontak admin.</li>
                                <li>Tidak ada pengembalian dana untuk kesalahan pengguna.</li>
                                </ul>
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

    <script type="text/javascript">
        var htmlobjek;
        function getcut(quantity){
            var rate = $("#rate").val();
            var hasil = eval(quantity) * rate / 1000;
            var balik = hasil.toFixed(0);

            var number_string = balik.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
            
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            $('#cutbalance').val(rupiah);
        } 

        $(document).ready(function(){
        
            $("#category").change(function(){
                var category = $("#category").val();
            
                $.ajax({
                    url : '../include/service_sosmed.php',
                    data    : 'category='+category,
                    type    : 'POST',
                    dataType: 'html',
                    success : function(msg){
                                $("#service").html(msg);
                        }
                });
            });
        
            $("#service").change(function(){
            var service = $("#service").val();
            
            $.ajax({
                url: '../include/note_sosmed.php',
                data: 'service=' + service,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#note").html(msg);
                }
            });

            $.ajax({
                url: '../include/rate_sosmed.php',
                data: 'service=' + service,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#rate").val(msg);
                }
            });
            });
        
        });
    </script>
</body>

</html>


<!-- ==================================================================== -->
<!-- MODE MAINTENANCE -->
<?php }?>
<!-- ==================================================================== -->