<?php
session_start();
	if (isset($_POST['btn-register'])){

		$msg = '';
		$pass = '';
		$flag = true;
		$secret_key = "@@darkday@@";

		$name = trim($_POST['nameuser']);
		$family = trim($_POST['familyuser']);
		$userName = trim($_POST['username']);
		$userPass = trim($_POST['userpass']);
		$captcha = trim($_POST['captcha']);
		$captcharandom = trim($_POST['captcha-rand']);
		$isrebot = isset($_POST['subscribe']);
		$pass = md5($userPass.$secret_key);

		if (strlen($name) < 2){
			$flag = false;
			$msg .= "Invalid name!"."<br />";
		}
		if (strlen($family) < 3){
			$flag = false;
			$msg .= "Invalid family!"."<br />";
		}
		if (strlen($userName) < 8){
			$flag = false;
			$msg .= "Invalid username!"."<br />";
		}
		if (strlen($userPass) < 8){
			$flag = false;
			$msg .= "Invalid password!"."<br />";
		}
		if($captcha != $captcharandom){
			$flag = false;
			$msg .= "Invalid captcha value!"."<br />";
		}
		if(!$isrebot){
			$flag = false;
			$msg .= "you are a rebot!";
		}
		else{
		$query = "SELECT * FROM `student` WHERE `username` = '".$userName."'";

		if(findquery($conn,$query) == false){
			$flag = false;
			$msg .= "Information current user already inserted!"."<br />";
		}
		if($flag){
			$query = "INSERT INTO `student`(`name-user`, `family-user`, `type-user`, `username`, `password`, `type`) VALUES
			('".$name."', '".$family."', 'کاربر', '".$userName."', '".$pass."', 'true')";
			runquery($conn,$query);
			$msg .= "Insert data is successful!";
		}
		}
	}

	if (isset($_POST['btn-login'])){

		$msg = '';
		$pass = '';
		$flag = true;
		$secret_key = "@@darkday@@";

		$userName = trim($_POST['username']);
		$userPass = trim($_POST['userpass']);
		$captcha = trim($_POST['captcha']);
		$captcharandom = trim($_POST['captcha-rand']);
		$isrebot = isset($_POST['subscribe']);
		$pass = md5($userPass.$secret_key);

		if (strlen($userName) < 8){
			$flag = false;
			$msg .= "Invalid Username!"."<br />";
		}
		if (strlen($userPass) < 8){
			$flag = false;
			$msg .= "Invalid Password!"."<br />";
		}
		if($captcha != $captcharandom){
			$flag = false;
			$msg .= "Invalid captcha value!"."<br />";
		}
		if(!$isrebot){
			$flag = false;
			$msg .= "you are a rebot!";
		}
		else{
			$query = "SELECT * FROM `student` WHERE `username` = '".$userName."' and `password` = '".$pass."'";

			if(findquery($conn,$query) == false){
				header("Location:dashboard.php");
				exit();
			}
			else if($flag){
				$msg .= "Invalid username or password"."<br />";
			}
		}
	}

	if(isset($_POST['btn-reg'])){
		header("Location:userregister.php");
	}
	if(isset($_POST['btn-reg2'])){
		header("Location:./page/userregister.php");
	}
	if(isset($_POST['btn-login2'])){
		header('Location:./page/login.php');
	}
	if(isset($_POST['btn-Exit'])){
		header('Location:login.php');
	}



	if (isset($_POST['btn-update'])){

		$msg = '';
		$flag = true;

		$userName = trim($_POST['username']);
		$captcha = trim($_POST['captcha']);
		$captcharandom = trim($_POST['captcha-rand']);

		if (strlen($userName) < 8){
			$flag = false;
			$msg .= "Invalid Username!"."<br />";
		}
		if($captcha != $captcharandom){
			$flag = false;
			$msg .= "Invalid captcha value!"."<br />";
		}
		else{
			$query = "SELECT * FROM `student` WHERE `username` = '".$userName."'";

			if(findquery($conn,$query) == false){
				$_SESSION['username'] = $userName;
				header("Location:../page/studentupdate.php");
				exit();
			}
			else if($flag){
				$flag = false;
				$msg .= "Invalid username or password"."<br />";
			}
		}
	}

	if (isset($_POST['btn-updateuser'])){
		$msg = '';
		$flg = true;
		$name = trim($_POST['nameuser']);
		$family = trim($_POST['familyuser']);
		$userName = trim($_SESSION['username']);
		if (strlen($name)<3){
			$flg = false;
			$msg .= "Name User Invalid"."<br />";
		}
		if (strlen($family)<5){
			$flg = false;
			$msg .= "Family User Invalid"."<br />";
		}
		$query = "SELECT * FROM `student` WHERE `username` = '".$userName."'";
		if(findquery($conn,$query) == false){
			$query = "UPDATE `student` SET `name-user`='".$name."',`family-user`='".$family."' WHERE `username` = '".$userName."'";
			runquery($conn,$query);
			$msg .= "Update seccessfully!"."<br />";
		}
	}
?>