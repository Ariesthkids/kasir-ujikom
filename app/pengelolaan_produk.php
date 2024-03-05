
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Korean Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="beranda.css">

    <style>
      .form-group {
        width: 500px;
      }
    </style>

  </head>

  <body>
    <div class="row mt-5">
      <div class="col-sm-12">
        <div class="card card-black mb-3">
          <div class="card-body">
            <div class="row mt-3 mb-3">
              <div class="col-3">
                <div class="text">
                  <a class="btn btn-success" href="input_barang.php">ㅤ Tambahkan Produk ㅤ</a>
                </div>
              </div>
              <div class="col">
                <form action="" method="post">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name="cari" class="form-control">
                      <button type="submit" name="search" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <table class="table table-bordered">
              <thead class="table-dark">
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Detail</th>    
                <th scope="col">Gambar</th>
                <th scope="col">Action</th>
              </thead>

              <tbody>
                <?php
                  include "koneksi.php";

                  if (isset($_POST['search'])){
                    $cari = $_POST ['cari'];
                    $tampil = $konek->query("select*from menu where nama_produk like '%$cari%'");
                  }else {
                    $tampil = $konek->query("select*from menu");
                  }
                  while ($s= mysqli_fetch_array($tampil)) {
                    @$no++;
                  ?>

                <tr>
                  <th scope="row"><?= $no; ?></th>
                  <td><?= $s['kode_barang'] ?></td>
                  <td><?= $s['nama_produk'] ?></td>
                  <td>Rp. <?= $s['harga'] ?></td>
                  <td><?= $s['detail'] ?></td>
                  <td><img src="img/<?= $s['gambar'];?>" alt="..." width="100" ?></td>
                  <td>
                    <button class="btn btn-danger" onclick="konfirmasiHapus(<?= $s['id'] ?>)"><i class="bi bi-trash3"></i></button>
                    <button class="btn btn-success" onclick="document.location.href='edit_produk.php?id=<?= $s['id'] ?>'"><i class="bi bi-pencil-square"></i></button>
                  </td>
                </tr>
              </tbody>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
      function konfirmasiHapus(id) {
        if (confirm("Apakah Anda yakin ingin menghapus?")) {
          window.location.href = 'hapus_produk.php?id=' + id;
        }
      }
    </script>

  </body>
</html>