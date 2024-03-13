<?php
// echo md5("admin@nysc");
require "incs/server.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/icon type" href="images/NYSC_LOGO.svg">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome-all.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<title>Sign Up</title>
	<style type="text/css">
		body{
			background: linear-gradient(#fff, rgba(0,0,0,0.5)), url("images/NYSC.webp");
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
			background-position: center;
		}
		.img_header{text-align: center; margin-top: 20px; margin-bottom: 60px}
		.card{
			margin: auto;
			max-width: 40%;
		}
		label{font-weight: bold; color: brown}
		footer{
			position: absolute;
			bottom: 0;
			width: 100%;
			padding: 10px;
			background: darkgreen;
			color: #fff;
			font-size: 14px;
			border-top: 5px solid darkred;
		}
		@media screen and (max-width: 700px){
			.card{max-width: 95%}
			.logo{width: 100%}
		}
	</style>
</head>
<body>

<div class="container">
	<div class="main_box">
		<div class="img_header">
			<img src="images/banner1.png" class="logo">

		</div>
		<div class="text-center">
			<?php
				foreach($err as $error => $errs){
					echo "<div class = 'alert alert-danger'>
						<b>$errs</b>
					</div>";
				}
			?>
		</div>
		<div class="card">
			<div class="card-body">
				<form accept="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
					<div class="form-group">
						<label>
							<span class="fa fa-envelope"></span> Email Address
						</label>
						<input type="text" name="email" placeholder="example@gmail.com" class="form-control" required>
					</div>
					<div class="form-group">
						<label>
							<span class="fa fa-lock"></span> password
						</label>
						<input type="password" name="password" placeholder="********" class="form-control" required>
					</div>
					<div class="form-group">
						<label>
							Login As
						</label>
						<select class="form-control" name="order">
							<option value="admin">Admin</option>
							<option value="corper">Corper</option>
						</select>
					</div>
					<div class="form-group">
						<div style="overflow: auto;">
							<div style="float: right;">
								<button class="btn btn-success" name="login">Proceed</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<footer>
	<div class="footer">
		<div class="text-center">
			Copyright <?php echo date("Y"); ?> National Youth Service Corps. All rights reserved.
		</div>
	</div>
</footer>
</body>
</html>