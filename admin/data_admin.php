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
    <h1 class="display-4" align="center">Data Admin</h1><br>
    <div class="container bg-primary" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
        <div class="table-responsive"> 
            <table id="example" class="table table-striped table-bordered text-white" style="width:100%;">
            <!-- <h3 class="panel-title">Konfirmasi Simpanan</h3> -->
            <input type="search" class="form-control form-control-sm" placeholder="Cari Data" style="width:20%; float:right;"></input><br><br>
                <thead>
                    <tr>
                        <th>ID Admin</th>
                        <th>Email Admin</th>
                        <th>Username Admin</th>
                        <th>Password Admin</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $search = $_GET["search"];
                $sql = mysqli_query($koneksi,"SELECT * FROM admin WHERE id like '%".$search."%' OR email like '%".$search."%' OR username like '%".$search."%'");
                while ( $r = mysqli_fetch_array( $sql ) ){?>
                    <tr>
                        <td><?php echo $r["id"];?> </td>
                        <td><?php echo $r["email"];?></td>
                        <td><?php echo $r["username"];?></td>
                        <td><?php echo $r["password"];?></td>
                    </tr>
                <?php
                }?>
            </table>
        </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_SESSION["id"];
            $nominal = $_POST["nominal"];
            $bunga = ($_POST["total"]-$nominal);
            $confirm_password = $_POST["confirm_password"];
            $tanggal_return = $_POST["tanggal_return"];
            $cek_password = mysqli_query($koneksi,"SELECT * FROM user WHERE id = '$id' AND password = '$confirm_password' ");
            $res_password = mysqli_num_rows($cek_password);
            if ($res_password == 0){
                echo "Password yang Anda Masukkan Salah";
            }else{
                $sql = mysqli_query($koneksi,"INSERT INTO pinjaman(id_user, nominal, bunga, jatuh_tempo, status) VALUES ('$id','$nominal', '$bunga' , '$tanggal_return','Menunggu Persetujuan')");
                if ($sql){
                    echo "Berhasil Berhasil Mengajukan Pinjaman";
                }else {
                    echo "error";
                }
            }  
        }
        ?>
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