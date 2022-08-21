<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="index.php">
                <!-- Logo icon -->
            <b class="logo-icon">
                <!-- Dark Logo icon -->
                <i class="fas fa-shopping-bag m-3 dark-logo"></i>
                <!-- Light Logo icon -->
                <i class="fas fa-shopping-bag m-3 light-logo"></i>
                <!--End Logo icon -->
            </b>
                <!-- Logo text -->
            <span class="logo-text">
                <!-- dark Logo text -->
                <b class="dark-logo">SYSTEMRISA STORE</b>
                <!-- Light Logo text -->   
                <b class="light-logo">SYSTEMRISA STORE</b> 
            </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $link?>/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class=""><img src="<?= $link?>/assets/images/users/1.jpg" alt="user" class="img-circle" width="60"></div>
                            <div class="m-l-10">
                                <?php
                                    $query4 = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
                                    $user = mysqli_fetch_array($query4);
                                ?>
                                <h4 class="m-b-0"><?= $user['nama']; ?></h4>
                                <small><?= $user['username']; ?>&nbsp;(<?= $user['level']; ?>)</small>
                                <p class=" m-b-0"><?= $user['email']; ?></p>
                            </div>
                        </div>
                        <div class="m-15">
                            <i class="ti-wallet m-r-5 m-l-5"></i><strong>Saldo :</strong> Rp. <?= number_format($dataUser['saldo'],0,',','.'); ?>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $link?>/pengaturan"><i class="ti-settings m-r-5 m-l-5"></i> Pengaturan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $link ?>/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown mt-3">
                        <div class="user-pic"><img src="<?= $link?>/assets/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /></div>
                        <div class="user-content hide-menu ml-2">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 user-name font-medium"><?= $user['nama']; ?>&nbsp;<i class="fa fa-angle-down"></i></h5>
                                <span class="op-5 user-email"><?= $user['email']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                            <div class="m-15">
                            <i class="ti-wallet m-r-5 m-l-5"></i><strong>Saldo :</strong> Rp. <?= number_format($dataUser['saldo'],0,',','.'); ?>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $link?>/pengaturan"><i class="ti-settings m-r-5 m-l-5"></i> Pengaturan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $link ?>/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        <div class="dropdown-divider"></div>    
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu</span></li>
                <li class="sidebar-item"><a href="<?= $link?>" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard </span></a></li>
                <?php if ($dataUser['level'] === "Admin"): ?>
                <li class="sidebar-item"><a href="<?= $link?>/admin" class="sidebar-link"><i class="mdi mdi-crown"></i><span class="hide-menu">Admin </span></a></li>
                <?php endif ?>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span class="hide-menu">Pembelian </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= $link?>/pembelian" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Pembelian Baru </span></a></li>
                        <li class="sidebar-item"><a href="<?= $link?>/riwayat-pembelian" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-cart"></i><span class="hide-menu"> Riwayat Pembelian </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"><a href="<?= $link?>/daftar-layanan" class="sidebar-link"><i class="mdi mdi-server"></i><span class="hide-menu">Daftar Layanan </span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card"></i><span class="hide-menu">Deposit </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= $link?>/deposit" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-credit-card-plus"></i><span class="hide-menu"> Deposit Baru </span></a></li>
                        <li class="sidebar-item"><a href="<?= $link?>/reedem" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-barcode-scan"></i><span class="hide-menu"> Reedem Voucher </span></a></li>
                        <li class="sidebar-item"><a href="<?= $link?>/riwayat-deposit" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu"> Riwayat Deposit </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"><a href="<?= $link?>/riwayat-saldo" class="sidebar-link"><i class="mdi mdi-wallet"></i><span class="hide-menu">Riwayat Saldo </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/kontak-kami" class="sidebar-link"><i class="mdi mdi-contacts"></i><span class="hide-menu">Kontak Kami </span></a></li>
                <li class="sidebar-item">
                    <a href="<?= $link?>/ticket" class="sidebar-link"><i class="mdi mdi-email"></i>
                        <span class="hide-menu">
                            Tiket 
                            <?php
                            /* Menghitung Semua Data yang ada di Database Tiket */
                            $data2 =array();
                            $query2 = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' AND status = 'Unread-Member'");
                            while(($row2 = mysqli_fetch_array($query2)) != null){
                                $data2[] = $row2;
                            }
                            $unR_member = count($data2);

                            if ($unR_member > 0) {
                                echo '<span class="badge badge-warning">'.$unR_member.'</span>';
                            } else {
                                echo '';
                            }
                            ?>
                        </span>
                    </a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-book"></i><span class="hide-menu">Halaman </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= $link?>/syarat-ketentuan" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-alert-circle"></i><span class="hide-menu"> Syarat & Ketentuan </span></a></li>
                        <li class="sidebar-item"><a href="<?= $link?>/pertanyaan-umum" class="sidebar-link">&nbsp;&nbsp;&nbsp;<i class="mdi mdi-comment-multiple-outline"></i><span class="hide-menu"> Pertanyaan Umum </span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->