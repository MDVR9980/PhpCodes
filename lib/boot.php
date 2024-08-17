<?php
if (isset($_POST['btn-register'])) {  
    $secret_key = "@@darkday@@";  
    $conn = mysqli_connect("localhost","root","","university");
    $name = trim($_POST['nameuser']);  
    $family = trim($_POST['familyuser']);  
    $userName = trim($_POST['username']);  
    $userPass = trim($_POST['userpass']);  
    $captcha = trim($_POST['captcha']);  
    $captcharandom = trim($_POST['captcha-rand']);  
    $isrebot = isset($_POST['subscribe']);  
    $pass = md5($secret_key.$userPass.$secret_key);  

    function validateInput($name, $family, $userName, $userPass, $captcha, $captcharandom, $isrebot) {  
        $errors = [];  

        if (strlen($name) < 2) $errors[] = "Invalid name!";  
        if (strlen($family) < 3) $errors[] = "Invalid family!";  
        if (strlen($userName) < 8) $errors[] = "Invalid username!";  
        if (strlen($userPass) < 8) $errors[] = "Invalid password!";  
        if ($captcha != $captcharandom) $errors[] = "Invalid captcha value!";  
        if (!$isrebot) $errors[] = "You are a robot!";  

        return $errors;  
    }  

    $errors = validateInput($name, $family, $userName, $userPass, $captcha, $captcharandom, $isrebot);  

    if (empty($errors)) {  
        $query = "SELECT * FROM `student` WHERE `username` = ?";  
        $stmt = $conn->prepare($query);  
        $stmt->bind_param('s', $userName);  
        $stmt->execute();  
        $result = $stmt->get_result();  

        if ($result->num_rows > 0) {  
            echo json_encode(['success' => false, 'message' => 'Current username already exists!']);  
            exit();  
        }   

        $query = "INSERT INTO `student`(`name-user`, `family-user`, `type-user`, `username`, `password`, `type`) VALUES (?,?,'User',?,'$pass','true')";  
        $stmt = $conn->prepare($query);  
        $stmt->bind_param('sss', $name, $family, $userName);  
        
        if ($stmt->execute()) {  
            echo json_encode(['success' => true, 'message' => 'Registration successful!']);  
        } else {  
            echo json_encode(['success' => false, 'message' => 'Could not register user.']);  
        }  
    } else {  
        echo json_encode(['success' => false, 'errors' => $errors]);  
    }     
}

if (isset($_POST['btn-login'])) {  
    session_start();  
    $secret_key = "@@darkday@@";  
    $conn = mysqli_connect("localhost", "root", "", "university");  

    if (!$conn) {  
        die(json_encode(['success' => false, 'errors' => ['Database connection failed!']]));  
    }  

    $typeUser = trim($_POST['tuser']);  
    $_SESSION['Iusername'] = $userName = trim($_POST['Iusername']);  
    $userPass = trim($_POST['userpass']);  
    $captcha = trim($_POST['captcha']);  
    $captcharandom = trim($_POST['captcha-rand']);  
    $isRebot = isset($_POST['subscribe']);  

    $pass = md5($secret_key . $userPass . $secret_key);  

    function validateLoginInput($userName, $userPass, $captcha, $captcharandom, $isRebot) {  
        $errors = [];  

        if (strlen($userName) < 8) $errors[] = "Invalid Username! Must be at least 8 characters.";  
        if (strlen($userPass) < 8) $errors[] = "Invalid Password! Must be at least 8 characters.";  
        if ($captcha !== $captcharandom) $errors[] = "Invalid captcha value!";  
        if (!$isRebot) $errors[] = "You are a robot!";  

        return $errors;  
    }  

    $errors = validateLoginInput($userName, $userPass, $captcha, $captcharandom, $isRebot);  

    if (empty($errors)) {  
        $query = "SELECT * FROM `student` WHERE `username` = ? AND `password` = ?";  
        $stmt = mysqli_prepare($conn, $query);  

        if ($stmt) {  
            mysqli_stmt_bind_param($stmt, 'ss', $userName, $pass);  
            mysqli_stmt_execute($stmt);  
            $result = mysqli_stmt_get_result($stmt);  
            $row = mysqli_fetch_assoc($result);  

            if ($row) {  
                if ($row['type'] !== 'true') {  
                    $errors[] = "User is inactive!";  
                } elseif ($row['type-user'] !== $typeUser) {  
                    $errors[] = "Invalid type user!";  
                } else {  
                    $_SESSION['Iusername'] = $userName;  
                    echo json_encode(['success' => true, 'message' => 'Login successful!']);  
                    exit();  
                }  
            } else {  
                $errors[] = "Invalid username or password";  
            }  
        } else {  
            $errors[] = "Query preparation failed! " . mysqli_error($conn);  
        }  
    }  
    echo json_encode(['success' => false, 'errors' => $errors]);  
    mysqli_close($conn);  
}  


if (isset($_POST['btn-reg'])) {
	header("Location:./userregister.php");
}

if (isset($_POST['btn-T-reg'])) {
	header("Location:../page/userregister.php");
}

if (isset($_POST['btn-T-login'])) {
	header('Location:../page/login.php');
}

if (isset($_POST['btn-to-login'])) {
	header('Location:./login.php');
}

if (isset($_POST['btn-to-update'])) {
	header("Location:../page/update1.php");
}

if (isset($_POST['btn-to-report'])) {
	header("Location:../report/reportstudent.php");
}
if (isset($_POST['btn-to-chng-pass'])) {
	$userName = trim($_POST['username']);
	header("Location:./studentChangepass.php?Iusername=" .  urlencode($userName));
}
if (isset($_POST['btn-to-chng-pass2'])) {
	$userName = trim($_POST['username']);
	header("Location:../page/studentChangepass.php?Susername=" .  urlencode($userName));
}
if (isset($_POST['btn-to-dashboard'])) {
	header("Location:../page/dashboard2.php");
}

if (isset($_POST['chng-type'])) {
	$userName = trim($_POST['username']);
	$typeUser = trim($_POST['typeU']);

	if ($typeUser == "true") {
		$query = "UPDATE `student` SET `type` = 'false' WHERE `username` = ?";
	} else {
		$query = "UPDATE `student` SET `type` = 'true' WHERE `username` = ?";
	}
	$mysql->runQuery($query, [$userName]);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['Id'])) {
        $id = intval($_POST['Id']);
        $conn = mysqli_connect("localhost","root","","university");
        $query = "DELETE FROM `student` WHERE `id` = ?";  
        $stmt = $conn->prepare($query);  
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {  
                echo json_encode(['success' => true]);  
            } else {  
                echo json_encode(['success' => false, 'message' => 'Could not delete record.']);  
            }
        }
}


if (isset($_POST['btn-update'])) {  

    $userName = trim($_POST['username']);  
    $captcha = trim($_POST['captcha']);  
    $captcharandom = trim($_POST['captcha-rand']);  

    function validateUpdateInput($userName, $captcha, $captcharandom) {  
        $errors = [];  

		if (strlen($userName) < 8) $errors[] = "Invalid Username!";
		if ($captcha !== $captcharandom) $errors[] = "Invalid captcha value!";

        return $errors;  
    }  

    $errors = validateUpdateInput($userName, $captcha, $captcharandom);  

    if (empty($errors)) {  
        $query = "SELECT * FROM `student` WHERE `username` = ?";  
        $result = $mysql->runQuery($query, [$userName]);

        if ($result->num_rows > 0) {  
            session_start();  
            $_SESSION['username'] = $userName;  
            header("Location: studentupdate.php");  
            exit();  
        } else {  
            $errors[] = "Invalid username or password!";  
        }  
    }  

    else {  
		echo "<div>" . implode("<br />", $errors) . "</div>";  
    }  
}

if (isset($_POST['btn-change-pass-user'])) {  
    $secret_key = "@@darkday@@";  

    $newPass = trim($_POST['newPass']);  
    $newPass2 = trim($_POST['newPass2']);  
    $userName = trim($_POST['username']);  
    $pass = md5($secret_key.$newPass.$secret_key);  

    function validatePasswordChange($newPass, $newPass2) {  
        $errors = [];  

		if (strlen($newPass) < 8) $errors[] = "New password length is invalid!";
		if (strlen($newPass2) < 8) $errors[] = "Confirm new password length is invalid!";
		if ($newPass !== $newPass2) $errors[] = "Passwords do not match!";

        return $errors;  
    }  

    $errors = validatePasswordChange($newPass, $newPass2);  

    if(empty($errors)) {  
        $query = "UPDATE `student` SET `password` = ? WHERE `username` = ?";  
        $mysql->runQuery($query, [$pass, $userName]); 
        header("Location: ../report/reportstudent.php?passSuccess=1"); 
        exit();
    }  

    if (!empty($errors)) {  
        echo "<div>" . implode("<br />", $errors) . "</div>"; 
    }  
}

if (isset($_POST['btn-updateuser'])) {
	session_start();
	$_SESSION['username'] = $_POST['username'];
	header("Location:../page/studentupdate.php");
}


if (isset($_POST['btn-Update-user'])) {  
    $name = trim($_POST['nameuser']);  
    $family = trim($_POST['familyuser']);  
    $userName = trim($_SESSION['username']);  

    function validatePasswordChange($name, $family) {  
        $errors = [];  

        if (strlen($name) < 2) $errors[] = "Name User Invalid" . "<br />";  
        if (strlen($family) < 3) $errors[] = "Family User Invalid" . "<br />";  

        return $errors;  
    }   

    $errors = validatePasswordChange($name, $family);  

    if (empty($errors)) {  
        $query = "UPDATE `student` SET `name-user`= ?,`family-user`= ? WHERE `username` = ?";  
        $mysql->runQuery($query, [$name, $family, $userName]);  
        
        // Redirect with success message  
        header("Location: ../report/reportstudent.php?updateSuccess=1");  
        exit;  
    }  
}  
?>