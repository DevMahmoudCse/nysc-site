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
	<title>Manage CDS Groups</title>
	<?php require 'incs/info.php'; ?>
	<style type="text/css">
		body{
			background: linear-gradient(#fff, #efefef);
			width: 100%;
		}
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
		table > tr > th, td{
			font-size: 12px;
		}
	</style>
</head>
<body>
<header>
	<div class="container">
		<h4><span class="fab fa-servicestack"></span> Manage Corpers</h4>
	</div>
</header>

<section>
	<div class="container">
		<div class="links mt-4">
			<a href="../admin/" class="btn btn-secondary btn-block btn-lg">
				<span class="fa fa-home"></span> Back to Home
			</a>
		</div>
	</div>

	<div class="container mt-4">
		<div class="box mb-4">
			<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
				<div class="input-group">
					<input type="text" name="user_name" placeholder="Search User by Name" class="form-control" required>
					<div class="input-group-btn">
						<button type="submit" class="btn btn-info" name="search_corper">
							<span class="fa fa-search"></span>
						</button>
					</div>
				</div>
			</form>
			<?php
				require '../incs/database.inc.php';
				if(isset($_POST['search_corper'])){
					
					$name = $_POST['user_name'];
					$sql = $conn->query("SELECT * FROM `corpers` WHERE `name` LIKE '%$name%' ORDER BY `id` DESC");
					if($sql->num_rows == 0){
						echo "
							<div class = 'alert alert-danger mt-4'>
								<b>Your search result is not found!</b>
							</div>
						";
					}
					else{
						$total = $sql->num_rows;
						echo " <h4 class = 'text-center text-primary mt-4'>Your search found $total Results</h4> "; 
						echo "
								<table class = 'table table-striped'>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Gender</th>
										<th>Batch</th>
										<th>CDS Group</th>
										<th>LGA</th>
										<th>State</th>
										<th>Delete</th>



									</tr>
								";
						while($row = $sql->fetch_assoc()){
							echo "
								<tr>
									<td>$row[name]</td>
									<td>$row[email]</td>
									<td>$row[gender]</td>
									<td>$row[batch]</td>
									<td>$row[groups]</td>
									<td>$row[lga]</td>
									<td>$row[state]</td>
									<td>
										<a href='?delete_user_id=<?php echo $row[id] ?>' class = 'btn btn-danger btn-sm'>
										<span class='fa fa-archive animated wobble infinite'></span> Delete
						</a>
									</td>
								</tr>
							";
						}
						echo "</table>";
					}
				}
			?>
		</div>
		<table class="table table-dark table-striped table-hover">
			<tr>
				<th>S/N</th>
				<th>Name</th>
				<th>Email Address</th>
				<th>Gender</th>
				<th>Batch</th>
				<th>CDS Group</th>
				<th>LGA</th>
				<th>State</th>
				<th>Delete</th>
			</tr>
			<?php

					require '../incs/database.inc.php';
					if(isset($_GET['next_users'])){
					$next_quiz = $_GET['next_users'];
					}
					else{
						$next_quiz = 1;
					}

					//..get the user username

					// $your_username = $_SESSION['space_user_session'];

					$no_of_records_per_page = 20;

					//.ofset is where to start the count from

					$offset = ($next_quiz - 1) * $no_of_records_per_page;
					$total_post = "SELECT COUNT(*) FROM `corpers`";
					$first_query = $conn->query($total_post);
					$total_rows = $first_query->fetch_array()[0];
					$total_pages = ceil($total_rows / $no_of_records_per_page);

					$sql = "SELECT * FROM `corpers` ORDER BY `id` DESC LIMIT $offset, $no_of_records_per_page";
					$run_sql = $conn->query($sql);

					$serial_name = 0;
					while($row = $run_sql->fetch_assoc()):
						$serial_name += 1;
			?>
				<tr>
					<td><?php echo $serial_name; ?></td>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<td><?php echo $row['gender'] ?></td>
					<td><?php echo $row['batch'] ?></td>
					<td><?php echo $row['groups'] ?></td>
					<td><?php echo $row['lga'] ?></td>
					<td><?php echo $row['state'] ?></td>
					<td>
						<a href="?delete_user_id=<?php echo $row['id'] ?>" class = "btn btn-danger btn-sm">
							<span class="fa fa-archive animated wobble infinite"></span> Delete
						</a>
					</td>
				</tr>
			<?php endwhile; ?>
		</table>
		<ul class="pagination pagination-lg">
				<li class="page-item">
					<a href="?next_users=1" class="page-link"><span class="fa fa-home"></span></a>
				</li>
				<li class="<?php if($next_quiz <= 1){echo 'page-item disabled';} ?>">
					<a href="<?php if($next_quiz <= 1){echo 'javascript:void(0)';} else{echo  "?next_users=".($next_quiz - 1);}?>" class = "page-link"><span class="fa fa-backward"></span></a>
				</li>
				<li class="<?php if($next_quiz >= $total_pages){echo 'page-item disabled';}?>">
					<a href="<?php if($next_quiz >= $total_pages){echo 'javascript:void(0)';} else{echo "?next_users=".($next_quiz + 1);} ?>" class = 'page-link'> <span class="fa fa-forward"></span></a>
				</li>
			</ul>
	</div>
</section>

<?php require "incs/footer.php"; ?>
</body>
</html>