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
    <h1 class="display-4" align="center">Konfirmasi Tarik Tunai</h1><br>
    <div class="container bg-dark" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);"> 
    <table id="example" class="table table-striped table-bordered text-white" style="width:100%">
    <!-- <h3 class="panel-title">Konfirmasi Simpanan</h3> -->
    <form id="search" action="" method="GET">
        <input type="search" name="search" class="form-control form-control-sm" value="<?php echo $_GET["search"]?>" onchange=" cari()" placeholder="Cari Data" style="width:20%; float:right;"></input><br><br>
    </form>
    <script type="text/javascript">
        $(document).ready(
            function cari() {
                document.getElementById["search"].submit();
            }
        );
    </script>
        <thead>
            <tr>
                <th>ID User</th>
                <th>Nama User</th>
                <th>Nominal Tarik Tunai</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($_GET["search"])){
                $search = $_GET["search"];
            }
                $sql = mysqli_query($koneksi,"SELECT * FROM simpanan WHERE id_tabungan like '%".$search."%' OR id_user like '%".$search."%' OR nominal like '%".$search."%' OR kode_unik like '%".$search."%' OR status like '%".$search."%' ");
                while ( $r = mysqli_fetch_array( $sql ) ) {
        ?>
            <tr>
                <td><?php echo $r["id_user"];?></td>
                <td><?php echo $r["nama_lengkap"];?></td>
                <td><?php echo $r[""];?></td>
                <td><a href="#" class="btn btn-success btn-xs"><i class="fas fa-check-circle fa-fw mr-1"></i>Konfirmasi</a></td>
                <?php
                if($r["status"] == "Menunggu Konfirmasi"){
                    echo '<a href="/admin/konfirmasi_simpanan.php?confirm_tabungan=';
                    echo $r["id_tabungan"]; if(isset($_GET["search"])){echo "&search="; 
                    echo $_GET["search"];}
                    echo '"class="btn btn-primary btn-xs"><i class="fas fa-check-circle fa-fw mr-1"></i>Konfirmasi</a></td>';
                }else{
                    
                }
                ?>
            <?php
                }
            if(isset($_GET["confirm_tabungan"])){
                $id_tabungan = $_GET["confirm_tabungan"];
                $update  = mysqli_query($koneksi,"UPDATE simpanan SET status = 'Terkonfirmasi' WHERE id_tabungan = '$id_tabungan' ");
                $sql = mysqli_query($koneksi,"SELECT * FROM simpanan WHERE id_tabungan = '$id_tabungan' ");
                $s = mysqli_fetch_array( $sql);
                $nominal = $s["nominal"];
                $id_user = $s["id_user"];
                $update_saldo_simpanan = mysqli_query($koneksi,"UPDATE user SET simpanan_sukarela = (simpanan_sukarela+('$nominal')) WHERE id = '$id_user' ");
                ?>
                        <script type='text/javascript'> 
                        document.location = '/admin/konfirmasi_simpanan.php<?php if(isset($_GET["search"])){echo "?search="; echo $_GET["search"];} ?>';
                        </script>;
                <?php
            }
            ?>
            </tr>
        </tbody>
        </table>
    </div>
  </div>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
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