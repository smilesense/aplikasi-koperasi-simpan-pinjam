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
    <h1 class="display-4" align="center">Form Pinjaman</h1><br>
    <div class="container bg-warning" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
    <form class="row g-3" action="" method="POST">
        <div class="col-md-12">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" value="<?php echo $_SESSION["name"];?>" required readonly>
            <br>
        </div>
        <div class="col-md-12">
            <label for="nominal" class="form-label">Nominal Pinjaman</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="" min="500000" max="10000000" step="100000" onchange="return get_bunga()" placeholder="Masukkan Nominal"required>
            <br>
        </div>
        <div class="col-12">
            <label for="durasi" class="form-label">Durasi Pinjaman (bulan)</label>
            <select class="form-control" id="durasi" name="durasi" onchange="return cek_return()" placeholder="Durasi Pinjaman"required>
                <option value="">Silakan Pilih Durasi Pinjaman</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="9">9 Bulan</option>
                <option value="12">12 Bulan</option>
                <option value="15">15 Bulan</option>
                <option value="18">18 Bulan</option>
                <option value="21">21 Bulan</option>
                <option value="24">24 Bulan</option>
            </select>
            <script type="text/javascript">

                function get_bunga(){
                    durasi = document.getElementById("durasi").value;
                    nominal = document.getElementById("nominal").value;

                    document.getElementById("total").value = (nominal*1+((nominal*2.5)/100)*durasi);
                }
                function cek_return(){
                    durasi = document.getElementById("durasi").value;
                    nominal = document.getElementById("nominal").value;

                    var myDate = new Date(new Date().getTime()+((durasi*30)*24*60*60*1000)).toLocaleDateString();

                    document.getElementById("tanggal_return").value = myDate;
                    document.getElementById("total").value = (nominal*1+((nominal*2.5)/100)*durasi);
                }
            </script>
            <br>
        </div>
        <div class="col-md-12">
            <label for="tanggal_return" class="form-label">Tanggal Pengembalian</label>
            <input type="text" class="form-control" id="tanggal_return" name="tanggal_return" value="" required readonly>
            <br>
        </div>
        <div class="col-md-12">
        <label for="total">Total yang harus dikembalkan (termasuk bunga):</label>
            <input type="text" class="form-control" id="total" name="total" value="<?php echo $r['total_harga']?>" readonly>
            <br>
        </div>
        <div class="col-md-12">
            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Masukkan Password Anda">
            <br>
        </div>
        <div class="col-12">
            <br>
            <button type="submit" class="btn btn-danger" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-money-check-alt fa-fw mr-1"></i>Ajukan Pinjaman</button>
        </div>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_SESSION["id"];
            $nominal = $_POST["nominal"];      
            $bunga = ($_POST["total"]-$nominal);
            $confirm_password = $_POST["confirm_password"];
            $tanggal_return = $_POST["tanggal_return"];
            $cek_password = mysqli_query($koneksi,"SELECT * FROM user WHERE id = '$id' AND password = '$confirm_password' ");
            $res_password = mysqli_num_rows($cek_password);
            $r = mysqli_fetch_array( $cek_password );
            $norek = $r["no_rekening"];
            if ($res_password == 0){
                echo "Password yang Anda Masukkan Salah";
            }else{
                if ($norek == '' || $norek == 0){
                    echo "Anda belum mengisi nomor rekening, silakan isi pada menu profile";
                }else{
                    $cek_saldo_koperasi  = mysqli_query($koneksi,"SELECT * FROM inventaris WHERE id = '1' AND keterangan = 'Saldo' ");
                    $s = mysqli_fetch_array( $cek_saldo_koperasi );
                    $saldo_koperasi = $s["nominal"];
                    if ($saldo_koperasi < $nominal){
                        echo "maaf, saldo koperasi saat ini kurang dari nominal yang anda pinjam. Silakan masukkan nominal yang lebih kecil<br>Sisa saldo Koperasi : $saldo_koperasi";
                    }else{
                        $nama_user = $r["nama_lengkap"];
                        $total = ($nominal)+($bunga);
                        $durasi = $_POST["durasi"];
                        $sql = mysqli_query($koneksi,"INSERT INTO pinjaman(id_user, nama_lengkap, nominal, bunga, total_pinjaman, lama_pinjaman, jatuh_tempo, no_rekening, status) VALUES ('$id','$nama_user' ,'$nominal', '$bunga' , '$total','$durasi', '$tanggal_return', '$norek', 'Menunggu Persetujuan')");
                        if ($sql){
                            echo "Berhasil Berhasil Mengajukan Pinjaman";
                        }else {
                            echo "error";
                        }
                }   }
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