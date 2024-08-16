<?php
session_start();
include('../lib/connect.php');
include('../lib/boot.php');

if (isset($_GET["Iusername"]))
	$userName = $_GET["Iusername"];
else
	$userName = $_GET["Susername"];

$query = "SELECT * FROM `student` WHERE `username` = ?";
if ($mysql->checkExists($query, [$userName]) == false) {
	$result = $mysql->runQuery($query, [$userName]);
	$row = mysqli_fetch_assoc($result);
	include('body6.php');
}
?>