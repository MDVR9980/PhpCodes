<?php  
class User {  
    private $db;  
    private $secret_key = "@@darkday@@";  

    public function __construct(Database $db) {  
        $this->db = $db;  
    }  

    public function register($name, $family, $userName, $userPass, $captcha, $captcharandom, $isrebot) {  
        $errors = $this->validateInput($name, $family, $userName, $userPass, $captcha, $captcharandom, $isrebot);  

        if (!empty($errors)) {  
            return ['success' => false, 'errors' => $errors];  
        }  

        // Password hashing  
        $pass = md5($this->secret_key . $userPass . $this->secret_key);  

        // Check if username exists  
        $query = "SELECT * FROM `student` WHERE `username` = ?";  
        if ($this->db->checkExists($query, [$userName])) {  
            return ['success' => false, 'message' => 'Current username already exists!'];  
        }  

        // Insert the new user  
        $insertQuery = "INSERT INTO `student`(`name-user`, `family-user`, `type-user`, `username`, `password`, `type`) VALUES (?, ?,'User', ?, ?, 'true')";  
        if ($this->db->runQuery($insertQuery, [$name, $family, $userName, $pass])) {  
            return ['success' => true, 'message' => 'Registration successful!'];  
        }  

        return ['success' => false, 'message' => 'Could not register user.'];  
    }  

    private function validateInput($name, $family, $userName, $userPass, $captcha, $captcharandom, $isrebot) {  
        $errors = [];  

        if (strlen($name) < 2) $errors[] = "Invalid name!";  
        if (strlen($family) < 3) $errors[] = "Invalid family!";  
        if (strlen($userName) < 8) $errors[] = "Invalid username!";  
        if (strlen($userPass) < 8) $errors[] = "Invalid password!";  
        if ($captcha != $captcharandom) $errors[] = "Invalid captcha value!";  
        if (!$isrebot) $errors[] = "You are a robot!";  

        return $errors;  
    }  
}  
?>