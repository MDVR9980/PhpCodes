<?php  
class Database {  
    private $conn;  

    public function __construct($host, $user, $password, $dbname) {  
        $this->conn = new mysqli($host, $user, $password, $dbname);  
        if ($this->conn->connect_error) {  
            die(json_encode(['success' => false, 'errors' => ['Database connection failed!']]));  
        }  
    }  

    public function runQuery($query, $params = []) {  
        $stmt = $this->conn->prepare($query);  
        if ($params) {  
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);  
        }  
        $stmt->execute();  
        return $stmt;  
    }  

    public function checkExists($query, $params = []) {  
        $stmt = $this->runQuery($query, $params);  
        return $stmt->get_result()->num_rows > 0;  
    }  

    public function close() {  
        $this->conn->close();  
    }  
}  
?>