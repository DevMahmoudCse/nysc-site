<?php
require '../incs/server.inc.php';
if(!isset($_SESSION['nysc_admin_page_dutse'])){
	header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require 'incs/info.php'; ?>
	<title>Admin Dashboard</title>
	<style type="text/css">
		body{
			background: linear-gradient(#fff, rgba(0,0,0,0.5)), url("../images/NYSC.webp");
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
			background-position: center;
		}
		.header{
			background: darkgreen;
			padding: 16px;
			color: #fff;
			font-family: sans-serif;
			font-size: 30px;
		}
		.upper_logo{width: 4%}
		@media screen and (max-width: 800px){
			.upper_logo{width: 20%}
			.header{padding: 10px; font-size: 17px}
		}
		.logger, .logger:hover{font-size: 15px; color: #fff; font-family: lucida console; font-weight:lighter; }
		.big_text{font-size: 40px}
		.flows{background: linear-gradient(#123456, #000);}
		.borderless{border: 0}
		.grey{background: linear-gradient(#b1b1b1, #efefef); }
		a, a:hover{text-decoration: none;}
		footer{
			position: fixed;
			bottom: 0;
			width: 100%;
			padding: 10px;
			background: darkgreen;
			color: #fff;
			font-size: 14px;
			border-top: 5px solid darkred;
			
		}
		.main_box{
			margin-bottom: 100px;
		}
	</style>
</head>
<body>
<header class="header">
	
	<div class="head">
		<img src="../images/NYSC_LOGO.svg" class="upper_logo">
		Welcome, Admin
	</div>
	<div style="position: absolute; right: 10px; top: 50px;">
		<div>
			<a href="?logout_admin=1" class="logger"><span class="fa fa-sign-out-alt"></span> Logout</a>
		</div>
	</div>
</header>

<section>
	<div class="container mt-4">
		<?php foreach($good as $gooder => $best): ?>
			<div class="alert alert-success">
				<b><?php echo $best; ?></b>
			</div>
		<?php endforeach; ?>

		<?php foreach($err as $bad => $wors): ?>
			<div class="alert alert-danger">
				<b><?php echo $wors; ?></b>
			</div>
		<?php endforeach; ?>
		<div class="card bg-dark text-white borderless mt-4 main_box">
			<div class="card-header text-center">
				<h4><span class="fa fa-tachometer-alt"></span> Quick Actions</h4>
			</div>
			<div class="card-body grey">
				<div class="row">
					<div class="col-md-4 mb-4">
						<a href="javascript:void(0)" data-toggle = "modal" data-target = "#makeUser">
							<div class="card bg-primary text-white text-center borderless ">
								<div class="card-header">
									Add Corps Members
								</div>
								<div class="card-body bg-white big_text  flows">
									<span class="fa fa-user-plus animated rubberBand infinite"></span>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 mb-4">
						<a href="clear.php" >
							<div class="card bg-info text-white text-center borderless ">
								<div class="card-header">
									Assign Clearance Date
								</div>
								<div class="card-body bg-white big_text  flows">
									<span class="fa fa-calendar animated rubberBand infinite"></span>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 mb-4">
						<a href="cds.php">
							<div class="card bg-success text-white text-center borderless ">
								<div class="card-header">
									Assign Comumnity Development Service
								</div>
								<div class="card-body bg-white big_text  flows">
									<span class="fab fa-servicestack animated rubberBand infinite"></span>
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="row mt-4 mb-4">
					<div class="col-md-4">
						<a href="javascript:void(0)" data-toggle = "modal" data-target = "#batch">
							<div class="card bg-secondary text-white text-center borderless ">
								<div class="card-header">
									Manage NYSC Batch
								</div>
								<div class="card-body bg-secondary big_text  flows">
									<span class="fab fa-dashcube animated flip infinite"></span>
								</div>
							</div>
						</a>
					</div>

					<div class="col-md-4">
						<a href="groups.php" data-toggle = "modal" data-target = "#group">
							<div class="card bg-danger text-white text-center borderless ">
								<div class="card-header">
									Manage CDS Groups
								</div>
								<div class="card-body bg-secondary big_text  flows">
									<span class="fa fa-tasks animated flip infinite"></span>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="users.php">
							<div class="card bg-warning text-white text-center borderless ">
								<div class="card-header">
									Corp Members
								</div>
								<div class="card-body bg-secondary big_text  flows">
									<span class="fa fa-users animated flip infinite"></span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require "incs/footer.php"; ?>

<?php include 'modals.php'; ?>
<script>	
	var option = '';

	var states=$.nigeria.states();
	for (var i=0;i<states.length;i++){
	   option += '<option value="'+ states[i] + '">' + $.ucfirst(states[i]) + '</option>';
	}
	$('#states').append(option).on('change',function() {

	var option = '';
	option += '<option value="">Local government</option>';

	var lgas=eval('$.nigeria.'+this.value);

	for (var i=0;i<lgas.length;i++){
	   option += '<option value="'+ lgas[i] + '">' + $.ucfirst(lgas[i]) + '</option>';
	}

	$('#lgas').find('option')
	    .remove()
	    .end().append(option);

	}).trigger('change');

</script>
</body>
</html>