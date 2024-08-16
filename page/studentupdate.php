<?php
session_start();

include('../lib/connect.php');
include('../lib/boot.php');

$userName = $_SESSION['username'];
$query = "SELECT * FROM `student` WHERE `username` = ?";
if ($mysql->checkExists($query, [$userName]) == false) {
	$result = $mysql->runQuery($query, [$userName]);
	$row = mysqli_fetch_assoc($result);
	include('body22.php');
}
?>