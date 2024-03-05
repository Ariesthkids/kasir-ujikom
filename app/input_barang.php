
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uplod</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="card mt-3">
      <div class="card-header bg-dark text-light">
        <h1 class="text-center mt-3 mb-3">Silahkan tambahkan produk baru :</h1>
      </div>
      <?php
        include "koneksi.php";
        $tgl=date("d");
        $kode=$konek->query("select*from menu order by id desc");
        $kod=$kode->fetch_array();
      ?>

      <div class="card-body">
        <form enctype="multipart/form-data" method="post" action="proses_input.php">
            <div class="mb-3 mt-3">
                <label for="" class="form-label">Kode Produk</label>
                <input type="text" class="form-control" value="KING<?=@$kod['id']+1 ,$tgl; ?>" name="kode_barang" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" placeholder="ketik disini...." required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Harga Produk</label>
                <input type="number" min="1" name="harga" placeholder="ketik disini...." required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Details</label>
                <input type="text" class="form-control" name="detail" placeholder="ketik disini...." required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Input File </label>
                <input class="form-control" type="file" id="formFile" name="gambar" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3 mb-3 ">Simpan</button>
            </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>