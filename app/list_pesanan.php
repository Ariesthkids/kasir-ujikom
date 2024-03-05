<?php
 include "boot.php";
 include "koneksi.php";
?>
<div class="row">
	<h2 class="mt-3">List Semua Pesanan</h2>
	<hr>
	<div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
				<table class="table table-bordered">
					<th><h4>Cari Kode Pesanan</h4></th>
					<th>
						<form action="" method="post">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="cari" class="form-control">
									<div class="group-prepend">
										<button type="submit" name="search" class="btn"></button>
									</div>
								</div>
							</div>
						</form>
					</th>
				</table>
				<table class="table table-bordered">
					<thead class="table-dark text-center">
						<th scope="col">No</th>
						<th>Nama</th>
						<th>Kode Pesanan</th>
						<th>Qty</th>
						<th>Harga</th>    
						<th>Tanggal</th>
						<th>Aksi</th>
					</thead>
					<?php 
						include "koneksi.php";

						if (isset($_POST['search'])) {
							$cari = $_POST['cari'];
							$tampil = $konek->query("select*from keranjang_detail where kode_pesanan like '%$cari%'");
						} else {
							$tampil = $konek->query("select*from keranjang_detail");
						}
						while ($s = mysqli_fetch_array($tampil)) {
							@$no++;
						?>

					</tbody>
						<tr>
							<th scope="row"><?= $no; ?></th>
							<td><?= $s['kode_pesanan'] ?></td>
							<td><?= $s['nama_produk']?></td>
							<td><?= $s['qty']?></td>
							<td>Rp. <?= $s['total'] ?></td>
							<td><?= $s['tgl'] ?></td>
							<td><button class="btn btn-danger" onclick="confirmDelete(<?= $s['id'] ?>)">
        						<i class="bi bi-trash3"></i>
    							</button>
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
 <script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus pesanan ini?")) {
            window.location.href = 'hapus_pesanan.php?id=' + id;
        }
    }
</script>