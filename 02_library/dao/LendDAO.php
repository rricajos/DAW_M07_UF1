<?php
include_once '../model/Lend.php';  // Modelo Lend
include_once 'DAO.php';  // Interfaz DAO

class LendDAO implements DAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Implementar el método insert
    public function insert($prestamo) {
        $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $prestamo->getUserId(), $prestamo->getBookId(), $prestamo->getFechaLend(), $prestamo->getFechaDevolucion());
        return $stmt->execute();
    }

    // Implementar el método update
    public function update($prestamo) {
        $sql = "UPDATE prestamos SET fecha_devolucion = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $prestamo->getFechaDevolucion(), $prestamo->getId());
        return $stmt->execute();
    }

    // Implementar el método delete
    public function delete($id) {
        $sql = "DELETE FROM prestamos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Implementar el método findById
    public function findById($id) {
        $sql = "SELECT * FROM prestamos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return new Lend($fila['id'], $fila['usuario_id'], $fila['libro_id'], $fila['fecha_prestamo'], $fila['fecha_devolucion']);
        }
        return null;
    }

    // Implementar el método findAll
    public function findAll() {
        $sql = "SELECT * FROM prestamos";
        $resultado = $this->conn->query($sql);

        $prestamos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $prestamos[] = new Lend($fila['id'], $fila['usuario_id'], $fila['libro_id'], $fila['fecha_prestamo'], $fila['fecha_devolucion']);
        }
        return $prestamos;
    }
}
?>
