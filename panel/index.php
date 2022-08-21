<?php
session_start();
require 'include/function.php';

if (!isset($_SESSION['username'])) {
    header('location:login');
    exit();
}

$username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
$dataUser = mysqli_fetch_assoc($queryUser);

function tgl_grafik($ke) {
    $tgl = date('d M Y', time()-60*60*24*$ke);
    return $tgl;
}

function g_grafik($tgl) {
    global $konek;
    global $username;

    $q = mysqli_query($konek, "SELECT * FROM riwayat WHERE username = '$username' AND tanggal = '$tgl'");
    return mysqli_num_rows($q);

}

function depo_grafik($tgl) {
    global $konek;
    global $username;
  
    $q = mysqli_query($konek, "SELECT * FROM deposit WHERE username = '$username' AND tanggal = '$tgl'");
    return mysqli_num_rows($q);
  
  }
  
//===================================================

$qo = mysqli_query($konek, "SELECT * FROM riwayat WHERE username = '$username'");
$totalo = 0;
while ($fo = mysqli_fetch_assoc($qo)) {
  $totalo += $fo['harga'];
}

$qu = mysqli_query($konek, "SELECT * FROM deposit WHERE username = '$username'");
$total_depo = 0;
while ($depo = mysqli_fetch_assoc($qu)) {
  $total_depo += $depo['saldo_didapat'];
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="<?= $description ?>">
    <meta name="keywords"
        content="<?= $keywords ?>">
    <meta name="author" content="<?= $author ?>">
    <meta name="generator" content="Systemrisa <?= $versi ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?= $web_service['nama']; ?> - Dashboard Panel</title>
    <!-- Custom CSS -->
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
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
    header("location:../maintenance/");
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
        
        <?php require 'property/nav.php'; ?>

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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $link_awal ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div class="col-lg-6">
                                    <i class="far fa-chart-bar m-r-5 display-7 float-left"></i><h4 class="card-title">Grafik Pembelian</h4>
                                        <h5 class="card-subtitle">terlihat dalam 1 Minggu</h5>
                                    </div>
                                    <div class="offset-4 col-lg-2">
                                        <ul class="list-inline font-12 dl m-r-15 m-b-0 ">
                                            <li class="list-inline-item text-info"><i class="fa fa-circle"></i> Pembelian</li>
                                            <li class="list-inline-item text-purple"><i class="fa fa-circle"></i> Deposit</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-lg-12">
                                        <div class="campaign ct-charts"></div>
                                    </div>
                                    <!-- column -->
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- Info Box -->
                            <!-- ============================================================== -->
                            <div class="card-body border-top">
                                <div class="row m-b-0">
                                    <!-- col -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-info display-5"><i class="mdi mdi-wallet"></i></span></div>
                                            <div><span>Sisa Saldo</span>
                                                <h3 class="font-medium m-b-0">Rp. <?= number_format($dataUser['saldo'],0,',','.'); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-danger display-5"><i class="mdi mdi-wallet"></i></span></div>
                                            <div><span>Saldo Terpakai</span>
                                                <h3 class="font-medium m-b-0">Rp. <?= number_format($dataUser['saldo_terpakai'],0,',','.'); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-success display-5"><i class="mdi mdi-shopping"></i></span></div>
                                            <div><span>Jumlah Pembelian</span>
                                                <h3 class="font-medium m-b-0"><?= number_format(mysqli_num_rows($qo),0,',','.'); ?> (Rp. <?= number_format($totalo,0,',','.'); ?>)</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-credit-card-plus"></i></span></div>
                                            <div><span>Jumlah Deposit</span>
                                                <h3 class="font-medium m-b-0"><?= number_format(mysqli_num_rows($qu),0,',','.'); ?> (Rp. <?= number_format($total_depo,0,',','.'); ?>)</h3></div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div class="col-lg-12">
                                    <i class="fas fa-bullhorn p-2 m-r-5 display-7 float-left"></i><h4 class="card-title">Informasi dan Berita</h4>
                                        <h5 class="card-subtitle">Berita terbaru saat ini</h5>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
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
                <!-- Table -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container Fluid -->
            <!-- ============================================================== -->

            <?php require 'property/footer.php';?>


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
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/app.init.overlay.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 charts -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <!--chartjs -->
    <script src="assets/libs/chart.js/dist/Chart.min.js"></script>

    <script>
    $(function () {
    "use strict";
    // ============================================================== 
    // Newsletter
    // ============================================================== 

    var chart = new Chartist.Line('.campaign', {
        labels: [
            <?php for($i=1; $i<=7; $i++) : ?>
            "<?= tgl_grafik(7-$i); ?>",
            <?php endfor; ?>
        ],
        series: [
            [
                <?php for($i=1; $i<=7; $i++) : ?>
                "<?= g_grafik(tgl_grafik(7-$i)); ?>",
                <?php endfor; ?>
            ],
            [
                <?php for($i=1; $i<=7; $i++) : ?>
                "<?= depo_grafik(tgl_grafik(7-$i)); ?>",
                <?php endfor; ?>
            ]
        ]
    }, {
        low: 0,

        showArea: true,
        fullWidth: true,
        plugins: [
            Chartist.plugins.tooltip()
        ],
        axisY: {
            onlyInteger: true,
            scaleMinSpace: 20,
            offset: 20,
            labelInterpolationFnc: function (value) {
                return (value / 1);
            }
        },

    });

    // Offset x1 a tiny amount so that the straight stroke gets a bounding box
    // Straight lines don't get a bounding box 
    // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
    chart.on('draw', function (ctx) {
        if (ctx.type === 'area') {
            ctx.element.attr({
                x1: ctx.x1 + 0.001
            });
        }
    });

    // Create the gradient definition on created event (always after chart re-render)
    chart.on('created', function (ctx) {
        var defs = ctx.svg.elem('defs');
        defs.elem('linearGradient', {
            id: 'gradient',
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
        }).elem('stop', {
            offset: 0,
            'stop-color': 'rgba(255, 255, 255, 1)'
        }).parent().elem('stop', {
            offset: 1,
            'stop-color': 'rgba(64, 196, 255, 1)'
        });
    });


    var chart = [chart];

    // ============================================================== 
    // Our Visitor
    // ============================================================== 

    var chart = c3.generate({
        bindto: '#visitor',
        data: {
            columns: [
                ['Open', 45],
                ['Clicked', 15],
                ['Un-opened', 27],
                ['Bounced', 18],
            ],

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: "Ratio",
            width: 35,

        },

        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']

        },
        color: {
            pattern: ['#40c4ff', '#2961ff', '#ff821c', '#7e74fb']
        }
    });
    // ============================================================== 
    // Our Visitor
    // ============================================================== 
    var sparklineLogin = function () {
        $('#ravenue').sparkline([6, 10, 9, 11, 9, 10, 12], {
            type: 'bar',
            height: '100',
            barWidth: '4',
            width: '100%',
            resize: true,
            barSpacing: '11',
            barColor: '#fff'
        });
        $('#views').sparkline([6, 10, 9, 11, 9, 10, 12], {
            type: 'line',
            height: '72',
            lineColor: 'transparent',
            fillColor: 'rgba(255, 255, 255, 0.3)',
            width: '100%',

            resize: true,

        });
    };
    var sparkResize;

    $(window).resize(function (e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 500);
    });
    sparklineLogin();

    // ============================================================== 
    // Bounce rate
    // ============================================================== 
    var ctx = document.getElementById("bouncerate");
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2012", "2013", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: 'Bounce %',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'transparent'
                ],
                borderColor: [
                    '#2961ff'

                ],
                borderWidth: 3
            }]
        },
        options: {
            elements: { point: { radius: 2 } },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        display: false
                    }
                }]
            },
            legend: {
                display: false,
                labels: {
                    fontColor: 'rgb(255, 99, 132)'
                }
            }
        }
    });

    // This is for the chat messege on enter
    $(function () {
        $(document).on('keypress', "#textarea1", function (e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("data-user-id");
                var msg = $(this).val();
                msg = msg_sent(msg);
                $("#someDiv").append(msg);
                $(this).val("");
                $(this).focus();
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