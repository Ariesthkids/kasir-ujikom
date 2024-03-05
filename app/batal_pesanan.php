<?php
include "koneksi.php";
$id = $_GET['id'];
$hapus = $konek->query("delete from keranjang_detail where id ='$id'");
?>
<script>
 document.location.href = 'keranjang.php';
</script>