<?php
include_once '_Connector.php';
include_once __DIR__ . '/../model/User.php';
include_once 'DAO.php';

class UserDAO implements DAO
{
    private $connector;
    private $conn;

    public function __construct()
    {
        $this->connector = new Connector();
        $this->conn = $this->connector->connect();

    }

    // Implementar el método insert
    public function insert($usuario)
    {
        try {
            $sql = "INSERT INTO users (name, email, password, rol) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $passwordHash = password_hash($usuario->getPassword(), PASSWORD_DEFAULT);

            // Usar bindValue con PDO
            $stmt->bindValue(1, $usuario->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $usuario->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(3, $passwordHash, PDO::PARAM_STR);
            $stmt->bindValue(4, $usuario->getRol(), PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    // Implementar el método update
    public function update($usuario)
    {
        $sql = "UPDATE users SET name = ?, email = ?, password = ?, rol = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $passwordHash = password_hash($usuario->getPassword(), PASSWORD_DEFAULT);

        // Usar bindValue en lugar de bind_param
        $stmt->bindValue(1, $usuario->getName(), PDO::PARAM_STR);
        $stmt->bindValue(2, $usuario->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(3, $passwordHash, PDO::PARAM_STR);
        $stmt->bindValue(4, $usuario->getRol(), PDO::PARAM_STR);
        $stmt->bindValue(5, $usuario->getId(), PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Implementar el método delete
    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        // Enlazar el ID como entero
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Implementar el método findById
    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        // Enlazar el ID
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            return new User($fila['id'], $fila['name'], $fila['email'], $fila['password'], $fila['rol']);
        }
        return null;
    }

    // Implementar el método findByEmail
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);

        // Enlazar el email
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener el resultado
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            return new User($fila['id'], $fila['name'], $fila['email'], $fila['password'], $fila['rol']);
        }
        return null;
    }

    // Implementar el método findAll
    public function findAll()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Obtener todas las filas
        $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuarios = [];

        foreach ($filas as $fila) {
            // Crear un nuevo objeto User y añadirlo al array
            $usuarios[] = new User($fila['id'], $fila['name'], $fila['email'], $fila['password'], $fila['rol']);
        }

        return $usuarios;
    }

    public function updatePassword($userId, $newPasswordHash)
    {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $newPasswordHash, PDO::PARAM_STR);
        $stmt->bindValue(2, $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
?>