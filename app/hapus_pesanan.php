<?php
include "koneksi.php";
$id = $_GET['id'];
$hapus = $konek->query("DELETE FROM keranjang_detail WHERE id = '$id'");
?>
<script>
 document.location.href = 'list_pesanan.php';
</script>