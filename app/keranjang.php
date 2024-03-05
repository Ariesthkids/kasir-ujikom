<?php
include "boot.php";
session_start();

if (isset($_GET['reset'])) {
	unset($_SESSION['order_code']); 
	header("Location: keranjang.php"); 
	exit();
}

?>

<div class="">
	<div class="row mt-3">

	<!--Tabel Pertama-->

		<div class="col-sm-12">
			<div class="card card-black mb-3">
				<div class="card-header bg-black text-white">
					<h5>Tabel Barang</h5>
				</div>
				<div class="card-body">
					<form action="" method="GET" class="mb-3">
						<div class="input-group">
							<input type="text" name="search" class="form-control" placeholder="Search for food name">
							<button type="submit" class="btn btn-primary">Search</button>
						</div>
					</form>
					<table class="table table-bordered">
						<thead>
							<th>No</th>
							<th>Kode Barang</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Gambar</th>
							<th>Action</th>
						</thead>
						<?php
							include "koneksi.php";

							$search = isset($_GET['search']) ? $_GET['search'] : '';
							$query = "SELECT * FROM menu";
							if (!empty($search)) {
								$query = "SELECT * FROM menu WHERE nama_produk LIKE '%$search%'";
							}
							
							$tampil = $konek->query($query);
							while ($s = mysqli_fetch_array($tampil)) {
								@$no++;
						?>

						<tbody>
							<tr>
								<th scope="row"><?= $no; ?></th>
								<td><?= $s['kode_barang'] ?></td>
								<td><?= $s['nama_produk'] ?></td>
								<td>Rp. <?= $s['harga'] ?></td>
								<td><img src="img/<?= $s['gambar']; ?>" alt="..." width="50"></td>
								<td>						
									<button onclick="document.location='?idb=<?=$s['kode_barang']?>'" class="btn btn-success" type="submit">
										<i class="bi bi-cart-plus-fill"> Keranjang</i>
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
	
	<!-- Akhir Tabel Pertama-->


	<!--Awal Tabel Bayar-->
		<div class="col-sm-12 mb-5">
			<div class="card card-black">
				<div class="card-header bg-black text-white">
					<h5> Tabel Bayar</h5>
				</div> 

				<?php

					date_default_timezone_set('Asia/Jakarta');
					include "koneksi.php";

					if (!isset($_SESSION['order_code'])) {
						$kode=$konek->query("select * from keranjang_detail order by id desc");
						$kod=$kode->fetch_array();
							
						$new_order_code = "PESANAN" . ($kod['id'] + 1);
							
						$_SESSION['order_code'] = $new_order_code;
					} 
					else {  
						$new_order_code = $_SESSION['order_code'];
					}
						
					if(isset($_GET['idb'])) {
						@$kodeb=$konek->query("select*from menu where kode_barang like '$_GET[idb]'");
						$kodb=$kodeb->fetch_array();
					}
					if ($_SERVER["REQUEST_METHOD"] == "POST") {

						$kode_pesanan = $_POST['kode_pesanan'];
						$nama_produk = $_POST['nama_produk'];
						$tgl = date("Y-m-d H:i:s");
	
						$bilangan1 = $_POST['qty'];
						$bilangan2 = $_POST['harga_produk'];
	
						$total = $bilangan1 * $bilangan2;
	
						$konek -> query ("INSERT INTO keranjang_detail (kode_pesanan, nama_produk, qty, total, tgl) values ('$kode_pesanan', '$nama_produk','$bilangan1','$total','$tgl')");

						$id_pesnan = $konek->insert_id;
					}
				?>

				<!--FORM UNTUK BAYAR-->

				<form action="" method="post">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td><b>Tanggal</b></td>
									<td>
										<input type="text" readonly="readonly" class="form-control" value="<?php echo date("Y-m-d H:i:s"); ?>" name="tgl">
									</td>
								</tr>
								<tr>
									<td><b>Kode Pesanan</b></td>
									<td>
										<input type="text" name="kode_pesanan" id="" readonly class="form-control"  value="<?php echo $new_order_code; ?>">
										<input type="hidden" name="order_code" value="<?php echo $new_order_code; ?>">
									</td>
								</tr>
							</table>
							<table class="table table-bordered w-100 mb-2" id="example1">
								<thead>
									<tr>
										<td> Nama</td>
										<td> Qty</td>
										<td> Harga</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td> <input type="text" class="btn" name="nama_produk" value="<?=@$kodb['nama_produk']?>" required></td>
										<td>
											<input type="number" name="qty" required>
										</td>
										<td>Rp. <input type="text" class="btn" name="harga_produk" value="<?=@$kodb['harga']?>" required></td>
									</tr>
								</tbody>
							</table>
							<div class="row g-3 align-items-center mb-2">
								<div class="col-auto">
									<button class="btn btn-success" type="submit"> + Tambah </button>
								</div>
								<div class="col-auto">
									<button class="btn btn-danger" type="reset" onclick="document.location.href='keranjang.php?reset'">Reset</button>
								</div>
							</div>
						</div>
					</div>
				</form>

				<!--AKHIR FORM BAYAR-->

				<!-- BUKTI PEMBAYARAN -->
					<div class="row mt-5">
						<div class="col-sm-12">
							<div class="card card-black mb-3">
								<div class="card-body">
									<div class="row g-3 align-items-center mb-3">
										<div class="col-auto">
											<a href="bukti.php">
												<button class="btn btn-warning">
													Print Bukti Pembayaran
												</button>
											</a>
										</div>
									</div>
										<table class="table table-bordered table-dark text-warning">
											<th class="text-warning"><h4>Code Pesanan/Nomor Pesanan</h4></th>
											<th class="text-warning"><h4><?= $new_order_code ?></h4></th>
										</table>
										<table>
											<th><h4>Total Semuanya : </h4></th>
											<td colspan="2"> <h4> RP. 
												<?php 
												$total =  mysqli_query($konek, "SELECT SUM(total) AS value_sum FROM keranjang_detail  WHERE kode_pesanan = '$new_order_code'");
												$row = mysqli_fetch_assoc($total);
												$sum = $row['value_sum'];
												?>
                								<?php echo $sum ?></h4>
											</td>
										</table>
										<table class="table table-bordered">
											<thead>
												<th scope="col">No</tH>
												<th>Nama Produk</th>
												<th>Qty</th>
												<th>Total</th>
												<th>Tanggal</th>
												<th>Aksi</th>
											</thead>
											<tbody>
											<?php 
												include "boot.php";
												include "koneksi.php";

												$no = 0; // Initialize $no here

												@$tampil = $konek->query("select * from keranjang_detail where kode_pesanan ='$new_order_code'");

												while ($s = mysqli_fetch_array($tampil)) {
													$no++; 
											?>
												<tr>
													<th scope="row"><?= $no; ?></th>
													<td><?= $s['nama_produk']?></td> 
													<td><?= $s['qty'] ?></td>
													<td>Rp.<?= $s['total'] ?></td>
													<td><?= $s['tgl'] ?></td>
													<td>
														<button class="btn btn-danger" onclick="konfirmasiHapus(<?= $s['id'] ?>)">Batal</button>
													</td>
												</tr>
												<?php
    													}
												?>
											</tbody>
										</table>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
<script>
      function konfirmasiHapus(id) {
        if (confirm("Apakah Anda yakin ingin membatalkan pesanan?")) {
          window.location.href = 'batal_pesanan.php?id=' + id;
        }
      }
</script>


