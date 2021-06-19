<!-- Bootstrap NavBar -->
<nav class="navbar navbar-expand-md navbar-secondary bg-secondary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img src="https://www.jatikom.com/wp-content/uploads/2016/11/logo-koperasi.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="menu-collapsed text-white">Dashboard Admin</span>
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item">
            <a href="../logout.php" class="btn btn-danger" tabindex="-1" role="button" aria-disabled="true" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fa fa-sign-out-alt fa-fw mr-2" aria-hidden="true"></i>Logout</a>
            </li>
            <!-- This menu is hidden in bigger devices with d-sm-none. 
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
           <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                    <a class="dropdown-item" href="/admin/index.php"><i class="fas fa-home fa-fw mr-2" aria-hidden="true"></i>Beranda</a>
                    <a class="dropdown-item" href="/admin/data_admin.php"><i class="fa fa-address-book fa-fw mr-2" aria-hidden="true"></i>Data Admin</a>
                    <a class="dropdown-item" href="/admin/data_user.php"><i class="fa fa-address-book fa-fw mr-2" aria-hidden="true"></i>Data User</a>
                    <a class="dropdown-item" href="/admin/konfirmasi_simpanan.php"><i class="fas fa-check-circle fa-fw mr-2"></i>Konfirmasi Simpanan</a>
                    <a class="dropdown-item" href="/admin/konfirmasi_pinjaman.php"><i class="fas fa-check-circle fa-fw mr-2"></i>Konfirmasi Pinjaman</a>
                    <a class="dropdown-item" href="/admin/konfirmasi_iuran.php"><i class="fas fa-check-circle fa-fw mr-2"></i>Konfirmasi Iuran Wajib</a>
                </div>
            </li><!-- Smaller devices menu END -->
        </ul>
    </div>
</nav><!-- NavBar END -->
<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block bg-secondary">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title d-flex align-items-center menu-collapsed bg-secondary">
                <large style="color:white;">MAIN MENU</large>
            </li>
            <!-- /END Separator -->
            <a href="index.php" class="bg-secondary list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-home fa-fw mr-3"></span>
                    <span class="menu-collapsed">Beranda</span>
                </div>
            </a>
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-bars fa-fw mr-3"></span>
                    <span class="menu-collapsed">Data Koperasi</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="/admin/data_admin.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Data Admin</span>
                </a>
                <a href="/admin/data_user.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Data User</span>
                </a>
                <a href="/admin/data_simpanan.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Data Simpanan</span>
                </a>
                <a href="/admin/data_pinjaman.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Data Pinjaman</span>
                </a>
                <a href="/admin/data_iuran.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Data Iuran Wajib</span>
                </a>
                <a href="/admin/data_shu.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Data SHU</span>
                </a>
            </div>
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user-cog fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pengaturan</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="konfirmasi_simpanan.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Konfirmasi Simpanan</span>
                </a>
                <a href="konfirmasi_pinjaman.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Konfirmasi Pinjaman</span>
                </a>
                <a href="konfirmasi_iuran.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Konfirmasi Iuran Wajib</span>
                </a>
                <a href="konfirmasi_tariktunai.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Konfirmasi Tarik Tunai</span>
                </a>
                <a href="konfirmasi_pengembalian.php" class="list-group-item list-group-item-action bg-secondary text-white">
                    <span class="menu-collapsed">Konfirmasi Pengembalian</span>
                </a>
            </div>
            <!-- Separator with title -->
            <!-- <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <large>ABOUT</large>
            </li> -->
            <!-- /END Separator -->
            <!-- <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-info-circle fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tentang</span>
                </div>
            </a> -->
            <!-- Separator without title -->
            <!-- <li class="list-group-item sidebar-separator menu-collapsed bg-secondary"></li> -->
            <!-- /END Separator
            <a href="#top" data-toggle="sidebar-colapse" class="bg-secondary list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Collapse</span>
                </div>
            </a> -->
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
    <!-- MAIN -->