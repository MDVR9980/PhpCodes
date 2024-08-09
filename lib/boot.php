<?php
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
			('".$name."', '".$family."', 'User', '".$userName."', '".$pass."', 'true')";
			$result = runquery($conn,$query);
			if (!empty($msg) )
				echo "<div>" . $msg ."</div>";
			
			if($result) header("Location:login.php");
			exit(); 

		}
		}
		if (!empty($msg) )
			echo "<div>" . $msg ."</div>";
		
		if($result) header("Location:login.php"); 
	}

	
	if (isset($_POST['btn-login'])){  
		session_start();  
		$msg = '';  
		$flag = true;  
		$secret_key = "@@darkday@@";  
	
		$typeUser = trim($_POST['tuser']);  
		$_SESSION['Iusername'] = $userName = trim($_POST['Iusername']);  
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
			$msg .= "you are a rebot!"."<br />";  
		}  
	
		if ($flag) {  
			$query = "SELECT * FROM `student` WHERE `username` = '".$userName."' and `password` = '".$pass."'";  
			$result = runquery($conn, $query);  
			$row = mysqli_fetch_assoc($result);  
			
			if ($row) {  
				if($row['type-user'] != $typeUser){  
					$flag = false;  
					$msg .= "Invalid type user!"."<br />";  
				} else {  
					$_SESSION['Iusername'] = $userName;  
					if($typeUser == "User"){  
						header("Location: dashboard.php?Iusername=" . urlencode($userName));  
					} else if($typeUser == "Superuser"){  
						header("Location: dashboard2.php");  
					}  
					exit();  
				}  
			} else {  
				$msg .= "Invalid username or password"."<br />";  
			}  
		}  
	}

	if(isset($_POST['btn-reg'])){
		header("Location:userregister.php");
	}

	if(isset($_POST['btn-T-reg'])){
		header("Location:./page/userregister.php");
	}

	if(isset($_POST['btn-T-login'])){
		header('Location:./page/login.php');
	}

	if(isset($_POST['btn-to-login'])){
		header('Location:login.php');
	}

	if(isset($_POST['btn-to-update'])){
		header("Location:../page/update1.php");
	}

	if(isset($_POST['btn-updateuser'])){
		header("Location:dashboard.php");
	}

	if(isset($_POST['btn-to-report'])){
		header("Location:../report/reportstudent.php");
	}
	if(isset($_POST['btn-to-chng-pass'])){
		$userName = trim($_POST['username']);
		header("Location:studentChangepass.php?Iusername=" .  urlencode($userName));
	}
	if(isset($_POST['btn-to-dashboard'])){
		header("Location:../page/dashboard2.php");
	}

	if(isset($_POST['chng-type'])) {
		$userName = trim($_POST['username']);
		$typeUser = trim($_POST['typeU']);

		if($typeUser == "true") {
			$query = "UPDATE `student` SET `type` = 'false' WHERE `username` = '".$userName."'";
		}
		else {
			$query = "UPDATE `student` SET `type` = 'true' WHERE `username` = '".$userName."'";
		}
		runquery($conn, $query);
	}

	if(isset($_POST['del-btn'])){
		$userName = trim($_POST['username']);
		$query = "DELETE FROM `student` WHERE `username` = '".$userName."'";
		runquery($conn, $query);
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
				session_start();
				$_SESSION['username'] = $userName;
				header("Location:studentupdate.php");
				exit();
			}
			else if($flag){
				$flag = false;
				$msg .= "Invalid username or password"."<br />";
			}
		}
	}

	if(isset($_POST['btn-change-pass-user'])){
		echo "11111";
		$msg = '';
		$flag = true;
		$secret_key = "@@darkday@@";

		$newPass = trim($_POST['newPass']);
		$newPass2 = trim($_POST['newPass2']);
		$userName = trim($_POST['username']);
		$pass = md5($newPass.$secret_key);

		if (strlen($newPass)<8){
			$flag = false;
			$msg .= "new Password length invalid"."<br />";
		}
		if (strlen($newPass2)<8){
			$flag = false;
			$msg .= "confirm new password length invalid"."<br />";
		}
		if($newPass == $newPass2){
				$query = "UPDATE `student` SET `password` = '".$pass."' WHERE `username` = '".$userName."'";
				$result = runquery($conn, $query);
				header("Location:dashboard.php");
			}
		}

	if (isset($_POST['btn-updateuser'])){
		session_start();
		$_SESSION['username'] = $_POST['username'];
		header("Location:../page/studentupdate.php");
	}

	if(isset($_POST['btn-Update-user'])){
		$msg = '';
		$flag = true;
		$name = trim($_POST['nameuser']);
		$family = trim($_POST['familyuser']);
		$userName = trim($_SESSION['username']);
		if (strlen($name)<2){
			$flag = false;
			$msg .= "Name User Invalid"."<br />";
		}
		if (strlen($family)<3){
			$flag = false;
			$msg .= "Family User Invalid"."<br />";
		}
		$query = "UPDATE `student` SET `name-user`='".$name."',`family-user`='".$family."' WHERE `username` = '".$userName."'";
		runquery($conn, $query);
		header("Location:../report/reportstudent.php");
		}
?>