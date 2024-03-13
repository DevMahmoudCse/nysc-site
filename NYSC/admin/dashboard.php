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
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="../css/animate.css">
	

	<script type="text/javascript" src="../js/jquery.min.js"></script>

	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<script src="../js/jquery.stateLga.js"></script>
    <script src="../js/jquery.ucfirst.js"></script>

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
		.logger, .logger:hover{font-size: 18px; color: #fff; font-family: lucida console; font-weight:lighter; }
		.big_text{font-size: 40px}
		.flows{background: linear-gradient(#123456, #000);}
		.borderless{border: 0}
		.grey{background: linear-gradient(#b1b1b1, #efefef);}
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
			<a href="dashboard.php?logout=1" class="logger"><span class="fa fa-sign-out-alt"></span> Logout</a>
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
		<div class="card bg-dark text-white borderless mt-4">
			<div class="card-header text-center">
				<h4><span class="fa fa-tachometer-alt"></span> Quick Actions</h4>
			</div>
			<div class="card-body grey">
				<div class="row">
					<div class="col-md-4">
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
					<div class="col-md-4">
						<a href="javascript:void(0)" >
							<div class="card bg-info text-white text-center borderless ">
								<div class="card-header">
									Assign Clearance Date
								</div>
								<div class="card-body bg-white big_text  flows">
									<span class="fa fa-calendar animated shake infinite"></span>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="">
							<div class="card bg-success text-white text-center borderless ">
								<div class="card-header">
									Assign Comunity development Service
								</div>
								<div class="card-body bg-white big_text  flows">
									<span class="fa fa-chess animated rubberBand infinite"></span>
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="row mt-4">
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
				</div>
			</div>
		</div>
	</div>
</section>

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