<?php
include('../lib/boot.php');

// تعریف شیء دیتابیس اگر از قبل تعریف نشده باشد
if (!isset($mysql)) {
    $mysql = new Database("localhost", "root", "", "university");
}

if (isset($_GET["Iusername"]))
	$userName = $_GET["Iusername"];
else
	$userName = $_GET["Susername"];

$query = "SELECT * FROM `student` WHERE `username` = ?";
if ($mysql->checkExists($query, [$userName]) == false) {
	$result = $mysql->runQuery2($query, [$userName]);
	$row = mysqli_fetch_assoc($result);
	include('body6.php');
}
?>
