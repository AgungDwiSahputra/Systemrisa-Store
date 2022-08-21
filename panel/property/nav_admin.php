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
                <i class="mdi mdi-crown mt-3 ml-3 mb-3 mr-1 dark-logo display-7 text-orange"></i>
                <!-- Light Logo icon -->
                <i class="mdi mdi-crown mt-3 ml-3 mb-3 mr-1 light-logo display-7 text-orange"></i>
                <!--End Logo icon -->
            </b>
                <!-- Logo text -->
            <span class="logo-text">
                <!-- dark Logo text -->
                <b class="dark-logo"><b class="text-orange">ADMIN</b> SYSTEMRISA</b>
                <!-- Light Logo text -->   
                <b class="light-logo">ADMIN SYSTEMRISA</b> 
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
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $link?>/assets/images/users/foto_ku.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class=""><img src="<?= $link?>/assets/images/users/foto_ku.jpg" alt="user" class="img-circle" width="60"></div>
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
                        <div class="user-pic"><img src="<?= $link?>/assets/images/users/foto_ku.jpg" alt="users" class="rounded-circle" width="40" /></div>
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
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu Admin</span></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard Admin </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/kelola-deposit" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Kelola Deposit </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/kelola-voucher" class="sidebar-link"><i class="mdi mdi-barcode-scan"></i><span class="hide-menu">Kelola Voucher </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/data-saldo" class="sidebar-link"><i class="mdi mdi-wallet"></i><span class="hide-menu">Data Saldo </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/metode-deposit" class="sidebar-link"><i class="mdi mdi-credit-card"></i><span class="hide-menu">Metode Deposit </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/kelola-pembelian" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu">Kelola Pembelian </span></a></li>
                <li class="sidebar-item">
                    <a href="<?= $link?>/admin/kelola-ticket" class="sidebar-link"><i class="mdi mdi-email"></i>
                        <span class="hide-menu"> 
                            Kelola Tiket 
                            <?php
                            /* Menghitung Semua Data yang ada di Database Tiket */
                            $data1 =array();
                            $query1 = mysqli_query($konek, "SELECT * FROM id_ticket WHERE status = 'Unread-Admin'");
                            while(($row1 = mysqli_fetch_array($query1)) != null){
                                $data1[] = $row1;
                            }
                            $unR_admin = count($data1);

                            if ($unR_admin > 0) {
                                echo '<span class="badge badge-danger">'.$unR_admin.'</span>';
                            } else {
                                echo '';
                            }
                            ?>
                        </span>
                    </a>
                </li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/kelola-kontak" class="sidebar-link"><i class="mdi mdi-contacts"></i><span class="hide-menu">Kelola Kontak </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/kelola-informasi" class="sidebar-link"><i class="mdi mdi-projector-screen"></i><span class="hide-menu">Kelola Informasi </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/kelola-layanan" class="sidebar-link"><i class="mdi mdi-server"></i><span class="hide-menu">Kelola Layanan </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/transfer-saldo" class="sidebar-link"><i class="mdi mdi-send"></i><span class="hide-menu">Transfer Saldo </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/reset-password" class="sidebar-link"><i class="mdi mdi-lock"></i><span class="hide-menu">Reset Password </span></a></li>
                <li class="sidebar-item"><a href="<?= $link?>/admin/suspend-akun" class="sidebar-link"><i class="mdi mdi-lock"></i><span class="hide-menu">Suspend Akun </span></a></li>
                <a href="<?= $link?>" class="btn btn-warning mt-5"><i class="ti-arrow-circle-left"></i> <span class="hide-menu">Kembali ke Beranda Member </span></a>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->