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
            width: 250px;
        }
        .sidebar-collapsed {
            width: 100px;
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
    $sql = mysqli_query($koneksi,"SELECT COUNT(*) FROM user");
    $anggota = mysqli_fetch_array( $sql );
    $sql = mysqli_query($koneksi,"SELECT SUM(iuran_wajib) FROM user");
    $iuran_wajib = mysqli_fetch_array( $sql );
    $sql = mysqli_query($koneksi,"SELECT SUM(simpanan_sukarela) FROM user");
    $saldo_simpanan = mysqli_fetch_array( $sql );
    $sql = mysqli_query($koneksi,"SELECT SUM(total_pinjaman)  FROM pinjaman WHERE status = 'Belum Lunas'");
    $pinjaman = mysqli_fetch_array( $sql );
    $sql = mysqli_query($koneksi,"SELECT nominal FROM inventaris WHERE id = '1' AND keterangan = 'Saldo'");
    $saldo = mysqli_fetch_array( $sql );
    $sql = mysqli_query($koneksi,"SELECT nominal FROM inventaris WHERE id = '2' AND keterangan = 'SHU'");
    $shu = mysqli_fetch_array( $sql );

    // $get_saldo = mysqli_query($koneksi,"SELECT SUM(iuran_wajib+simpanan_sukarela) FROM user");
    // $res_saldo = mysqli_fetch_array( $get_saldo );
    // $saldo_koperasi =  $res_saldo[0];
    // $update_saldo  = mysqli_query($koneksi,"UPDATE inventaris SET nominal = '$saldo_koperasi'  WHERE id = '1' AND keterangan = 'Saldo' ");
}else{
    header("Location:/");
}
?>
    <div class="col p-4">
        <h1 class="display-4" align="center">Selamat Datang di Dashboard Admin<br> Koperasi Simpan Pinjam Sejahtera Bersama</h1><br>
            <div class="row">
                    <div class="col-sm-3">
                        <div class="card border-success mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-success border-success text-white"><h5>Anggota</h5></div>
                                <div class="card-body text-success">
                                    <h5 class="card-title"><?php echo $anggota[0]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-success">
                                <a href="/admin/data_user.php" class="btn btn-outline-success" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-danger mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-danger border-danger text-white"><h5>Iuran Wajib</h5></div>
                                <div class="card-body text-danger">
                                    <h5 class="card-title">Rp. <?php echo $iuran_wajib[0]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-danger">
                                <a href="/admin/data_iuran.php" class="btn btn-outline-danger" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-info mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-info border-info text-white"><h5>Simpanan</h5></div>
                                <div class="card-body text-info">
                                    <h5 class="card-title">Rp. <?php echo $saldo_simpanan[0]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-info">
                                <a href="/admin/data_simpanan.php" class="btn btn-outline-info" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-secondary mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-secondary border-secondary text-white"><h5>Pinjaman</h5></div>
                                <div class="card-body text-secondary">
                                    <h5 class="card-title">Rp. <?php echo $pinjaman[0]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-secondary">
                                <a href="/admin/data_pinjaman.php" class="btn btn-outline-secondary" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>
                    </div><br>
                    <div class="col-sm-3">
                        <div class="card border-primary mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-primary border-primary text-white"><h5>SHU</h5></div>
                                <div class="card-body text-primary">
                                    <h5 class="card-title">Rp. <?php echo $shu["nominal"]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-primary">
                                <a href="/admin/data_shu.php" class="btn btn-outline-primary" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);"><i class="fas fa-info-circle fa-fw mr-1"></i>Lihat Detail</a>
                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-warning mb-4" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
                            <div class="card-header bg-warning border-warning text-white"><h5>Saldo Koperasi</h5></div>
                                <div class="card-body text-warning">
                                    <h5 class="card-title">Rp. <?php echo $saldo["nominal"]?></h5>
                                </div>
                            <div class="card-footer bg-transparent border-warning" style="height:65px;">
                            <br>
                            </div>
                        </div>  
                    </div>
            </div>
            </div>
            </div>
    </div><!-- Main Col END -->
</div><!-- body-row END --> 
<?php
    $sql = mysqli_query($koneksi,"SELECT nominal FROM inventaris WHERE id = '3' AND keterangan = 'Bulan Iuran'");
    if($sql){
        $get_bulan_iuran_now = mysqli_fetch_array( $sql );
        $bulan_iuran_now = $get_bulan_iuran_now["nominal"];
        $tahun_iuran_now = date("Y");
        $bulan_now = date("n");
        if($bulan_now == 1 AND $bulan_iuran_now == 0){
            $sql1 = mysqli_query($koneksi,"SELECT * FROM user");
            while ( $r = mysqli_fetch_array( $sql1 ) ) {
                $id = $r["id"];
                $nama = $r["nama_lengkap"];
                $bulan_iuran_now = 1;
                $kode_unik = mt_rand(7, 999)+100000;
                $sql2 = mysqli_query($koneksi,"INSERT INTO data_iuran(id_user, nama_lengkap, nominal, kode_unik, status, bulan_iuran, tahun_iuran, tanggal_dibayar) VALUES('$id','$nama','100000','$kode_unik','Belum Dibayar','$bulan_iuran_now', '$tahun_iuran_now', '')");

            }
            $bulan_iuran_now = 1;
            $sql = mysqli_query($koneksi,"UPDATE inventaris SET nominal = '$bulan_iuran_now' WHERE id = '3' AND keterangan = 'Bulan Iuran'");
        }else if($bulan_now == 12 AND $bulan_iuran_now == 12){
            $sql1 = mysqli_query($koneksi,"SELECT * FROM data_iuran WHERE bulan_iuran = '12' AND tahun_iuran = '$tahun_iuran_now' ");
            if (mysqli_num_rows($sql1) >=  1){

            }else {
            $sql1 = mysqli_query($koneksi,"SELECT * FROM user");
            while ( $r = mysqli_fetch_array( $sql1 ) ) {
                $id = $r["id"];
                $nama = $r["nama_lengkap"];
                $bulan_iuran_now = 12;
                $kode_unik = mt_rand(7, 999)+100000;
                $sql2 = mysqli_query($koneksi,"INSERT INTO data_iuran(id_user, nama_lengkap, nominal, kode_unik, status, bulan_iuran, tahun_iuran, tanggal_dibayar) VALUES('$id','$nama','100000','$kode_unik','Belum Dibayar','$bulan_iuran_now', '$tahun_iuran_now', '')");

            }
            $sql = mysqli_query($koneksi,"UPDATE inventaris SET nominal = '$bulan_iuran_now' WHERE id = '3' AND keterangan = 'Bulan Iuran'");
            }
        }else if($bulan_now == 1 AND $bulan_iuran_now == 12){
            $sql1 = mysqli_query($koneksi,"SELECT * FROM user");
            while ( $r = mysqli_fetch_array( $sql1 ) ) {
                $id = $r["id"];
                $nama = $r["nama_lengkap"];
                $bulan_iuran_now = 1;
                $kode_unik = mt_rand(7, 999)+100000;
                $sql2 = mysqli_query($koneksi,"INSERT INTO data_iuran(id_user, nama_lengkap, nominal, kode_unik, status, bulan_iuran, tahun_iuran, tanggal_dibayar) VALUES('$id','$nama','100000','$kode_unik','Belum Dibayar','$bulan_iuran_now', '$tahun_iuran_now', '')");

            }
            $sql = mysqli_query($koneksi,"UPDATE inventaris SET nominal = '$bulan_iuran_now' WHERE id = '3' AND keterangan = 'Bulan Iuran'");

        }else if($bulan_now >= $bulan_iuran_now){
            if ($bulan_iuran_now == 0){
                $bulan_iuran_now = 1;
            }
            $sql1 = mysqli_query($koneksi,"SELECT * FROM user");
            while ( $r = mysqli_fetch_array( $sql1 ) ) {
                $id = $r["id"];
                $nama = $r["nama_lengkap"];
                $kode_unik = mt_rand(7, 999)+100000;
                $sql2 = mysqli_query($koneksi,"INSERT INTO data_iuran(id_user, nama_lengkap, nominal, kode_unik, status, bulan_iuran, tahun_iuran, tanggal_dibayar) VALUES('$id','$nama','100000','$kode_unik','Belum Dibayar','$bulan_iuran_now', '$tahun_iuran_now', '')");

            }
            $bulan_iuran_now += 1;
            $sql = mysqli_query($koneksi,"UPDATE inventaris SET nominal = '$bulan_iuran_now' WHERE id = '3' AND keterangan = 'Bulan Iuran'");

        }

    }
    echo mt_rand(7, 999);
?>
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