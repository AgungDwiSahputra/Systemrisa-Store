<?php session_start();
require 'panel/include/function.php';
?>
<!-- Masuk ke HTML -->

<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>SYSTEMRISA STORE - SMM Panel Termurah No.1 di Indonesia</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="description"
        content="<?= $description ?>">
    <meta name="keywords"
        content="<?= $keywords ?>">
    <meta name="author" content="<?= $author ?>">
    <meta name="generator" content="Systemrisa <?= $versi ?>">
    <link rel=stylesheet href="panel/assets/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel=stylesheet href="assets/css/agico-hugo/slick.css">
    <link rel=stylesheet href="panel/dist/css/icons/font-awesome/css/fontawesome-all.min.css">
    <link rel=stylesheet href="panel/dist/css/icons/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel=stylesheet href="assets/css/agico-hugo/venobox.css">
    <link rel=stylesheet href="assets/css/agico-hugo/aos.css">
    <link rel=stylesheet href="assets/css/agico-hugo/style.min.css" media="screen">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" alt="SYSTEMRISA STORE - SMM Panel Termurah No.1 di Indonesia">
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon" alt="SYSTEMRISA STORE - SMM Panel Termurah No.1 di Indonesia">
</head>

<body>
    <div class="preloader">
        <img src="assets/img/preloader.gif" width="50px" alt="preloader"></div>
    <div class="naviagtion fixed-top transition" data-aos="fade-down">
        <div class="container">
            <nav class="navbar nav-menu navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand p-0 page-scroll" href="#home">
                    <img class="img-fluid" src="assets/img/favicon.png" width="60px"
                        alt="SYSTEMRISA STORE - SMM Panel Termurah No.1 di Indonesia"><b
                        class="text-white ml-2">SYSTEMRISA STORE</b>
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation" aria-expanded=false aria-label="Toggle navigation">
                    <i class="fa fa-bars text-white h3 mb-0"></i></button>
                <div class="collapse navbar-collapse text-center" id="navigation">
                    <ul class="navbar-nav mx-auto">
                        <li hidden class="nav-item active"><a class="nav-link text-white text-capitalize page-scroll active"
                                href="#">Beranda
                            </a> </li>
                        <li class="nav-item"><a class="nav-link text-white text-capitalize page-scroll active"
                                href="#about">Tentang Kami
                            </a> </li>
                        <li class="nav-item"><a class="nav-link text-white text-capitalize page-scroll"
                                href="#fitur">Fitur - Fitur</a> </li>
                        <li class="nav-item"><a class="nav-link text-white text-capitalize page-scroll" href="#tips">Tips
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white text-capitalize page-scroll"
                                href="#testi">Testimonial </a> </li>
                        <li class="nav-item"><a class="nav-link text-white text-capitalize page-scroll"
                                href="#services">Service </a> </li>
                        <li hidden class="nav-item dropdown"><a class="nav-link text-white text-capitalize dropdown-toggle"
                                href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Pages</a>
                            <div class="dropdown-menu"><a class="dropdown-item text-color"
                                    href="/agico-hugo/career">Career </a> <a class="dropdown-item text-color"
                                    href="/agico-hugo/pricing">Pricing
                                </a> <a class="dropdown-item text-color" href="/agico-hugo/team">Team
                                </a> </div>
                        </li>
                    </ul>
                    <?php 
                    if (!isset($_SESSION['username'])) {
                        echo '<a href="panel/login/" class="btn btn-outline-primary text-white ml-lg-3">Masuk</a>';
                    } else{
                        echo '<a href="panel/" class="btn btn-outline-primary text-white ml-lg-3">Dashboard</a>';
                    }
                    ?>
                </div>
            </nav>
        </div>
    </div>
    <section id="home" class="hero-area bg-cover" data-background="assets/img/bg-header.png">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 pl-lg-0 text-center text-lg-left">
                    <h1 class="text-white position-relative" data-aos="fade-up" data-aos-delay="100">SYSTEMRISA STORE
                        <span class="watermark">RISA</span></h1>
                    <h4 class="text-white pt-2 pb-3" data-aos="fade-up" data-aos-delay="300">SMM Panel Termurah No.1 di
                        Indonesia</h4>
                        <?php 
                        if (!isset($_SESSION['username'])) {
                            echo '<a href="panel/register/" class="btn btn-primary" data-aos="fade-up"
                            data-aos-delay="500">Daftar Sekarang</a>';
                        } else{
                            echo '<a href="panel/" class="btn btn-primary" data-aos="fade-up"
                            data-aos-delay="500">Panel Dashboard</a>';
                        }
                        ?>
                </div>
                <div class="col-lg-5 my-md-auto mr-lg-5 mt-5 text-lg-right text-center"><img src="assets/img/logo_header.png"
                        class="img-fluid" alt="illustration" data-aos="zoom-in" data-aos-delay="700"></div>
            </div>
        </div>
    </section>
    <section>
        <div class=container>
            <div class=row>
                <div class="col-lg-2 col-md-4 col-6 d-flex justify-content-center">
                    <ul
                        class="list-inline d-flex justify-content-between py-3 py-lg-5 border-bottom align-items-center">
                        <li class=list-inline-item><img width="150px" class="img-fluid p-2"
                                src="assets/img/clients/client-1.png" alt="Partner Systemrisa Store" data-aos="fade-down" data-aos-delay="100">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex justify-content-center">
                    <ul
                        class="list-inline d-flex justify-content-between py-3 py-lg-5 border-bottom align-items-center">
                        <li class=list-inline-item><img width="150px" class="img-fluid p-2"
                                src="assets/img/clients/client-2.png" alt="Partner Systemrisa Store" data-aos="fade-down" data-aos-delay="200">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex justify-content-center">
                    <ul
                        class="list-inline d-flex justify-content-between py-3 py-lg-5 border-bottom align-items-center">
                        <li class=list-inline-item><img width="150px" class="img-fluid p-2"
                                src="assets/img/clients/client-3.png" alt="Partner Systemrisa Store" data-aos="fade-down" data-aos-delay="300">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex justify-content-center">
                    <ul
                        class="list-inline d-flex justify-content-between py-3 py-lg-5 border-bottom align-items-center">
                        <li class=list-inline-item><img width="150px" class="img-fluid p-2"
                                src="assets/img/clients/client-4.png" alt="Partner Systemrisa Store" data-aos="fade-down" data-aos-delay="400">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex justify-content-center">
                    <ul
                        class="list-inline d-flex justify-content-between py-3 py-lg-5 border-bottom align-items-center">
                        <li class=list-inline-item><img width="150px" class="img-fluid p-2"
                                src="assets/img/clients/client-5.png" alt="Partner Systemrisa Store" data-aos="fade-down" data-aos-delay="500">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex justify-content-center">
                    <ul
                        class="list-inline d-flex justify-content-between py-3 py-lg-5 border-bottom align-items-center">
                        <li class=list-inline-item><img width="150px" class="img-fluid p-2"
                                src="assets/img/clients/client-6.png" alt="Partner Systemrisa Store" data-aos="fade-down" data-aos-delay="600">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7 text-center text-md-left order-md-1 order-2">
                    <p class="subtitle" data-aos="fade-right">Tentang Kami</p>
                    <h2 class="section-title" data-aos="fade-right" data-aos-delay="200">SYSTEMRISA STORE</h2>
                    <p class="mb-4" data-aos="fade-right" data-aos-delay="300">
                        <b>SYSTEMRISA STORE - ADALAH</b> sebuah platform
                        SMM Panel Termurah dan Terbaik di Indonesia yang menyediakan berbagai Layanan Social Media yang
                        bergerak terutama di Indonesia. Kamu dapat menambah Followers, Likes, Views, Subscriber, Jam
                        Tayang, dll untuk
                        beragam Social Media: Instagram, Youtube, Facebook, Twitter, dll dengan harga Termurah.</p>
                        <?php 
                        if (!isset($_SESSION['username'])) {
                            echo '<a href="panel/register/" class="btn btn-primary" data-aos="fade-right"
                            data-aos-delay="400">Daftar Sekarang</a>';
                        } else{
                            echo '<a href="panel/" class="btn btn-primary" data-aos="fade-right"
                            data-aos-delay="400">Panel Dashboard</a>';
                        }
                        ?>
                </div>
                <div class="col-lg-6 col-md-5 text-center text-md-left order-1 order-md-2 mb-4 mb-md-0"><img
                        src="assets/img/Systemrisa.png" class="img-fluid" alt="about-image" data-aos="fade-left"></div>
            </div>
        </div>
    </section>
    <section class="bg-triangles bg-gradient-primary p-4" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4 mb-md-0 text-center">
                    <p class="h2 text-white"><span class="counter" data-count="<?= $j_riwayat+550 ?>">0</span>+</p>
                    <h6 class="text-white font-weight-normal">Total Pesanan</h6>
                </div>
                <div class="col-md-3 col-sm-6 mb-4 mb-md-0 text-center">
                    <?php
                        $tgl1 = new DateTime("2020-06-23");
                        $tgl2 = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                        $hari = $tgl2->diff($tgl1)->days;
                    ?>
                    <p class="h2 text-white"><span class="counter"
                            data-count="<?= $hari; ?>">0</span> Hari
                    </p>
                    <h6 class="text-white font-weight-normal">Website Aktif</h6>
                </div>
                <div class="col-md-3 col-sm-6 mb-4 mb-md-0 text-center">
                    <p class="h2 text-white"><span class="counter" data-count="<?= $j_service; ?>">0</span>+</p>
                    <h6 class="text-white font-weight-normal">Total Layanan</h6>
                </div>
                <div class="col-md-3 col-sm-6 mb-4 mb-md-0 text-center">
                    <p class="h2 text-white"><span class="counter" data-count="<?= $j_user+20 ?>">0</span></p>
                    <h6 class="text-white font-weight-normal">Total User</h6>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="fitur">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="subtitle" data-aos="fade-up">Fitur - Fitur</p>
                    <h2 class="section-title" data-aos="fade-up" data-aos-delay="200">Fitur Panel Systemrisa Store</h2>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay=0>
                    <div class="card border-0 shadow rounded-xs pt-5">
                        <div class=card-body><i
                                class="fas fa-trophy icon-lg icon-yellow icon-bg-yellow icon-bg-circle mb-3"></i>
                            <h4 class="mt-4 mb-3">Layanan Berkualitas</h4>
                            <p>Kami akan selalu menjaga reputasi kami dengan mengutamakan kualitas pada
                                Service/Layanan yang Kami berikan kepada Kamu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow rounded-xs pt-5">
                        <div class=card-body><i
                                class="fas fa-desktop icon-lg icon-purple icon-bg-purple icon-bg-circle mb-3"></i>
                            <h4 class="mt-4 mb-3">Desain Responsive</h4>
                            <p>Desain Panel akan otomatis menyesuaikan pada perangkat apapun, baik di PC/Komputer maupun
                                Mobile Device.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 shadow rounded-xs pt-5">
                        <div class=card-body><i
                                class="fas fa-clock icon-lg icon-primary icon-bg-primary icon-bg-circle mb-3"></i>
                            <h4 class="mt-4 mb-3">Online Full 24 Jam</h4>
                            <p>Panel Kami dapat diakses seharian Full, dimanapun dan kapanpun Kamu Berada.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 shadow rounded-xs pt-5">
                        <div class=card-body><i
                                class="fas fa-cogs icon-lg icon-cyan icon-bg-cyan icon-bg-circle mb-3"></i>
                            <h4 class="mt-4 mb-3">Proses Otomatis</h4>
                            <p>Proses Otomatis ini akan membuat pengalaman berbelanja Kamu di Panel kami menjadi lebih
                                asik dan menyenangkan, dikarenakan semua Proses di bantu oleh sistem kecerdasan buatan
                                yang Kami buat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="card border-0 shadow rounded-xs pt-5">
                        <div class=card-body><i
                                class="fas fa-comment-dots icon-lg icon-red icon-bg-red icon-bg-circle mb-3"></i>
                            <h4 class="mt-4 mb-3">Full Support</h4>
                            <p>Kami akan selalu ngebimbing Kamu jika ada Kesulitan dan Permasalahan, baik Permasalahan
                                Deposit atau Permasalahan seputar Layanan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="card border-0 shadow rounded-xs pt-5">
                        <div class=card-body><i
                                class="fas fa-tachometer-alt icon-lg icon-green icon-bg-green icon-bg-circle mb-3"></i>
                            <h4 class="mt-4 mb-3">Uptime Terbaik</h4>
                            <p>Website memiliki Uptime Terbaik untuk Memanjakan Kamu pada saat berbelanja di Panel
                                Systemrisa Store</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section mb-5" id="tips">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-5 text-center text-md-left mb-4 mb-md-0"><img src="assets/img/why-us.png"
                        class="img-fluid" alt="about-image" data-aos="fade-right"></div>
                <div class="col-lg-6 col-md-7 text-center text-md-left">
                    <p class="subtitle" data-aos="fade-left">Tips</p>
                    <h2 class="section-title" data-aos="fade-left" data-aos-delay="200">Cara Melakukan <b>Pemesanan</b>
                    </h2>
                    <div class="text-center position-relative rounded-lg shadow mb-3" data-aos="fade-right"
                        data-aos-delay="400">
                        <a href="#panel-body-1" class="btn btn-outline-primary text-dark" style="width: 100%;"
                            data-toggle="collapse">Melakukan Pendaftaran</a>
                        <div id="panel-body-1" class="card-body collapse">
                            Silahkan Kamu daftar terlebih dahulu di SMM Panel Kami dengan cara klik tombol "Daftar" di
                            halaman atas. Pendaftaran di SMM Panel Kami 100% Gratis dan Kamu langsung mendapatkan Full
                            Fitur yang ada di Panel Kami.
                        </div>
                    </div>
                    <div class="text-center position-relative rounded-lg shadow mb-3" data-aos="fade-right"
                        data-aos-delay="500">
                        <a href="#panel-body-2" class="btn btn-outline-primary text-dark" style="width: 100%;"
                            data-toggle="collapse">Melakukan Deposit</a>
                        <div id="panel-body-2" class="card-body collapse">
                            Silahkan Kamu lakukan Deposit min.Rp. 20.000 pada menu Deposit di Panel untuk mengisi jumlah
                            saldo Kamu.
                        </div>
                    </div>
                    <div class="text-center position-relative rounded-lg shadow" data-aos="fade-right"
                        data-aos-delay="600">
                        <a href="#panel-body-3" class="btn btn-outline-primary text-dark" style="width: 100%;"
                            data-toggle="collapse">Melakukan PEMESANAN</a>
                        <div id="panel-body-3" class="card-body collapse">
                            Silahkan lakukan Pemesanan sesuai dengan kebutuhan Kamu, dan Pastikan bahwa saldo yang Kamu
                            miliki mencukupi. <small><b>Jangan lupa baca Deskripsi</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="section-lg pb-0 bg-cover"
        data-background="assets/img/check-video.png"> <div class=container>
        <div class="row align-items-center">
            <div class="col-md-6 pr-lg-5 mb-md-0 mb-5">
                <div class="mobile-height position-relative rounded-lg overlay-gradient fill"
                    data-background="assets/img/check-v.jpg" data-aos="zoom-in">
                    <div class=pulse-container>
                        <div class=pulse-box><a class="venobox play-icon icon-center" data-autoplay=true
                                data-vbtype=video href="https://www.youtube.com/watch?v=VufDd-QL1c0"><i
                                    class="fa fa-play text-secondary"></i></a><svg class="pulse-svg" width="90"
                                height="90" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <circle class="circle first-circle" fill="#fff" cx="25" cy="25" r="25" />
                                <circle class="circle second-circle" fill="#fff" cx="25" cy="25" r="25" />
                                <circle class="circle third-circle" fill="#fff" cx="25" cy="25" r="25" />
                                <circle class="circle" fill="#fff" cx="25" cy="25" r="25" /></svg></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-4">
                <p class="subtitle" data-aos="fade-up">Video</p>
                <h2 class="section-title" data-aos="fade-up" data-aos-delay="200">Video profile pendek tentang Systemrisa Store</h2>
            </div>
        </div>
        </div>
    </section> -->
    <section class="section bg-shape-triangles" id="testi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="subtitle" data-aos="fade-up">Testimonial</p>
                    <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Apa kata mereka tentang Kami?</h2>
                </div>
            </div>
            <div class="row testimonial-slider" data-aos="fade-up" data-aos-delay="200">
                <div class=col-lg-4>
                    <div class="card px-4 py-5 border-0 rounded-lg shadow text-center card-border-bottom mb-5 mt-3"><i
                            class="fa fa-quote-right icon-quote mb-4 mx-auto text-primary"></i>
                        <p class=mb-4>Best banget ni SMM Panel, Baru nemuin SMM Panel seperti ini yang Harganya sangat ramah kantong</p>
                        <h4>Raya Aziz</h4><span class=h6>Member</span>
                    </div>
                </div>
                <div class=col-lg-4>
                    <div class="card px-4 py-5 border-0 rounded-lg shadow text-center card-border-bottom mb-5 mt-3"><i
                            class="fa fa-quote-right icon-quote mb-4 mx-auto text-primary"></i>
                        <p class=mb-4>Penggunaannya yang mudah dan fiturnya yang lenkap, memang benar- benar SMM Panel terbaik. Recomended banget</p>
                        <h4>Cahyo Pratama</h4><span class=h6>Member</span>
                    </div>
                </div>
                <div class=col-lg-4>
                    <div class="card px-4 py-5 border-0 rounded-lg shadow text-center card-border-bottom mb-5 mt-3"><i
                            class="fa fa-quote-right icon-quote mb-4 mx-auto text-primary"></i>
                        <p class=mb-4>Yakin bikin ketagihan, Toko ku menjadi ramai peminatnya dengan Follwers Indonesia dari Systemrisa Store.</p>
                        <h4>Jukir Gunawan</h4><span class=h6>Member</span>
                    </div>
                </div>
                <!--<div class=col-lg-4>
                    <div class="card px-4 py-5 border-0 rounded-lg shadow text-center card-border-bottom mb-5 mt-3"><i
                            class="fa fa-quote-right icon-quote mb-4 mx-auto text-primary"></i>
                        <p class=mb-4>Lorem ipsum dolor amet constur adipi sicing elit sed eiusmtempor incid dolore
                            magna aliqu. enim minim veniam quis nostrud exercittion.ullamco laboris nisi ut aliquip
                            excepteur sint occaecat cuida tat nonproident sunt in culpa qui officia deserunt mollit anim
                            id est laborum. sed ut perspiciatis.</p>
                        <h4>Alice kelly</h4><span class=h6>Happy client</span>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!-- pricing -->
    <section class="section section-lg-bottom" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h4 class="subtitle" data-aos="fade-up">Harga Service/Layanan</h4>
                    <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Beberapa List Service/Layanan</h2>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Instagram Followers Indonesia</span>
                        <div class="h2 text-dark m-b-20">Rp. 18.000<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Instagram Followers Indonesia [500] [PROSES -+ 2 Hari]</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Proses -+48jam</li>
                        <li class="my-3">Maksimal 500 Followers</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Instagram Like Indonesia</span>
                        <div class="h2 text-dark m-b-20">Rp. 8.000<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Instagram Likes Indonesia [500] [PROSES -+24 JAM][Hanya Order Via Web/Aplikasi]</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Proses -+24jam</li>
                        <li class="my-3">Maksimal 500 Like</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Instagram Followers BOT</span>
                        <div class="h2 text-dark m-b-20">Rp. 7.013<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Instagram - Followers [ BOT 10K ] [ TERMURAH ON OFF ]</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Followers BOT</li>
                        <li class="my-3">Maksimal 10k Followers</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Instagram Like BOT</span>
                        <div class="h2 text-dark m-b-20">Rp. 6.264<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Instagram Likes - Max 10k INSTAN bot</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Proses instan</li>
                        <li class="my-3">Maksimal 500 Like</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Youtube Subscribe</span>
                        <div class="h2 text-dark m-b-20">Rp. 115.125<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Youtube Subscribers [🚫 - 3K] [Speed 2K+/D]⚡️</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Proses instan</li>
                        <li class="my-3">Maksimal 5k Subscribe</li>
                        <li class="my-3">Speed 1k -2k+/D</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Youtube View Indonesia</span>
                        <div class="h2 text-dark m-b-20">Rp. 15.938<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Youtube Views 🇮🇩 ( Indonesia ) Targeted [ 20k - 200k Per Day ] INSTANT [ NO REFILL ]</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">20k - 200k Per Day</li>
                        <li class="my-3">Maksimal 100k View</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Youtube Like</span>
                        <div class="h2 text-dark m-b-20">Rp. 20.250<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">🔹Youtube 𝐋𝐢𝐤𝐞𝐬 [ G∞ - 20K ] [ 200+/D ] [ Non Drop ]⚡️🔥</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Instan Start</li>
                        <li class="my-3">Garansi seumur hidup</li>
                        <li class="my-3">Maksimal 20k Like</li>
                        <li class="my-3">Speed 200-1k/D</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Facebook Post/Foto Like</span>
                        <div class="h2 text-dark m-b-20">Rp. 13.450<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Facebook - Post/Photo Likes [ Max - 3000 ] [ No Refill ] INSTANT</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Instan Start</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        <li class="my-3">Maksimal 3k Like</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg-4 mb-4" data-aos="fade-up">
                    <div class="pricing-table position-relative text-center px-4 py-5 rounded-lg shadow transition bg-white">
                        <span class="badge badge-pill badge-light font-weight-medium mb-3 py-2 px-4 text-primary">Facebook Random Comment</span>
                        <div class="h2 text-dark m-b-20">Rp. 727.500<span class="paragraph text-lowercase"> / 1000</span></div>
                        <h5 class="mb-4 font-weight-normal text-color">Facebook Female Random Comments [1H - INSTANT] 💧</h5>
                        <hr>
                        <ul class="list-unstyled my-4">
                        <li class="my-3">Instan Start</li>
                        <li class="my-3">Tidak ada pengembalian Saldo</li>
                        <li class="my-3">Maksimal 100 Comment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing -->
    <section class="subscription" hidden>
        <div class="container">
            <div class=subscription-wrapper>
                <div
                    class="d-flex position-relative mx-5 justify-content-between align-items-center flex-column flex-md-row text-center text-md-left">
                    <h3 class="text-white flex-fill">Kamu Tertarik?<br>Yuk Daftar...</h3>
                    <form method="POST" class="row flex-fill" action="">
                        <div class="col-lg-7 my-md-2 my-2">
                            <input type="email" class="form-control text-white px-4 border-0 w-100 text-center text-md-left" placeholder="Ketik Email Kamu..." required name="email_kirim"></div>
                            <div class="col-lg-5 my-md-2 my-2">
                                <button type="submit" name="kirim" class="btn btn-primary btn-lg border-0 w-100">Daftar Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-secondary pt-5" id="kontak">
        <section class="section border-bottom border-color pt-0 pb-3">
            <div class=container>
                <div class="row justify-content-between">
                    <div class="col-md-5 mb-4 mb-md-0"><a href="#"> <img class="img-fluid" src="assets/img/favicon.png" width="60px"
                        alt="SYSTEMRISA STORE - SMM Panel Termurah No.1 di Indonesia"><b
                        class="text-white ml-2">SYSTEMRISA STORE</b></a>
                        <p class="text-light mb-4">SMM Panel Termurah dan Terbaik No.1 di Indonesia
                        </p>
                        <ul class="list-inline social-icons">
                            <li class=list-inline-item><a href="https://www.facebook.com/systemrisa.store" target="_BLANK"><i class="fab fa-facebook"></i></a></li>
                            <li class=list-inline-item><a href="https://g.page/systemrisa" target="_BLANK"><i class="fab fa-google"></i></a></li>
                            <li class=list-inline-item><a href="https://www.instagram.com/systemrisa_store" target="_BLANK"><i class="fab fa-instagram"></i></a></li>
                        </ul><br><br>
                        <h4 class="text-white mb-4">Info Kontak</h4>
                        <ul class=list-unstyled>
                            <li class="mb-3 text-light"><?= $web_service['alamat'];?></li>
                            <li class="mb-3 text-light">+62 821-1086-0615</li>
                            <li class="mb-3 text-light">systemairisa@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4 class="text-white mb-4">Service/Layanan Kami</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan View Instagram</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Story Views dan Like Instagram</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Like dan Comment Facebook</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Subscribe, Like, View, Jam Tonton Youtube</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan View Tiktok</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan View Likee</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Website Traffic</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers dan Comment Linkedin</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <ul class="list-unstyled">
                        <br>
                        <br>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followes, Pin, dan Repin Pinterest</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan Ratting Bukalapak</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan Ratting Shopee</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan Ratting Tokopedia</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Followers, Like, dan View Likee</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Follow, Like, Poll Votes, Reetweets, View Twitter</a></li>
                            <li class="mb-3 text-light"><i class="fas fa-arrow-right"></i> Dan masih banyak yang lainnya</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-4">
            <div class=container>
                <div class=row>
                    <div class="col-12 text-center">
                        <p class="mb-0 text-light">Copyright © 2020 Systemrisa Store dibuat oleh <b>Agung Dwi Sahputra</b></p> </div> </div> </div> </section>
                                </footer>
                            <script src="panel/assets/libs/jquery/dist/jquery.min.js">
                            </script>
                            <script src="panel/assets/libs/bootstrap/dist/js/bootstrap.min.js">
                            </script>
                            <script src="assets/css/agico-hugo/jquery.easing.min.js"></script>
                            <script src="assets/css/agico-hugo/risa.js"></script>
                            <script src="assets/css/agico-hugo/slick.min.js"> </script>
                            <script src="assets/css/agico-hugo/venobox.min.js">
                            </script>
                            <script src="assets/css/agico-hugo/gmap.js"> </script>
                            <script src="assets/css/agico-hugo/fuse.min.js"> </script>
                            <script src="assets/css/agico-hugo/mark.js"> </script>
                            <script src="assets/css/agico-hugo/search.js"> </script>
                            <script src="assets/css/agico-hugo/aos.js"> </script>
                            <script src="assets/css/agico-hugo/script.min.js"> </script>
                            <!--<script>
                                    (function (i, s, o, g, r, a, m) {
                                        i['GoogleAnalyticsObject'] = r;
                                        i[r] = i[r] || function () {
                                            (i[r].q = i[r].q || []).push(arguments)
                                        }, i[r].l = 1 * new Date();
                                        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
                                        a.async = 1;
                                        a.src = g;
                                        m.parentNode.insertBefore(a, m)
                                    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
                                    ga('create', 'Your ID', 'auto');
                                    ga('send', 'pageview');
                                </script> -->
</body>

</html>