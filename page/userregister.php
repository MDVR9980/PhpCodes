<?php
	include('../lib/connect.php');
	include('../lib/boot.php');
	include('header.php');
?>

<?php
	include('body2.php');
	if (!empty($msg) )
		echo "<div>" . $msg ."</div>";

	// if((isset($_POST['btn-register']) && $flag) || $_POST['btn-to-login'])
	// 	header("Location:login.php");
		
?>

<?php
	include('footer.php');
?>