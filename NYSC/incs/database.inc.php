<?php
$dbhostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "nysc";

$conn = @new mysqli($dbhostname, $dbusername, $dbpassword, $dbname);

try{
	if($conn->connect_error){
		throw new Exception("Failed to connect to the database");
	}
}
catch(Exception $ex){
		echo "Error: " . $ex->getMessage();
	}
?>