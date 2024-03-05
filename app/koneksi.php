<?php
    $konek=new mysqli("localhost","root","","kasir_toko") or die ("error");

    if (mysqli_connect_errno()) {
        echo "koneksi gagal" .mysqli_connect_error();
    }
?>