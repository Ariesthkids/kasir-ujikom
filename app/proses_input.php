<?php 
 include  "koneksi.php";

$kode_barang = $_POST['kode_barang'];
$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$detail = $_POST['detail'];
$gambar = $_FILES ['gambar']['name'];
$file_tmp = $_FILES ['gambar']['tmp_name'];

move_uploaded_file($file_tmp, 'img/'.$gambar);

$konek -> query ("INSERT INTO menu (kode_barang, nama_produk, harga, detail, gambar) values ('$kode_barang','$nama','$harga','$detail','$gambar')");


?>

<script>
 document.location.href = 'pengelolaan_produk.php';
</script>