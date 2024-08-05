<?php
	include('../lib/connect.php');
	include('../lib/boot.php');
	include('header.php');
?>

<?php
	include('body2.php');
	if (!empty($msg))
		echo "<div>" . $msg ."</div>";
	if($flag && $_POST['btn-register'])
		header("Location:dashboard.php");
	else if($_POST['btn-login3'])
		header("Location:login.php");
?>

<?php
	include('footer.php');
?>