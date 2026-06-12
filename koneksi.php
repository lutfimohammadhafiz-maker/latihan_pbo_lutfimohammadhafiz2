<?php
// koneksi.php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_latihan_pbo_trpl1a_lutfimhafiz";
    private $connection;
    
    // Constructor
    public function __construct() {
        $this->connect();
    }
    
    // Encapsulation: private method untuk koneksi
    private function connect() {
        try {
            $this->connection = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->database
            );
            
            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    // Encapsulation: getter untuk connection
    public function getConnection() {
        return $this->connection;
    }
    
    // Method untuk menutup koneksi
    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
    
    // Destructor
    public function __destruct() {
        $this->closeConnection();
    }
}
?>