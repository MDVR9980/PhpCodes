<?php  
define("DB_SERVICE", "localhost");  
define("DB_USER", "root");  
define("DB_PASS", "");  
define("DB_DATABASE", "university");  

class mySql {  
    private $conn;  

    public function __construct() {  
        $this->connect();  
    }  

    private function connect() {  
        $this->conn = mysqli_connect(DB_SERVICE, DB_USER, DB_PASS, DB_DATABASE);    
    }  

    public function runQuery($query, $params = []) {  
        $stmt = $this->conn->prepare($query);  
        
        if ($params) {  
            $types = '';  
    
            foreach ($params as $param) {  
                if (is_int($param)) {  
                    $types .= 'i';   
                } elseif (is_double($param)) {  
                    $types .= 'd';   
                } else {  
                    $types .= 's';  
                }  
            }  
    
            $stmt->bind_param($types, ...$params);  
        }  
        $stmt->execute();  
        return $stmt->get_result();  
    }

    public function checkExists($query, $params = []) {  
        $stmt = $this->conn->prepare($query);  
        
        if ($params) {  
            $types = '';  
    
            foreach ($params as $param) {  
                if (is_int($param)) {  
                    $types .= 'i';   
                } elseif (is_double($param)) {  
                    $types .= 'd';
                } else {  
                    $types .= 's';  
                }  
            }  
    
            $stmt->bind_param($types, ...$params);  
        }  
    
        $stmt->execute();  
        $result = $stmt->get_result();  
        return $result->num_rows === 0;  
    }  

    public function __destruct() {  
        if ($this->conn) {  
            $this->conn->close();  
        }  
    }  
}  

$mysql = new mySql();
