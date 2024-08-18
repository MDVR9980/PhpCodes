<?php

include('../lib/boot.php');

if (!isset($mysql)) {
    $mysql = new Database("localhost", "root", "", "university");
}

$userName = $_SESSION['username'];
$query = "SELECT * FROM `student` WHERE `username` = ?";
if ($mysql->checkExists($query, [$userName]) == false) {
	$result = $mysql->runQuery2($query, [$userName]);
	$row = mysqli_fetch_assoc($result);
	include('body22.php');
}
?>