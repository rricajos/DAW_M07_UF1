<?php
class Conexion {
    private $host = 'localhost';   // El host donde está la base de datos, generalmente 'localhost'
    private $db_name = 'biblioteca';  // El nombre de la base de datos
    private $username = 'bibliotecario';  // El nombre de usuario para la conexión a la base de datos
    private $password = 'bibliotecario';  // La contraseña para el usuario de la base de datos
    private $conn;  // Almacena la conexión a la base de datos

    // Método para conectar a la base de datos
    public function conectar() {
        $this->conn = null;

        try {
            // Crear una nueva conexión usando PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

            // Configurar el manejo de errores: que arroje excepciones en caso de error
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $exception) {
            // Si ocurre un error, lo capturamos y mostramos el mensaje
            echo "Error de conexión: " . $exception->getMessage();
        }

        // Devolver la conexión (puede ser null si falla)
        return $this->conn;
    }
}
?>
