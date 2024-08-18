<?php
session_start();
require_once 'connect.php';
require_once 'user.php';

if (!isset($db)) {
    $db = new Database("localhost", "root", "", "university");
}

// ایجاد شیء User
$user = new User($db);


// Function to handle registration
function handleRegistration(User $user) {
    $name = trim($_POST['nameuser']);
    $family = trim($_POST['familyuser']);
    $userName = trim($_POST['username']);
    $userPass = trim($_POST['userpass']);
    $captcha = trim($_POST['captcha']);
    $captcharandom = trim($_POST['captcha-rand']);
    $isrebot = isset($_POST['subscribe']);

    $response = $user->register($name, $family, $userName, $userPass, $captcha, $captcharandom, $isrebot);
    echo json_encode($response);
}

// Function to handle login
function handleLogin(User $user) {
    $userName = trim($_POST['Iusername']);
    $userPass = trim($_POST['userpass']);
    $captcha = trim($_POST['captcha']);
    $captcharandom = trim($_POST['captcha-rand']);
    $isRebot = isset($_POST['subscribe']);

    $response = $user->login($userName, $userPass, $captcha, $captcharandom, $isRebot);
    if ($response['success']) {
        $_SESSION['Iusername'] = $userName;
    }
    echo json_encode($response);
}

// Handle form submission based on the button clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn-register'])) {
        handleRegistration($user);
    }

    if (isset($_POST['btn-login'])) {
        handleLogin($user);
    }
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
    header("Location:./studentChangepass.php?Iusername=" . urlencode($userName));
}

if (isset($_POST['btn-to-chng-pass2'])) {
    $userName = trim($_POST['username']);
    header("Location:../page/studentChangepass.php?Susername=" . urlencode($userName));
}

if (isset($_POST['btn-to-dashboard'])) {
    header("Location:../page/dashboard2.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    // تغییر نوع کاربر  
    if (isset($_POST['chng-type'])) {  
        $userName = trim($_POST['username']);  
        $typeUser = trim($_POST['typeU']);  

        $newType = $typeUser === "true" ? 'false' : 'true';  
        $query = "UPDATE `student` SET `type` = ? WHERE `username` = ?";  
        $db->runQuery($query, [$newType, $userName]);  

        header("Location: reportstudent.php?chng" . ($newType === 'false' ? "F" : "T") . "=1");  
        exit();  
    }  

    // حذف کاربر  
    if (isset($_POST['Id'])) {  
        $id = intval($_POST['Id']);  
        $query = "DELETE FROM `student` WHERE `id` = ?";  
        $db->runQuery($query, [$id]);  

        if ($db->runQuery($query, [$id])) {  
            echo json_encode(['success' => true]);  
        } else {  
            echo json_encode(['success' => false, 'message' => 'Could not delete record.']);  
        }  
        exit();  
    }  

    // بروزرسانی اطلاعات کاربر  
    if (isset($_POST['btn-update'])) {  
        $userName = trim($_POST['username']);  
        $captcha = trim($_POST['captcha']);  
        $captcharandom = trim($_POST['captcha-rand']);  

        $errors = validateUpdateInput($userName, $captcha, $captcharandom);  

        if (empty($errors)) {  
            $query = "SELECT * FROM `student` WHERE `username` = ?";  
            $result = $db->runQuery($query, [$userName]);  

            if ($result->num_rows > 0) {  
                $_SESSION['username'] = $userName;  
                header("Location: studentupdate.php");  
                exit();  
            } else {  
                $errors[] = "Invalid username!";  
            }  
        } else {  
            echo "<div>" . implode("<br />", $errors) . "</div>";  
        }  
    }  

    // تغییر رمز عبور کاربر  
    if (isset($_POST['btn-change-pass-user'])) {  
        $secret_key = "@@darkday@@";  

        $newPass = trim($_POST['newPass']);  
        $newPass2 = trim($_POST['newPass2']);  
        $userName = trim($_POST['username']);  
        $flagUser = trim($_POST['flag-user']);  

        $errors = validatePasswordChange($newPass, $newPass2);  

        if (empty($errors)) {  
            $pass = md5($secret_key . $newPass . $secret_key);  
            $query = "UPDATE `student` SET `password` = ? WHERE `username` = ?";  
            $db->runQuery($query, [$pass, $userName]);  

            header("Location: ../" . ($flagUser == "1" ? "report/reportstudent.php?passSuccess=1" : "page/dashboard.php?passSuccess=1"));  
            exit();  
        } else {  
            echo "<div>" . implode("<br />", $errors) . "</div>";  
        }  
    }  

    if (isset($_POST['btn-updateuser'])) {
        $_SESSION['username'] = $_POST['username'];
        header("Location:../page/studentupdate.php");
    }

    // بروزرسانی نام و نام خانوادگی کاربر  
    if (isset($_POST['btn-Update-user'])) {  
        $name = trim($_POST['nameuser']);  
        $family = trim($_POST['familyuser']);  
        $userName = $_SESSION['username'];  

        $errors = validateUserUpdate($name, $family);  

        if (empty($errors)) {  
            $query = "UPDATE `student` SET `name-user` = ?, `family-user` = ? WHERE `username` = ?";  
            $db->runQuery($query, [$name, $family, $userName]);  

            header("Location: ../report/reportstudent.php?updateSuccess=1");  
            exit();  
        } else {  
            echo "<div>" . implode("<br />", $errors) . "</div>";  
        }  
    }  
}  

function validateUpdateInput($userName, $captcha, $captcharandom) {  
    $errors = [];  
    if (strlen($userName) < 8) $errors[] = "Invalid Username!";  
    if ($captcha !== $captcharandom) $errors[] = "Invalid captcha value!";  
    return $errors;  
}  

function validatePasswordChange($newPass, $newPass2) {  
    $errors = [];  
    if (strlen($newPass) < 8) $errors[] = "New password length is invalid!";  
    if (strlen($newPass2) < 8) $errors[] = "Confirm new password length is invalid!";  
    if ($newPass !== $newPass2) $errors[] = "Passwords do not match!";  
    return $errors;  
}  

function validateUserUpdate($name, $family) {  
    $errors = [];  
    if (strlen($name) < 2) $errors[] = "Name User Invalid";  
    if (strlen($family) < 3) $errors[] = "Family User Invalid";  
    return $errors;  
}     
?>