<?php
require 'functions.inc.php';
if(isset($_POST['login'])){
	$email = validate_email($_POST['email']);
	$password = validate($_POST['password']);
	$order = validate($_POST['order']);

	login("admin", $email, $password, $order);

}

if(isset($_POST['makeBatch'])){
	$name = validate($_POST['batch']);
	$year = validate($_POST['year']);

	create_batch("batch", $name, $year);
}

if(isset($_GET['logout'])){
	logout($_SESSION['nysc_admin_page_dutse'], "../index.php");
}
if(isset($_GET['del_id'])){
	$id = $_GET['del_id'];

	delete($id, "batch");
}
if(isset($_POST['create_user'])){
	$name = validate($_POST['fullname']);
	$email = validate(validate_email($_POST['email']));
	$gender = validate($_POST['gender']);
	$batch = validate($_POST['batch']);
	$state = validate($_POST['state']);
	$lga = validate($_POST['lga']);

	add_members("corpers", $name, $email, $gender, $batch, $lga, $state);
}
?>