<?php
require 'functions.inc.php';
if(isset($_POST['login'])){
	$email = validate_email($_POST['email']);
	$password = validate($_POST['password']);
	$order = validate($_POST['order']);

	if($order == "admin"){
		login("admin", $email, $password, $order);
	}
	else if($order == "corper"){
		login("corpers", $email, $password, $order);
	}

}

if(isset($_POST['makeBatch'])){
	$name = validate($_POST['batch']);
	$year = validate($_POST['year']);

	create_batch("batch", $name, $year);
}

if(isset($_POST['makeGroup'])){
	$name = validate($_POST['group']);
	// $year = validate($_POST['year']);

	create_group("groups", $name);
}

if(isset($_GET['logout_admin'])){
	logout($_SESSION['nysc_admin_page_dutse'], "../index.php");
}
if(isset($_GET['logout_user'])){
	logout($_SESSION['nysc_corper_page_dutse'], "../index.php");
}
if(isset($_GET['del_id'])){
	$id = $_GET['del_id'];

	delete($id, "batch");
}
if(isset($_GET['del_group_id'])){
	$id = $_GET['del_group_id'];

	delete($id, "groups");
}
if(isset($_POST['create_user'])){
	$name = validate($_POST['fullname']);
	$email = validate(validate_email($_POST['email']));
	$gender = validate($_POST['gender']);
	$batch = validate($_POST['batch']);
	$state = validate($_POST['state']);
	$lga = validate($_POST['lga']);
	$password = validate($_POST['password']);
	$cpassword = validate($_POST['cpassword']);

	if($password == $cpassword){
		add_members("corpers", $name, $email, $gender, $batch, $lga, $state, $password);
	}

	else{
		array_push($err, "The two passwords did not match");
	}
}

if(isset($_POST['add-clearance'])){
	$batch = validate($_POST['batch']);
	$month = validate($_POST['month']);
	
	$date = validate($_POST['date']);
	$info = validate($_POST['info']);

	$year = substr($date, 0, 4);
	$time = validate($_POST['time']);

	add_clearance("clearance", $batch, $month, $year, $date, $info, $time);
}

if(isset($_POST['make-cds'])){
	$batch = validate($_POST['batch']);
	$month = validate($_POST['month']);
	$date = validate($_POST['date']);
	$venue = validate($_POST['venue']);

	$year = substr($date, 0, 4);

	$time = validate($_POST['time']);

	add_cds("cds", $batch, $month, $year, $date, $venue, $time);
}

if(isset($_GET['delete_cds_id'])){
	$id = $_GET['delete_cds_id'];

	delete_cds("cds", $id);
}
?>