<?php
	include "koneksi.php";
					
	session_start();

	if (isset($_GET['reset'])) {
		unset($_SESSION['order_code']); 
		header("Location: keranjang.php"); 
		exit();
	}
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
		$tgl = $_POST['tgl'];

		$bilangan1 = $_POST['qty'];
		$bilangan2 = $_POST['harga_produk'];
	
		$total = $bilangan1 * $bilangan2;
	
		$konek -> query ("INSERT INTO keranjang_detail (kode_pesanan, nama_produk, qty, total, tgl) values ('$kode_pesanan', '$nama_produk','$bilangan1','$total','$tgl')");

		$id_pesnan = $konek->insert_id;
	}
?>

<!-- BUKTI PEMBAYARAN -->
<div>
	<div class="row mt-5">
		<div class="col-sm-12">
			<div class="card card-black mb-3">
				<div class="card-body">
					<div class="row g-3 align-items-center mb-3">
						<div class="col-auto">
						    <button class="btn btn-secondary" onclick="printDiv('div1')">
								<i class="bi bi-printer-fill"></i> Print Bukti Pembayaran
							</button>
						</div>
					</div>
					<div id="div1">
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
							</thead>
							<tbody>
								<?php 
								    include "boot.php";
								    include "koneksi.php";

									@$tampil = $konek->query("select*from keranjang_detail where kode_pesanan ='$new_order_code'");

								    while ($s = mysqli_fetch_array($tampil)) {
									    @$no++; 												
								?>
								<tr>
									<th scope="row"><?= $no; ?></th>
									<td><?= $s['nama_produk']?></td> 
									<td><?= $s['qty'] ?></td>
									<td>Rp.<?= $s['total'] ?></td>
									<td><?= $s['tgl'] ?></td>
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

<script>
	function printDiv(el) {
		var a = document.body.innerHTML;
		var b = document.getElementById(el).innerHTML;
		document.body.innerHTML = b;
		window.print();
		document.body.innerHTML = a;
	}
</script>