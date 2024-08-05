<?php
	if (isset($_POST['btn-register'])){

		$msg = '';
		$pass = '';
		$flag = true;

		$name = trim($_POST['nameuser']);
		$family = trim($_POST['familyuser']);
		$userName = trim($_POST['username']);
		$userPass = trim($_POST['userpass']);
		$pass = md5($userPass."@@darkday@@"); 

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

		$query = "SELECT * FROM `student` WHERE `username` = '".$userName."'"; 

		if(findquery($conn,$query) == false){
			$flag = false;
			$msg .= " .اطلاعات کاربر مورد نظر قبلا در سامانه ذخیره شده است"."<br />";		
		}

		if($flag){
			$query = "INSERT INTO `student`(`name-user`, `family-user`, `type-user`, `username`, `password`, `type`) VALUES
			('".$name."', '".$family."', 'کاربر', '".$userName."', '".$pass."', 'true')";
			runquery($conn,$query);
			$msg .= "Insert data is successful!";  
		}
	}

	if (isset($_POST['btn-login'])){

		$msg = '';
		$pass = '';
		$flag = true;

		$userName = trim($_POST['username']);
		$userPass = trim($_POST['userpass']);
		$captcha = trim($_POST['captcha']);
		$captcharandom = trim($_POST['captcha-rand']);
		$pass = md5($userPass."@@darkday@@"); 

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
	
?>