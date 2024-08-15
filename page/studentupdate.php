<?php
session_start();

include('../lib/connect.php');
include('../lib/boot.php');

$userName = $_SESSION['username'];
$query = "SELECT * FROM `student` WHERE `username` = '" . $userName . "'";
if ($sql->findquery($query) == false) {
	$result = $sql->runquery($query);
	$row = mysqli_fetch_assoc($result);
	include('body22.php');
}
?>