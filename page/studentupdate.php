<?php
	session_start();
	
	include('../lib/connect.php');
	include('../lib/boot.php');

	$userName = $_SESSION['username'];
	$query = "SELECT * FROM `student` WHERE `username` = '".$userName."'"; 
	if(findquery($conn,$query) == false){
		$result = runquery($conn,$query);
		$row = mysqli_fetch_assoc($result);
		include('body22.php');
	}
?>