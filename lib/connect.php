<?php
class Database {
    private $mysqli;

    public function __construct($host, $user, $pass, $dbname) {
        $this->mysqli = new mysqli($host, $user, $pass, $dbname);

        if ($this->mysqli->connect_error) {
            die('Connection failed: ' . $this->mysqli->connect_error);
        }
    }

    public function runQuery($sql, $params = []) {
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Query preparation failed: ' . $this->mysqli->error);
        }

        if ($params) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception('Query execution failed: ' . $stmt->error);
        }

        return $stmt;
    }

    public function runQuery2($sql, $params = []) {
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Query preparation failed: ' . $this->mysqli->error);
        }

        if ($params) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception('Query execution failed: ' . $stmt->error);
        }

        $result = $stmt->get_result(); // گرفتن نتیجه
        if ($result === false) {
            return $stmt; // اگر نتیجه‌ای وجود نداشت، همان stmt برگردانده می‌شود
        }

        return $result; // برگرداندن نتیجه
    }


    public function checkExists($sql, $params = []) {
        $stmt = $this->runQuery($sql, $params);
        $stmt->store_result();
        return $stmt->num_rows == 0; // تغییر این خط برای بررسی صحیح وجود داده
    }

    public function __destruct() {
        $this->mysqli->close();
    }
}