<?php
session_start();
include "../connect_db.php";
if (isset($_SESSION["id_admin"])){
    if ($_GET["bagi_shu"] == '99201928'){?>
        <?php
            $search = $_GET["search"];
            $sql = mysqli_query($koneksi,"SELECT * FROM user ");
            while ( $r = mysqli_fetch_array( $sql ) ){?>
                <?php
                    $id = $r["id"];
                    $nama = $r["nama_lengkap"];
                    $sql1 = mysqli_query($koneksi,"SELECT nominal FROM inventaris WHERE id = '2' AND keterangan = 'SHU' ");
                    $get_total_shu = mysqli_fetch_array( $sql1 );
                    $total_shu = $get_total_shu["nominal"];
                    $shu_pinjaman = $total_shu*40/100;
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

                    $sql1 = mysqli_query($koneksi,"SELECT SUM(nominal) FROM pinjaman WHERE id_user = '$id' AND status = 'Lunas' ");
                    $get_pinjaman_user = mysqli_fetch_array( $sql1 );
                    $pinjaman_user = $get_pinjaman_user[0];
                    if($sql1){
                        $sql2 = mysqli_query($koneksi,"UPDATE pinjaman SET status = 'Lunas_' WHERE id_user = '$id'");
                    }
                    

                    $shu_simpanan_user = ($simpanan_user/$total_simpanan)*(($shu_simpanan/$total_shu)*$total_shu);
                    $shu_pinjaman_user = ($pinjaman_user/$total_pinjaman)*(($shu_pinjaman/$total_shu)*$total_shu);
                    $shu_user = $shu_simpanan_user+$shu_pinjaman_user;

                    $riwayat_pembagian_shu = mysqli_query($koneksi,"INSERT INTO riwayat_pembagian_shu(id_user, nama_lengkap, nominal, tanggal_dibagikan) VALUES('$id', '$nama', '$shu_user', NOW())");
                    if($riwayat_pembagian_shu){
                        $update_saldo_shu = mysqli_query($koneksi,"UPDATE user SET shu = (shu+('$shu_user')) WHERE id = '$id' ");
                    };

                    $jumlah_shu+= $shu_user;
            
                };
            $update_saldo_shu_koperasi = mysqli_query($koneksi,"UPDATE inventaris SET nominal = (nominal-('$jumlah_shu')) WHERE id = '2' AND keterangan = 'SHU' ");
            $update_saldo_koperasi = mysqli_query($koneksi,"UPDATE inventaris SET nominal = (nominal-('$jumlah_shu')) WHERE id = '1' AND keterangan = 'Saldo' ");
            if($update_saldo_shu_koperasi){
                header("Location: /admin/data_shu.php");
            }
    }else{
        header("Location:/");
    }
}else{
    header("Location:/");
}
?>
