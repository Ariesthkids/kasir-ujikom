<?php
 
    include "boot.php";
    include "koneksi.php";
?>

<div class="row container">
	<div class="col-md-12 mt-5">
         <div class="card">
			<div class="card-header bg-dark text-light">
				<h4>Data Semua Transaksi</h4>
			</div>
            <div class="card-body">
				<form action="" method="post" class="form-inline mb-3">
					<div class="row">
						<div class="col">
							<input type="date" name="tgl_mulai" class="form-control">
						</div>
						<div class="col">
							<input type="date" name="tgl_selesai" class="form-control">
						</div>
						<div class="col">
							<button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>
						</div>
					</div>
				</form>
                <hr>

				<div id="div1">
					<div class="row g-3 align-items-center mb-5">
						<div class="col-auto">
							<button class="btn btn-secondary" onclick="printDiv('div1')">
								<i class="bi bi-printer-fill"></i> Print Data
							</button>
						</div>
					</div>
					<table class="table table-bordered">
						<thead class="table-dark text-center">
							<th scope="col">No</th>
							<th>Nama</th>
							<th>Kode Pesanan</th>
							<th>Qty</th>
							<th>Harga</th>    
							<th>Tanggal</th>
						</thead>
						<?php 
							include "boot.php";
							include "koneksi.php";

							if(isset($_POST['filter_tgl'])) {
								$mulai = $_POST['tgl_mulai'];
								$selesai = $_POST['tgl_selesai'];

								if($mulai!=null || $selesai!=null) {
									$tampil = $konek->query("select*from keranjang where tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY) order by id desc");
								}
							}else {
								$tampil = $konek->query("select*from keranjang");
							}
							while ($s= mysqli_fetch_array($tampil)) {
								@$no++;
						?>

						</tbody>
							<tr>
								<th scope="row"><?= $no; ?></th>
								<td><?= $s['kode_pesanan'] ?></td>
								<td><?= $s['nama_produk']?></td>
								<td><?= $s['qty']?></td>
								<td>Rp.<?= $s['total'] ?></td>
								<td><?= $s['tanggal'] ?></td>
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