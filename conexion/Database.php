<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "integrador5";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function escape($value) {
        return $this->conn->real_escape_string($value);
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function getLastInsertID() {
        return $this->conn->insert_id;
    }

    public function close() {
        $this->conn->close();
    }
}
?>
