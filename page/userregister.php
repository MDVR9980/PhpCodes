<?php
	include('../lib/connect.php');
	include('../lib/boot.php');
	include('header.php');
?>

<?php
	include('body2.php');
	if (!empty($msg) )
		echo "<div>" . $msg ."</div>";
?>

<?php
	include('footer.php');
?>