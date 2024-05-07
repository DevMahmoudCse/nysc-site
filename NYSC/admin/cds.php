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
	<title>Manage CDS</title>
	<?php require 'incs/info.php'; ?>
	<style type="text/css">
		header{
			background: darkgreen;
			padding: 16px;
			color: #fff;
			font-family: sans-serif;
			font-size: 30px;
		}
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
		.main_box{margin-bottom: 70px}
	</style>
</head>
<body>
<header>
	<div class="container">
		<h4><span class="fab fa-servicestack"></span> Manage Corps CDS</h4>
	</div>
</header>
<div class="container">
	<div class="links mt-4">
		<a href="../admin/" class="btn btn-primary btn-block">
			<span class="fa fa-backward"></span> Back to Home
		</a>
	</div>
	<div class="row mt-4 main_box">
		<div class="col-md-4">
			<?php
				foreach ($good as $key => $value):
			?>
				<div class="alert alert-success">
					<b><?php echo $value; ?></b>
				</div>
			<?php endforeach; ?>
			<?php
				foreach ($err as $key => $value):
			?>
				<div class="alert alert-danger">
					<b>
						<?php echo $value; ?>
					</b>
				</div>
			<?php endforeach; ?>

			<div class="">
				<h4>Add CDS Details</h4>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
					<div class="form-group">
						<label>Select CDS Batch</label>
						<select name="batch" class="form-control" required>
							<?php
								display_batch("groups");
								while($row = $query->fetch_assoc()):
							?>
							<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?> </option>

						<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
					<label>Select CDS Month</label>
					<select name="month" class="form-control" required>
						<option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option><option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option><option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option>
					</select>
				</div>
					<div class="form-group">
						<label>CDS Venue</label>
						<input type="text" name="venue" placeholder="Enter CDS Venue" class="form-control" required>
					</div>
					<div class="form-group">
						<label>CDS Date</label>
						<input type="date" name="date" class="form-control">
					</div>
					<div class="form-group">
						<label>CDS Time</label>
						<select name="time" class="form-control" required>
							<option value="">SELELCT TIME</option>
							<option value="06:00 AM">06:00 AM</option>
							<option value="06:30 AM">06:30 AM</option>
							<option value="07:00 AM">07:00 AM</option>
							<option value="07:30 AM">07:30 AM</option>
							<option value="08:00 AM">08:00 AM</option>
							<option value="08:30 AM">08:30 AM</option>
							<option value="09:00 AM">09:00 AM</option>
							<option value="09:30 AM">09:30 AM</option>
							<option value="10:00 AM">10:00 AM</option>
							<option value="10:20 AM">10:30 AM</option>
							<option value="11:00 AM">11:00 AM</option>
							<option value="11:30 AM">11:30 AM</option>
							<option value="12:00 PM">12:00 PM</option>
							<option value="12:30 PM">12:30 PM</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" name="make-cds" class="btn btn-primary btn-block">Add CDS	</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-8">
			<table class="table table-dark table-striped table-hovered">
				<tr>
					<th>S/N</th>
					<th>Group</th>
					<th>Month</th>
					<th>Venue</th>
					<th>Date</th>
					<th>Time</th>
					<th>Year</th>
					<th>Action</th>
				</tr>
				<?php
					require '../incs/database.inc.php';
					if(isset($_GET['next_batch'])){
					$next_quiz = $_GET['next_batch'];
					}
					else{
						$next_quiz = 1;
					}

					//..get the user username

					// $your_username = $_SESSION['space_user_session'];

					$no_of_records_per_page = 10;

					//.ofset is where to start the count from

					$offset = ($next_quiz - 1) * $no_of_records_per_page;
					$total_post = "SELECT COUNT(*) FROM `cds`";
					$first_query = $conn->query($total_post);
					$total_rows = $first_query->fetch_array()[0];
					$total_pages = ceil($total_rows / $no_of_records_per_page);

					$sql = "SELECT * FROM `cds` ORDER BY `id` DESC LIMIT $offset, $no_of_records_per_page";
					$run_sql = $conn->query($sql);

					$serial_name = 0;
					while($row = $run_sql->fetch_assoc()):
						$serial_name += 1;
				?>
				<tr>
					<td>
						<?php echo $serial_name; ?>
					</td>
					<td>
						<?php echo $row['batch'] ?>
					</td>
					<td>
						<?php echo $row['month'] ?>
					</td>
					<td>
						<?php echo $row['venue'] ?>
					</td>
					<td>
						<?php echo $row['year'] ?>
					</td>
					<td>
						<?php echo $row['date'] ?>
					</td>
					<td>
						<?php echo $row['time'] ?>
					</td>
					<td>
						<a href="?delete_cds_id=<?php echo $row['id'] ?>" class = "btn btn-danger">
							 Delete
						</a>
					</td>
				</tr>
				<?php endwhile; ?>
			</table>
			<ul class="pagination pagination-lg">
				<li class="page-item">
					<a href="?next_batch=1" class="page-link"><span class="fa fa-home"></span></a>
				</li>
				<li class="<?php if($next_quiz <= 1){echo 'page-item disabled';} ?>">
					<a href="<?php if($next_quiz <= 1){echo 'javascript:void(0)';} else{echo  "?next_batch=".($next_quiz - 1);}?>" class = "page-link"><span class="fa fa-backward"></span></a>
				</li>
				<li class="<?php if($next_quiz >= $total_pages){echo 'page-item disabled';}?>">
					<a href="<?php if($next_quiz >= $total_pages){echo 'javascript:void(0)';} else{echo "?next_batch=".($next_quiz + 1);} ?>" class = 'page-link'> <span class="fa fa-forward"></span></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php require "incs/footer.php"; ?>
</body>
</html>