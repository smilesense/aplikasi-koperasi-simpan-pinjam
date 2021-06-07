<!DOCTYPE html>
<html lang="en">
<head>
  <a href="#" class="navbar-brand mx-auto" style="display:flex; justify-content: space-around; border-radius:5px;">
        <img src="https://www.dictio.id/uploads/db3342/original/3X/3/3/330d8a032193a6f42725fac39e0b246a01abd521.jpg" height="100" align="center" alt="Logo-Koperasi">
  </a>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <?php
    include "../css.php";
    ?>
  <title>Koperasi</title>
  <style>
            #body-row {
            margin-left:0;
            margin-right:0;
        }
        #sidebar-container {
            min-height: 100vh;   
            background-color: #333;
            padding: 0;
        }

        /* Sidebar sizes when expanded and expanded */
        .sidebar-expanded {
            width: 230px;
        }
        .sidebar-collapsed {
            width: 60px;
        }

        /* Menu item*/
        #sidebar-container .list-group a {
            height: 50px;
            color: white;
        }

        /* Submenu item*/
        #sidebar-container .list-group .sidebar-submenu a {
            height: 45px;
            padding-left: 30px;
        }
        .sidebar-submenu {
            font-size: 0.9rem;
        }

        /* Separators */
        .sidebar-separator-title {
            background-color: #333;
            height: 35px;
        }
        .sidebar-separator {
            background-color: #333;
            height: 25px;
        }
        .logo-separator {
            background-color: #333;    
            height: 60px;
        }

        /* Closed submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
        content: " \f0d7";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 10px;
        }
        /* Opened submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
        content: " \f0da";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 10px;
        }
    </style>
</head>
<body>
<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id"])) {
    include "navbar.php";
    $id_user = $_SESSION["id"];
    $sql = mysqli_query($koneksi,"SELECT SUM(nominal+bunga) FROM pinjaman WHERE id_user = $id_user AND status = 'Terkonfirmasi' ");
    $nominal_pinjaman = mysqli_fetch_array( $sql );
    $sql1 = mysqli_query($koneksi,"SELECT SUM(nominal) FROM tabungan WHERE id_user = $id_user ");
    $saldo_simpanan = mysqli_fetch_array( $sql1 );
}else{
    header("Location:/");
}
?>
    <div class="col p-4">
        <h1 class="display-4" align="center">Selamat Datang di Koperasi Sejahtera Bersama</h1><br>
            <div class="row">
                    <div class="col-sm-4">
                        <div class="card border-info mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-info text-white"><h5>Simpanan Saya</h5></div>
                                <div class="card-body text-info">
                                    <h5 class="card-title">Rp. <?php echo $saldo_simpanan[0]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-info">
                                <a href="#" class="btn btn-outline-info"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card border-danger mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-danger border-danger text-white"><h5>Pinjaman Saya</h5></div>
                                <div class="card-body text-danger">
                                    <h5 class="card-title">Rp. <?php echo $nominal_pinjaman[0]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-danger">
                                <a href="/user/list_pinjaman.php" class="btn btn-outline-danger"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card border-success mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-success text-white"><h5>SHU Saya</h5></div>
                                <div class="card-body text-success">
                                    <h5 class="card-title">Rp. 1,000,000</h5>
                                </div>
                            <div class="card-footer bg-transparent border-success">
                                <a href="#" class="btn btn-outline-success"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
        </div><!-- Main Col END -->
</div><!-- body-row END --> 

<script>
// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
</script>
</body>
</html>