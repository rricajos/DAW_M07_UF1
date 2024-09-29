<?php
include_once '../model/Prestamo.php';  // Modelo Prestamo
include_once 'DAO.php';  // Interfaz DAO

class PrestamoDAO implements DAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Implementar el método insert
    public function insert($prestamo) {
        $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iiss", $prestamo->getUsuarioId(), $prestamo->getLibroId(), $prestamo->getFechaPrestamo(), $prestamo->getFechaDevolucion());
        return $stmt->execute();
    }

    // Implementar el método update
    public function update($prestamo) {
        $sql = "UPDATE prestamos SET fecha_devolucion = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $prestamo->getFechaDevolucion(), $prestamo->getId());
        return $stmt->execute();
    }

    // Implementar el método delete
    public function delete($id) {
        $sql = "DELETE FROM prestamos WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Implementar el método findById
    public function findById($id) {
        $sql = "SELECT * FROM prestamos WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return new Prestamo($fila['id'], $fila['usuario_id'], $fila['libro_id'], $fila['fecha_prestamo'], $fila['fecha_devolucion']);
        }
        return null;
    }

    // Implementar el método findAll
    public function findAll() {
        $sql = "SELECT * FROM prestamos";
        $resultado = $this->conexion->query($sql);

        $prestamos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $prestamos[] = new Prestamo($fila['id'], $fila['usuario_id'], $fila['libro_id'], $fila['fecha_prestamo'], $fila['fecha_devolucion']);
        }
        return $prestamos;
    }
}
?>
