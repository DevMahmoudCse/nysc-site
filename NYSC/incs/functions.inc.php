<?php
$err = array();
$good = array();

session_start();

function validate($data){
	require 'database.inc.php';
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	$data = mysqli_real_escape_string($conn, $data);

	return $data;
}

function validate_email($email){
	global $err;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		array_push($err, "Invalid Email address");
	}

	return $email;
}

function logout($user, $location){
	session_destroy();
	unset($user);
	header("location: " . $location);
}

function login($tablename, $email, $password, $order){
	global $err;
	require 'database.inc.php';
	$new_password = md5($password);

	if($order == "admin"){
		$query = $conn->prepare("SELECT * FROM `$tablename` WHERE `email` = ? AND `password` = ?");
		$query->bind_param("ss", $email, $new_password);

		$query->execute();

		$output = 0;

		$my_data = $query->get_result();
		if($my_data->num_rows == 0){
			$output = 0;
			array_push($err, "Invalid Login Details ");

		}


		if(count($err) == 0){
			$_SESSION['nysc_admin_page_dutse'] = $email;
		 	header("location: admin/");
		}
	}
	else if($order == "corper"){
		$query = $conn->prepare("SELECT * FROM `$tablename` WHERE `email` = ? AND `password` = ?");
		$query->bind_param("ss", $email, $new_password);

		$query->execute();

		$output = 0;

		$my_data = $query->get_result();
		if($my_data->num_rows == 0){
			$output = 0;
			array_push($err, "Invalid Login Details");

		}
		if(count($err) == 0){
			$_SESSION['nysc_corper_page_dutse'] = $email;
			header("location: corpers/");
		}
	}

	


	$conn->close();
	$query->close();
}

function add_members($tablename, $name, $email, $gender, $batch, $lga, $state, $password){
	require 'database.inc.php';
	global $err, $good;

	$sql = $conn->prepare("SELECT * FROM `$tablename` WHERE `email` = ? AND `name` = ?");
	$sql->bind_param("ss", $email, $name);
	$sql->execute();

	$first = $sql->get_result();
	$rows = $first->fetch_assoc();

	if($rows){
		if($rows['name'] === $name && $rows['email'] === $email){
			array_push($err, "User with email " . $email . "already Exist");
		}
	}
	if(count($err) == 0){
		$sql = $conn->query("SELECT * FROM `groups` ORDER BY RAND() LIMIT 1");
		$data = $sql->fetch_assoc();
		$row = $data['name'];
		$querys = $conn->prepare("INSERT INTO `$tablename` (`name`, `email`, `gender`, `batch`, `lga`, `state`, `groups`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$new = md5($password);
		$querys->bind_param("ssssssss", $name, $email, $gender, $batch, $lga, $state, $row, $new);

		if($querys->execute()){
			array_push($good, "Data Added Successfully!");
		}
		else{
			array_push($err, "Failed to Create User Account, try again later");
		}
	}

	
}

function create_batch($tablename, $name, $year){
	require "database.inc.php";
	global $good, $err;

	$data = $conn->prepare("SELECT * FROM `$tablename` WHERE `name` = ? AND `year` = ?");
	$data->bind_param("si", $name, $year);
	$data->execute();

	$results = $data->get_result();
	$result = $results->fetch_assoc();

	if($result){
		if($result['name'] === $name || $result['year'] === $year){
			array_push($err, "Batch (" . $name . ") $year " . " Already Existed");
		}
	}
	if(count($err) == 0){
		$query = $conn->prepare("INSERT INTO `batch` (`name`, `year`) VALUES (?, ?)");
	$query->bind_param("si", $name, $year);
	if($query->execute()){
		array_push($good, "Batch Added Successfully! (" . $name . ") " . $year);
	}

	
	}
	
	$conn->close();
}

function create_group($tablename, $name){
	require "database.inc.php";
	global $good, $err;

	$data = $conn->prepare("SELECT * FROM `$tablename` WHERE `name` = ?");
	$data->bind_param("s", $name);
	$data->execute();

	$results = $data->get_result();
	$result = $results->fetch_assoc();

	if($result){
		if($result['name'] === $name){
			array_push($err, "Group (" . $name . ") Already Existed");
		}
	}
	if(count($err) == 0){
		$query = $conn->prepare("INSERT INTO `$tablename` (`name`) VALUES (?)");
	$query->bind_param("s", $name);
	if($query->execute()){
		array_push($good, "Group Added Successfully! (" . $name . ")" );
	}

	
	}
	
	$conn->close();
}

function display_batch($tablename){
	require "database.inc.php";
	global $row, $query;
	$query = $conn->query("SELECT * FROM `$tablename`");
	// $row = $query->fet
}

function delete($id, $tablename){
	require "database.inc.php";
	global $good;
	if($query = $conn->query("DELETE FROM `$tablename` WHERE `id` = '$id'")){
		array_push($good, "$tablename Deleted Successfully!");
	}
}

function add_clearance($tablename, $batch, $month, $year, $date, $info, $time){
	require 'database.inc.php';
	global $err, $good;

	$sql = $conn->prepare("INSERT INTO `$tablename` (`batch`, `month`, `year`, `date`, `info`, `time`) VALUES (?, ?, ?, ?, ?, ?)");
	$sql->bind_param("ssssss", $batch, $month, $year, $date, $info, $time);

	$query = $conn->prepare("SELECT * FROM `$tablename` WHERE `batch` = ? AND `month` = ? AND `year` = ?");
	$query->bind_param("sss", $batch, $month, $year);
	$query->execute();

	$data = $query->get_result();
	$row = $data->fetch_assoc();

	if($row){
		if(($row['batch'] === $batch) && ($row['month'] === $month)){
			array_push($err, "Clearance for this batch already exist");
		}
	}
	if(count($err) == 0){
		if($sql->execute()){
			array_push($good, "Clearance date added Successfully!!!");
		}
	}
}

function add_cds($tablename, $batch, $month, $year, $date, $venue, $time){
	require 'database.inc.php';
	global $err, $good;

	$sql = $conn->prepare("INSERT INTO `$tablename` (`batch`, `month`, `year`, `date`, `venue`, `time`) VALUES (?, ?, ?, ?, ?, ?)");
	$sql->bind_param("ssssss", $batch, $month, $year, $date, $venue, $time);

	$query = $conn->prepare("SELECT * FROM `$tablename` WHERE `batch` = ? AND `month` = ? AND `year` = ?");
	$query->bind_param("sss", $batch, $month, $year);
	$query->execute();

	$data = $query->get_result();
	$row = $data->fetch_assoc();

	if($row){
		if(($row['batch'] === $batch) && ($row['month'] === $month)){
			array_push($err, "CDS for this batch already exist");
		}
	}
	if(count($err) == 0){
		if($sql->execute()){
			array_push($good, "CDS date added Successfully!!!");
		}
	}
}

function delete_cds($tablename, $id){
	require 'database.inc.php';
	global $err, $good;

	if($sql = $conn->query("DELETE FROM `$tablename` WHERE `id` = '$id'")){
		array_push($good,  "CDS Deleted Successfully");
	}
}
?>