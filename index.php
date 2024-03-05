<!doctype html>
<html lang="en">
  <head>
  	<title>Login Kasir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section text-bold">Login Kasir Mamyami</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/bg-1.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
			      		<div class="d-flex">
			      			<div class="w-100">
			      				<h3 class="mb-4">Sign In</h3>
			      			</div>
			      		</div>

						<form action="" class="signin-form" method="post">
							<div class="form-group mb-3">
								<label class="label" for="name">Username</label>
								<input type="text" class="form-control" placeholder="Username" name="user" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">Password</label>
								<i class="bi bi-eye-slash-fill"></i>
								<input type="password" class="form-control" placeholder="Password"  name="pass" required>
							</div>
							<div class="form-group">
								<button type="submit" name="login" class="form-control btn btn-dark bg-dark text-light rounded submit px-3">Sign In</button>
							</div>
		          		</form>
		        	</div>
		      	</div>
				</div>
			</div>
		</div>
</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

<?php
session_start();
if (isset($_POST['login'])) {
 include "app/koneksi.php";
 $user = $_POST['user'];
 $pass = $_POST['pass'];

 $cari = $konek->query("select * from login where user='$user' and pass='$pass'");
 @$cek = $cari->num_rows;
 if ($cek == 0) {
  echo "maaf data pass/user tidak ditemukan";
 }else {
  $_SESSION['user'] = $user;
?>
 <script>
  document.location.href = 'app/index.php';
 </script>
<?php
 }
}
?>

