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
    include "navbar.php";
    include "footer.php";
}else{
    header("Location:/");
}
?>

    <div class="col p-4">
    <h1 class="display-4" align="center">Form Pengembalian Pinjaman</h1><br>
    <div class="container bg-danger" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
    <form class="row g-3" action="" method="POST">
    <?php
    $id_pinjaman = $_GET["bayar_pinjaman"];
    $sql1 = mysqli_query($koneksi,"SELECT total_pinjaman FROM pinjaman WHERE id_pinjaman = $id_pinjaman");
    $nominal_pinjaman = mysqli_fetch_array( $sql1 );
    ?>
    <div class="col-md-12">
    <h5 id="id_pinjaman" style="Padding-left:18px; color:white;">ID Pinjaman : <?php echo $_GET["bayar_pinjaman"]; ?></h5>
    </div>
    <div class="col-md-12">
    <h5 id="nominal_pinjaman" style="Padding-left:18px; color:white;">Nominal Pinjaman : <?php echo $nominal_pinjaman["total_pinjaman"]; ?></h5><br>
    </div>
        <div class="col-md-12">
            <label for="name" class="form-label text-white">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" value="<?php echo $_SESSION["name"];?>" required readonly>
            <br>
        </div>
        <div class="col-md-12">
            <label for="nominal" class="form-label text-white">Nominal Pengembalian</label>
            <input type="number" class="form-control" onchange="return get_sisa_pinjaman()" id="nominal" name="nominal" value="" onchange="return get_kodeunik()" placeholder="Masukkan Nominal"required>
            <br>
        </div>
        <div class="col-md-12 text-white">
        <label for="sisa_saldo">Sisa Pinjaman : </label>
            <input type="text" class="form-control" id="sisa_pinjaman" name="sisa_pinjaman" value="<?php echo $nominal_pinjaman["total_pinjaman"]; ?>" readonly>
            <input type="hidden" class="form-control" id="sisa_pinjaman_awal" name="sisa_pinjaman_awal" value="<?php echo $nominal_pinjaman["total_pinjaman"]; ?>">
            <br>
        </div>
        <div class="col-md-12 text-white">
        <label for="sisa_saldo">Nominal + Kode Unik (yang harus dibayar) : </label>
            <input type="text" class="form-control" id="kode_unik" name="kode_unik" value="" readonly>
            <br>
        </div>
        <script type="text/javascript">
            function get_sisa_pinjaman(){
                nominal_bayar = document.getElementById("nominal").value;
                nominal_awal = document.getElementById("sisa_pinjaman_awal").value;
                nominal_akhir = nominal_awal-nominal_bayar;
                document.getElementById("sisa_pinjaman").value = nominal_akhir;
                document.getElementById("kode_unik").value = nominal_bayar*1+(Math.floor(Math.random() * 1000) + 100);;
                if (nominal_akhir < 0) {
                    alert("Maaf, Melebihi Nominal Pinjaman");
                    document.getElementById("nominal").value = nominal_awal;
                    document.getElementById("sisa_pinjaman").value = 0;
                }
            }
        </script>
        <div class="col-md-12">
            <label for="confirm_password" class="text-white">Konfirmasi Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Masukkan Password Anda">
            <br>
        </div>
        <div class="col-12">
            <br>
            <button type="submit" class="btn btn-success text-white" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-money-check-alt fa-fw mr-1"></i>Ajukan Pengembalian</button>
        </div>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nominal = $_POST["nominal"];
            $kodeunik = $_POST["kode_unik"];
            $confirm_password = $_POST["confirm_password"];
            $id = $_SESSION["id"];
            $cek_password = mysqli_query($koneksi,"SELECT * FROM user WHERE id = '$id' AND password = '$confirm_password' ");
            $res_password = mysqli_num_rows($cek_password);
            if ($res_password == 0){
                echo "Password yang Anda Masukkan Salah";
            }else{
                $r = mysqli_fetch_array( $cek_password );
                $nama_user = $r["nama_lengkap"];
                $sql = mysqli_query($koneksi,"INSERT INTO konfirmasi_pengembalian(id_pinjaman, id_user, nama_lengkap, nominal, kode_unik, status, tanggal_pengembalian) VALUES ('$id_pinjaman','$id','$nama_user','$nominal','$kodeunik','Menunggu Konfirmasi', NOW())");
                if ($sql){
                    ?>
                    <script type='text/javascript'> 
                    document.location = '/user/form_pengembalian.php';
                    alert("Berhasil Mengajukan Penarikan Simpanan, Menunggu Konfirmasi");
                    </script>;<?php
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