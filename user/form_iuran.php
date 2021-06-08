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
if(isset($_SESSION["id"])) {
    include "footer.php";
    include "navbar.php";
}else{
    header("Location:/");
}
?>

    <div class="col p-4">
    <h1 class="display-4" align="center">Form Iuran Wajib</h1><br>
    <div class="container bg-success" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
    <form class="row g-3" action="" method="POST">
        <div class="col-md-12">
            <label for="name" class="form-label text-white">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" value="<?php echo $_SESSION["name"];?>" required readonly>
            <br>
        </div>
        <div class="col-md-12">
            <label for="nominal" class="form-label text-white">Nominal Simpanan</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="" min="500000" max="10000000" step="100000" onchange="return get_kodeunik()" placeholder="Masukkan Nominal"required>
            <br>
        </div>
        <div class="col-md-12">
            <label for="nominal" class="form-label text-white">Nominal + Kode Unik (yang harus dibayar)</label>
            <input type="number" class="form-control" id="kodeunik" name="kodeunik" value="" min="500000" max="10000000" step="100000" placeholder="Masukkan Kode Unik" required readonly>
            <br>
        </div>
        <div class="col-md-12">
            <label for="durasi" class="form-label text-white">Per Bulan</label>
            <select class="form-control" id="durasi" name="durasi" value="" onchange="return cek_return()" placeholder="Bulan ke"required>
                <option value="">Bulan ke -</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <br>
        </div>
        <script type="text/javascript">

            function get_kodeunik(){
                nominal = document.getElementById("nominal").value;

                kodeunik = nominal*1+(Math.floor(Math.random() * 1000) + 100);

                document.getElementById("kodeunik").value = kodeunik;
            }
        </script>
        <div class="col-md-12">
            <label for="confirm_password" class="text-white">Konfirmasi Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Masukkan Password Anda">
            <br>
        </div>
        <div class="col-12">
            <br>
            <button type="submit" class="btn btn-warning text-dark"><i class="fas fa-money-check-alt"></i>Ajukan Iuran</button>
        </div>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nominal = $_POST["nominal"];
            $confirm_password = $_POST["confirm_password"];
            $kodeunik = $_POST["kodeunik"];
            $id = $_SESSION["id"];
            $cek_password = mysqli_query($koneksi,"SELECT * FROM user WHERE id = '$id' AND password = '$confirm_password' ");
            $res_password = mysqli_num_rows($cek_password);
            if ($res_password == 0){
                echo "Password yang Anda Masukkan Salah";
            }else{
                $sql = mysqli_query($koneksi,"INSERT INTO tabungan_unconfirm(id_user, nominal, kode_unik, status) VALUES ('$id','$nominal','$kodeunik','Menunggu Konfirmasi')");
                if ($sql){
                    echo "Berhasil Berhasil Mengajukan simpanan";
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