<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Corper's Dashboard</title>
	<?php require 'incs/info.php'; ?>
</head>
<body>
<?php require 'incs/header.php'; ?>

<section>
	<div class="container">
		<div class="card bg-dark text-white borderless mt-4 main_box" style="border: 0; margin-bottom: 100px;">
			<div class="card-header text-center">
				<h4>
					<span class="fa fa-tachometer-alt"></span> Your Dashboard
				</h4>
			</div>
			<div class="card-body grey">
				<div class="row">
					<div class="col-md-6">
						<div class="card bg-primary text-center borderless mb-4">
							<div class="card-header text-center">
								<h4>
									<span class="fab fa-servicestack animated rubberBand infinite"></span> View CDS
								</h4>
							</div>
							<div class="card-body">
								<a href="cds.php" class="btn btn-primary"><span class="fa fa-forward"></span>  Go to CDS</a>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card bg-danger text-center borderless">
							<div class="card-header text-center">
								<h4>
									<span class="fa fa-calendar animated rubberBand infinite"></span> View Clearance Date
								</h4>
							</div>
							<div class="card-body">
								<a href="clear.php" class="btn btn-danger"><span class="fa fa-forward"></span> Go to Clearance</a>
							</div>
						</div>
					</div>
				</div>

				<div class="mt-4">
					<h4 class="text-primary">Your Profile Information</h4>
					<table class="table table-dark table-hover table-stripped">
						<?php
							require '../incs/database.inc.php';
							$sql = $conn->query("SELECT * FROM `corpers` WHERE `email` = '$user'");
							while ($sql->fetch_assoc()):
						?>
						<tr>
							<th>CDS Group</th>
							<td><?php echo $row['groups']; ?></td>
						</tr>
						<tr>
							<th>Full Name</th>
							<th>Email</th>
						</tr>
						<tr>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['email']; ?></td>
						</tr>
						<tr>
							<th>Gender</th>
							<th>Batch</th>
						</tr>
						<tr>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['batch']; ?></td>
						</tr>
						<tr>
							<th>Local Government of Origin</th>
							<th>State of Origin</th>
						</tr>
						<tr>
							<td><?php echo $row['lga']; ?></td>
							<td><?php echo $row['state']; ?></td>
						</tr>
						<?php endwhile; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require "incs/footer.php"; ?>
</body>
</html>