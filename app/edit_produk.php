<?php
include "koneksi.php";
include "boot.php";
$id = $_GET['id'];
$panggil = $konek->query("select*from menu where id='$id'");
$a = $panggil->fetch_array();

?>

<div class="mt-3">
    <form class="form-control mt-3 bg-black-50 text-dark" method = "post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="" name="nama_produk" value="<?= $a['nama_produk'] ?>">

        <label for="" class="form-label">Harga</label>
        <input type="number" class="form-control" name="harga" value="<?= $a['harga'] ?>">

        <label for="" class="form-label">Details</label>
        <input type="text" class="form-control" id="" name="detail" value="<?= $a['detail'] ?>">

        <div class="text-end">
            <button type="submit" class="btn btn-success mt-3 ">Edit</button>
            <a href="javascript:history.go(-1)" class="btn btn-primary mt-3">Back</a>
        </div>
    </form>
</div>

<?php
 
 if (!isset($_POST['edit'])) {
 }
    @$ubah = $konek->query("update menu set nama_produk='$_POST[nama_produk]', harga='$_POST[harga]', detail='$_POST[detail]' where id='$id'");
?>