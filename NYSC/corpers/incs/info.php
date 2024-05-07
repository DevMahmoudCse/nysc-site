<?php
require '../incs/server.inc.php';
if(!isset($_SESSION['nysc_corper_page_dutse'])){
	$user = $_SESSION['nysc_corper_page_dutse'];
	header("location: ../index.php");
}
function find_info($tablename, $id){
	global $row, $sql;
	require '../incs/database.inc.php';
	$sql = $conn->query("SELECT * FROM `$tablename` WHERE `email` = '$id'");
	$row = $sql->fetch_assoc();
}
$user = $_SESSION['nysc_corper_page_dutse'];
find_info("corpers", $user);
$batch = $row['batch'];
$group = $row['groups'];
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/fontawesome-all.css">
<link rel="stylesheet" type="text/css" href="../css/animate.css">


<script type="text/javascript" src="../js/jquery.min.js"></script>

<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css">

<script src="../js/jquery.stateLga.js"></script>
<script src="../js/jquery.ucfirst.js"></script>