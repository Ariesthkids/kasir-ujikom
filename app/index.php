<?php

session_start();
$user = $_SESSION['user'];
if ($user == "") {
?>
  <script>
    document.location = '../index.php';
  </script>
<?php
} else {
  include "boot.php";

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kasir Mamyami</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>

  <body class="sb-nav-fixed">
    <nav class="text-warning sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand ps-3 text-warning" href="index.php"><i class="bi bi-shop"></i>ㅤMamyami King of Korean Food</a>
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user; ?> <i class="fas fa-user fa-fw"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>

    <div class="row">

      <div class="col">
        <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
              <div class="sb-sidenav-menu">
                <div class="nav mt-3">
                  <a class="nav-link" href="dash.php" target="konten">
                    <div class="sb-nav-link-icon"><i class="bi bi-clipboard2-data-fill"></i></div> Laporan Penjualan
                  </a>
                  <hr>
                  <a class="nav-link" href="pengelolaan_produk.php" target="konten">
                    <div class="sb-nav-link-icon"><i class="bi bi-list-nested"></i></div> Pengelolaan Produk
                  </a>
                  <a class="nav-link" href="keranjang.php" target="konten">
                    <div class="sb-nav-link-icon"><i class="bi bi-cart-fill"></i></div> Keranjang Order
                  </a>
                  <a class="nav-link" href="list_pesanan.php" target="konten">
                    <div class="sb-nav-link-icon"><i class="bi bi-collection-fill"></i></div> List Pesanan
                  </a>
                  <a class="nav-link" href="profil.php" target="konten">
                    <div class="sb-nav-link-icon"><i class="bi bi-person-lines-fill"></i></div> Profil
                  </a>
                </div>
              </div>
              <div class="sb-sidenav-footer mb-3">
                <div class="small">Nurhilmi</div> ig. @404n0t.f0und_
              </div>
            </nav>
          </div>
          <div id="layoutSidenav_content">

            <main>
              <div class="container-fluid px-4">
                <iframe src="dash.php" frameborder="0" name="konten" width="100" style="width:100%; height:100vh;"></iframe>
            </main>

          </div>
        </div>


      </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
  </body>

  </html>
<?php
}
?>