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
}else{
    header("Location:/");
}
?>

    <div class="col p-4">
    <h2 align="center">Form Peminjaman</h2>
    <div class="container bg-info" style="max-width: 500px;">
            <div class="form-group">
                <label for="name">Nama Lengkap : </label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION["name"];?>" required readonly>
            </div>

            <div class="form-group">
            <label for="nominal">Nominal Pinjaman : </label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="" min="500000" max="10000000" step="100000" onchange="return get_bunga()" placeholder="Masukkan Nominal"required>
            </div>

            <div class="form-group">
            <label for="durasi">Durasi Pinjaman (bulan) : </label>
            <select class="form-control" id="durasi" name="durasi" value="" onchange="return cek_return()" placeholder="Durasi Pinjaman"required>
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
            </div>
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

            <div class="form-group">
            <label for="tanggal_return">Tanggal Pengembalian : </label>
            <input type="text" class="form-control" id="tanggal_return" name="tanggal_return" value="" required readonly>
            </div>

            <div class="form-group">
            <label for="total">Total yang harus dikembalkan (termasuk bunga):</label>
            <input type="text" class="form-control" id="total" name="total" value="<?php echo $r['total_harga']?>" readonly>
            </div>

            <div class="form-group">
            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="text" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Masukkan Password Anda" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-money-check-alt"></i> Pinjam}</button>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id_pesanan = $_POST["pesan"];
            $rekening = $_POST["no"];
            $total_harga = $_POST["total"];
            $poin_lapangan = $_POST["poin"];
            $bonus=$_SESSION["poin"]+$_POST["poin"];
            $bayar = $_POST["wallet"];
            $sql_update = mysqli_query($koneksi,"UPDATE user SET poin= $bonus WHERE id_user=$id");
            $update = mysqli_query($koneksi, $sql_update);
            if ($sql = mysqli_query($koneksi,"INSERT INTO bayar(id_pesanan, id_user, rekening, total_harga,  bayar, status_pesanan,total_poin) VALUES ($id_pesanan, $id, $rekening, $total_harga, '$bayar','pending', '$total_poin')")){
                unset($_SESSION["tgl_main"]);
                unset($_SESSION["jam_main"]);
                echo "Berhasil memesan, menunggu kofirmasi";?>
                <script type='text/javascript'> 
                document.location = 'index.php';
                alert("Silakan Lakukan Pembayaran agar pesanan dapat diproses ;)")
                </script>;
            <?php
            }else {
                echo "error";
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