
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clearance Page</title>
	<?php require 'incs/info.php'; ?>
</head>
<body>
<?php require 'incs/header.php'; ?>
<div class="container mt-4">
	<div class="alert alert-info text-center">
	<a href="../corpers/" class="btn btn-danger">
		<span class="fa fa-home"> Back to Home</span>
	</a>
</div>
	<div class="row">
		<div class="col-md-5 mt-4">
			<h4 class="text-danger">Search Clearance Date By Month</h4>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">
				<div class="form-group">
					<select class="form-control" required name="month">
						<option value="">--SELECT MONTH --</option>
						<option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option><option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option><option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block" name="search_clr">
						<span class="fa fa-search"></span> Search 
					</button>
				</div>
			</form>
		</div>
		<div class="col-md-7 mt-4">
			<h4 class="text-success">Search Results</h4>
			<table class="table table-dark table-hover table-stripped">
				<tr>
					<th>Batch</th>
					<th>Month</th>
					<th>Date</th>
					<th>Time</th>
					<th>Additional Info</th>
				</tr>
				<?php
					if(isset($_POST['search_clr'])){
						require '../incs/database.inc.php';
						$month = $_POST['month'];
						$year = date("Y");
						$sql = $conn->query("SELECT * FROM `clearance` WHERE `batch` = '$batch' AND `month` = '$month' AND `year` = '$year'");
						// echo $sql->num_rows;
						if($sql->num_rows == 0){
							// array_push($err, "CDS Result for $month is not available");
							echo "
								<div class = 'alert alert-danger text-center'>
									<b>Clearance for $month is not yet Available</b>
								</div>
							";
						}
						else{
							while ($row = $sql->fetch_assoc()):
				?>
				<tr>
					<td>
						<?php echo $row['batch']; ?>
					</td>
					<td>
						<?php echo $row['month']; ?>
					</td>
					<td>
						<?php echo $row['date']; ?>
					</td>
					<td>
						<?php echo $row['time']; ?>
					</td>
					<td>
						<?php echo $row['info']; ?>
					</td>
				</tr>
				<?php
				endwhile;
										}
					}
				?>
			</table>
		</div>
	</div>
</div>

<?php require "../admin/incs/footer.php"; ?>
</body>
</html>

