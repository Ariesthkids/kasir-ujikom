<?php 
 include  "koneksi.php";

$kode_pesanan = $_POST['kode_pesanan'];
$nama_produk = $_POST['nama_produk'];
$tgl = $_POST['tgl'];


$bilangan1 = $_POST['qty'];
$bilangan2 = $_POST['harga_produk'];

$total = $bilangan1 * $bilangan2;



$konek -> query ("INSERT INTO keranjang_detail (kode_pesanan, nama_produk, qty, total, tgl) values ('$kode_pesanan', '$nama_produk','$bilangan1','$total','$tgl')");


?>

<script>
 document.location.href = 'keranjang.php';
</script>