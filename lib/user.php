<?php
class User {
    private Database $db;
    private $secret_key;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->secret_key = "@@darkday@@2";
    }

    public function register(string $name, string $family, string $userName, string $userPass, string $captcha, string $captcharandom, bool $isRebot): array {
        $errors = $this->validateInput($name, $family, $userName, $userPass, $captcha, $captcharandom, $isRebot);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $pass = md5($this->secret_key.$userPass.$this->secret_key);

        $query = "SELECT COUNT(*) FROM `student` WHERE `username` = ?";
        if ($this->db->checkExists($query, [$userName])) {
            return ['success' => false, 'message' => 'Username already exists!'];
        }

        $insertQuery = "INSERT INTO `student`(`name-user`, `family-user`, `type-user`, `username`, `password`, `type`) VALUES (?, ?, 'User', ?, ?, 'true')";
        $stmt = $this->db->runQuery($insertQuery, [$name, $family, $userName, $pass]);

        return $stmt ? ['success' => true, 'message' => 'Registration successful!'] : ['success' => false, 'message' => 'Could not register user.'];
    }

    public function login(string $userName, string $userPass, string $captcha, string $captcharandom, bool $isRebot): array {
        $errors = $this->validateLoginInput($userName, $userPass, $captcha, $captcharandom, $isRebot);
        $pass = md5($this->secret_key.$userPass.$this->secret_key);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $query = "SELECT `username`, `password`, `type`, `type-user` FROM `student` WHERE `username` = ?";
        $stmt = $this->db->runQuery($query, [$userName]);

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if ($pass != $row["password"]) {
                return ['success' => false, 'message' => 'Invalid username or password'];
            }

            if ($row['type'] !== 'true') {
                return ['success' => false, 'message' => 'User is inactive!'];
            }

            // if ($row['type-user'] !== 'User') {
            //     return ['success' => false, 'message' => 'Invalid user type!'];
            // }

            return ['success' => true, 'message' => 'Login successful!'];
        }

        return ['success' => false, 'message' => 'Invalid username or password'];
    }

    private function validateInput(string $name, string $family, string $userName, string $userPass, string $captcha, string $captcharandom, bool $isRebot): array {
        $errors = [];

        if (strlen($name) < 2) $errors[] = "Invalid name!";
        if (strlen($family) < 3) $errors[] = "Invalid family!";
        if (strlen($userName) < 8) $errors[] = "Invalid username! Must be at least 8 characters.";
        if (strlen($userPass) < 8) $errors[] = "Invalid password! Must be at least 8 characters.";
        if ($captcha !== $captcharandom) $errors[] = "Invalid captcha value!";
        if (!$isRebot) $errors[] = "You are a robot!";

        return $errors;
    }

    private function validateLoginInput(string $userName, string $userPass, string $captcha, string $captcharandom, bool $isRebot): array {
        $errors = [];

        if (strlen($userName) < 8) $errors[] = "Invalid username! Must be at least 8 characters.";
        if (strlen($userPass) < 8) $errors[] = "Invalid password! Must be at least 8 characters.";
        if ($captcha !== $captcharandom) $errors[] = "Invalid captcha value!";
        if (!$isRebot) $errors[] = "You are a robot!";

        return $errors;
    }
}