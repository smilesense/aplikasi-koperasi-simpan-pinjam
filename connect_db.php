<?php
$koneksi = mysqli_connect("localhost","sbd","123ss");
    if(!($koneksi)){
        echo "<script language=\"javascript\">\n";
        echo "alert(\"Tidak bisa terkoneksi dengan database...\");\n";
        echo "</script>";
        die;
    }else{
        $select = mysqli_select_db($koneksi, "project_pemdesk");
        //echo "Sukses";
    }
?>