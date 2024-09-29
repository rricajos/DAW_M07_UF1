<?php

class Connector {
    private $host = 'localhost';
    private $database = 'biblioteca';
    private $username = 'bibliotecario';
    private $password = 'bibliotecario';
    private $conn;

    public function connect() {
        if ($this->conn === null) { // Solo crear una nueva conexión si no existe
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception) {
                echo "Error de conexión: " . $exception->getMessage();
                exit();
            }
        }
        return $this->conn;
    }
}
?>
