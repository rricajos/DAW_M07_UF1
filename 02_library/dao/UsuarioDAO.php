<?php
include_once '../model/Usuario.php';  // Modelo Usuario
include_once 'DAO.php';  // Interfaz DAO

class UsuarioDAO implements DAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Implementar el método insert
    public function insert($usuario) {
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $contraseñaHash = password_hash($usuario->getContraseña(), PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $usuario->getNombre(), $usuario->getEmail(), $contraseñaHash, $usuario->getRol());
        return $stmt->execute();
    }

    // Implementar el método update
    public function update($usuario) {
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, contraseña = ?, rol = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $contraseñaHash = password_hash($usuario->getContraseña(), PASSWORD_DEFAULT);
        $stmt->bind_param("ssssi", $usuario->getNombre(), $usuario->getEmail(), $contraseñaHash, $usuario->getRol(), $usuario->getId());
        return $stmt->execute();
    }

    // Implementar el método delete
    public function delete($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Implementar el método findById
    public function findById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return new Usuario($fila['id'], $fila['nombre'], $fila['email'], $fila['contraseña'], $fila['rol']);
        }
        return null;
    }

    // Implementar el método findAll
    public function findAll() {
        $sql = "SELECT * FROM usuarios";
        $resultado = $this->conexion->query($sql);

        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = new Usuario($fila['id'], $fila['nombre'], $fila['email'], $fila['contraseña'], $fila['rol']);
        }
        return $usuarios;
    }
}
?>
