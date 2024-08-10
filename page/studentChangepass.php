<?php
	session_start();
	include('../lib/connect.php');
	include('../lib/boot.php');
	
	if(isset($_GET["Iusername"]))
		$userName = $_GET["Iusername"];
	else
		$userName = $_GET["Susername"];
	
	$query = "SELECT * FROM `student` WHERE `username` = '".$userName."'";
	if(findquery($conn, $query) == false){
		$result = runquery($conn,$query);
		$row = mysqli_fetch_assoc($result);
		include('body66.php');
	}
?>