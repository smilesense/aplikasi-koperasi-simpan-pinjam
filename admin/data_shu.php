<!DOCTYPE html>
<html lang="en">
<head>
  <a href="#" class="navbar-brand mx-auto" style="display:flex; justify-content: space-around; border-radius:5px;">
        <img src="https://www.dictio.id/uploads/db3342/original/3X/3/3/330d8a032193a6f42725fac39e0b246a01abd521.jpg" height="100" align="center" alt="Logo-Koperasi">
  </a>
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
if (isset($_SESSION["id_admin"])){
    include "navbar.php";
    include "footer.php";
}else{
    header("Location:/");
}
?>

    <div class="col p-4">
    <h1 class="display-4" align="center">Data SHU</h1><br>
    <div class="container bg-danger" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);"> 
        <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-white" style="width:100%;">
            <!-- <h3 class="panel-title">Konfirmasi Simpanan</h3> -->
            <a href="/admin/bagi_shu.php?bagi_shu=99201928" class="btn btn-info btn-xs"><i class="fas fa-share-square fa-fw mr-1"></i>Bagi SHU</a>
            <input type="search" class="form-control form-control-sm" placeholder="Cari Data" style="width:20%; float:right;"></input><br><br>
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Nama User</th>
                        <th>NIK User</th>
                        <th>Rekening User</th>
                        <th>Total SHU</th>
                        <!-- <th>Tindakan</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php
                $search = $_GET["search"];
                $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE id like '%".$search."%' OR nama_lengkap like '%".$search."%' OR nik like '%".$search."%' OR no_rekening like '%".$search."%'");
                while ( $r = mysqli_fetch_array( $sql ) ){?>
                    <tr>
                        <td><?php echo $r["id"];?></td>
                        <td><?php echo $r["nama_lengkap"];?></td>
                        <td><?php echo $r["nik"];?></td>
                        <td><?php echo $r["no_rekening"];?></td>

                        <?php
                            $id = $r["id"];
                            $nama = $r["nama_lengkap"];
                            $sql1 = mysqli_query($koneksi,"SELECT nominal FROM inventaris WHERE id = '2' AND keterangan = 'SHU' ");
                            $get_total_shu = mysqli_fetch_array( $sql1 );
                            $total_shu = $get_total_shu["nominal"];
                            $shu_pinjaman = $total_shu*35/100;
                            $shu_simpanan = $total_shu*60/100;
        
                            ///simpanan
                            $sql1 = mysqli_query($koneksi,"SELECT SUM(iuran_wajib+simpanan_sukarela) FROM user ");
                            $get_total_simpanan = mysqli_fetch_array( $sql1 );
                            $total_simpanan = $get_total_simpanan[0];
        
                            $sql1 = mysqli_query($koneksi,"SELECT SUM(iuran_wajib+simpanan_sukarela) FROM user WHERE id = '$id' ");
                            $get_simpanan_user = mysqli_fetch_array( $sql1 );
                            $simpanan_user = $get_simpanan_user[0]; 
        
                            ///pinjaman
                            $sql1 = mysqli_query($koneksi,"SELECT SUM(nominal) FROM pinjaman ");
                            $get_total_pinjaman = mysqli_fetch_array( $sql1 );
                            $total_pinjaman = $get_total_pinjaman[0];
        
                            $sql1 = mysqli_query($koneksi,"SELECT SUM(nominal) FROM pinjaman WHERE id_user = '$id' ");
                            $get_pinjaman_user = mysqli_fetch_array( $sql1 );
                            $pinjaman_user = $get_pinjaman_user[0];
        
                            $shu_simpanan_user = ($simpanan_user/$total_simpanan)*(($shu_simpanan/$total_shu)*$total_shu);
                            $shu_pinjaman_user = ($pinjaman_user/$total_pinjaman)*(($shu_pinjaman/$total_shu)*$total_shu);
                            $shu_user = $shu_simpanan_user+$shu_pinjaman_user;
                        ?>
                        <td><?php echo $shu_user;?></td>
                        <!-- <td style="vertical-align:middle;"><a href="#" class="btn btn-info btn-xs"><i class="fas fa-share-square fa-fw mr-1"></i>Bagi SHU</a></td>  -->
                    </tr>
                <?php
                }?>
                        
                </tbody>
                </table>
        </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


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