<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id"]) AND isset($_GET["id_iuran"])) {
    $id_iuran = $_GET["id_iuran"];
    $sql = mysqli_query($koneksi,"UPDATE data_iuran SET status = 'Menunggu Konfirmasi' WHERE id_iuran = '$id_iuran' ");
    if ($sql) {?>
        <script>
            alert("Silakan lakukan pembayaran sesuai kode unik agar pembayaran dapat dikonfirmasi");
            document.location = '/user/list_iuran.php';
        </script><?php
    }
}else{
    header("Location:/");
}
?>