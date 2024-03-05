<?php 
  include "boot.php";
  include "koneksi.php";

?>
  <div class="row	">
    <div class="col-md-12 mt-3">
      <div class="card">
        <div class="card-body">
          
          <form method="post" class="form-inline mb-3">
            <div class="row">
              <div class="col">
              <input type="date" name="tgl_mulai" class="form-control" required>
              </div>
              <div class="col">
                <input type="date" name="tgl_selesai" class="form-control" required>
              </div>
              <div class="col">
                <button type="submit" name="filter_tgl" class="btn btn-info"><b>Filter</b></button>
              </div>
            </div>
          </form>
          
          <hr>
            <div class="row g-3 align-items-center mb-3">
              <div class="col-auto">
                <button class="btn btn-secondary" onclick="printDiv('div1')">
                  <i class="bi bi-printer-fill"></i> Print Data
                </button>
              </div>
            </div>
          <div id="div1">
            <table>
                <tr>
                  <td colspan="2"><h4><b>Semua Pemasukanㅤ: </b></h4></td>
                  <td colspan="2"><h4><b>ㅤRP. 
                    <?php 
                    if(isset($_POST['filter_tgl'])) {
                      $mulai = $_POST['tgl_mulai'];
                      $selesai = $_POST['tgl_selesai'];

                      if($mulai!=null || $selesai!=null) {
                        $total =  mysqli_query($konek, "SELECT SUM(total) AS value_sum FROM keranjang_detail WHERE tgl BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                        $row = mysqli_fetch_assoc($total);
                        $sum = $row['value_sum'];
                        echo $sum;
                      }
                    } else {
                      $total =  mysqli_query($konek, "SELECT SUM(total) AS value_sum FROM keranjang_detail");
                      $row = mysqli_fetch_assoc($total);
                      $sum = $row['value_sum'];
                      echo $sum;
                    }
                    ?>
                </b></h4></td>
                </tr>
            </table>
            <hr>
            <table class="table table-bordered">
              <thead class="table-dark text-center">
                <th scope="col">No</th>
                <th>Kode Pesanan</th>
                <th>Nama</th>
                <th>Qty</th>
                <th>Harga</th>    
                <th>Tanggal</th>
              </thead>
              <?php 

                if(isset($_POST['filter_tgl'])) {
                  $mulai = $_POST['tgl_mulai'];
                  $selesai = $_POST['tgl_selesai'];

                  if($mulai!=null || $selesai!=null) {
                    $tampil = $konek->query("SELECT * FROM keranjang_detail WHERE tgl BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY id DESC");
                  }
                }else {
                  $tampil = $konek->query("SELECT * FROM keranjang_detail");
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