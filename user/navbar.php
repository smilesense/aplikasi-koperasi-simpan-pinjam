<link rel="icon" href="../assets/logokop.jpg" type="image/x-icon"></head>
<!-- Bootstrap NavBar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/user/index.php">
        <img src="https://www.jatikom.com/wp-content/uploads/2016/11/logo-koperasi.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="menu-collapsed">KSP Sejahtera Bersama</span>
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item" style="padding-right:10px; padding-top:5px;">
              <h5 style="color:white;">Selamat Datang, <?php echo $_SESSION["name"]; ?> </h5>
            </li>
            <li class="nav-item">
            <a href="../logout.php" class="btn btn-danger" tabindex="-1" role="button" aria-disabled="true" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fa fa-sign-out-alt fa-fw mr-2" aria-hidden="true"></i>Logout</a>
            </li>
            <!-- This menu is hidden in bigger devices with d-sm-none. 
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
           <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                    <a class="dropdown-item" href="/user/index.php"><i class="fas fa-home fa-fw mr-2" aria-hidden="true"></i>Beranda</a>
                    <a class="dropdown-item" href="/user/form_simpanan.php"><i class="fas fa-money-bill fa-fw mr-2" aria-hidden="true"></i>Simpan Uang</a>
                    <a class="dropdown-item" href="/user/form_peminjaman.php"><i class="fas fa-money-check fa-fw mr-2" aria-hidden="true"></i>Pinjam Uang</a>
                    <a class="dropdown-item" href="/user/profile.php"><i class="fa fa-user fa-fw mr-2" aria-hidden="true"></i>Profil Pengguna</a>
                    <a class="dropdown-item" href="/user/list_simpanan.php"><i class="fa fa-wallet fa-fw mr-2" aria-hidden="true"></i>Simpanan Saya</a>
                    <a class="dropdown-item" href="/user/list_pinjaman.php"><i class="fa fa-tags fa-fw mr-2" aria-hidden="true"></i>Pinjaman Saya</a>
                    <a class="dropdown-item" href="/user/list_iuran.php"><i class="fa fa-user fa-clipboard-check mr-2" aria-hidden="true"></i>Iuran Wajib Saya</a>
                    <a class="dropdown-item" href="/user/list_shu.php"><i class="fa fa-user fa-coins mr-2" aria-hidden="true"></i>SHU Saya</a>
                    <a class="dropdown-item" href="/user/list_tariktunai.php"><i class="fa fa-money-bill-wave fa-fw mr-2" aria-hidden="true"></i>Tarik Tunai Saya</a>
                    <a class="dropdown-item" href="/user/tentang.php"><i class="fa fa-info-circle fa-fw mr-2" aria-hidden="true"></i>Tentang</a>
                </div>
            </li><!-- Smaller devices menu END -->
        </ul>
    </div>
</nav><!-- NavBar END -->
<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <large>MAIN MENU</large>
            </li>
            <!-- /END Separator -->
            <a href="index.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-home fa-fw mr-3"></span>
                    <span class="menu-collapsed">Beranda</span>
                </div>
            </a>
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-bars fa-fw mr-3"></span>
                    <span class="menu-collapsed">Menu</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="form_simpanan.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Simpan Uang</span>
                </a>
                <a href="/user/form_peminjaman.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Pinjam Uang</span>
                </a>
            </div>
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">Profile</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="/user/profile.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Profil Pengguna</span>
                </a>
                <a href="/user/list_simpanan.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Simpanan Saya</span>
                </a>
                <a href="/user/list_pinjaman.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Pinjaman Saya</span>
                </a>
                <a href="/user/list_iuran.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Iuran Wajib Saya</span>
                </a>
                <a href="/user/list_shu.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">SHU Saya</span>
                </a>
                <a href="/user/list_tariktunai.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Tarik Tunai Saya</span>
                </a>
            </div>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <large>ABOUT</large>
            </li>
            <!-- /END Separator -->
            <a href="/user/tentang.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-info-circle fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tentang</span>
                </div>
            </a>
            <!-- Separator without title -->
            <!-- <li class="list-group-item sidebar-separator menu-collapsed"></li> -->
            <!-- /END Separator
            <a href="#top" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Collapse</span>
                </div>
            </a> -->
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
    <!-- MAIN -->