<?php
include_once '../model/Libro.php';  // Modelo Libro
include_once 'DAO.php';  // Interfaz DAO

class LibroDAO implements DAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Implementar el método insert
    public function insert($libro) {
        $sql = "INSERT INTO libros (titulo, autor, disponibilidad) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssi", $libro->getTitulo(), $libro->getAutor(), $libro->getDisponibilidad());
        return $stmt->execute();
    }

    // Implementar el método update
    public function update($libro) {
        $sql = "UPDATE libros SET titulo = ?, autor = ?, disponibilidad = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssii", $libro->getTitulo(), $libro->getAutor(), $libro->getDisponibilidad(), $libro->getId());
        return $stmt->execute();
    }

    // Implementar el método delete
    public function delete($id) {
        $sql = "DELETE FROM libros WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Implementar el método findById
    public function findById($id) {
        $sql = "SELECT * FROM libros WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return new Libro($fila['id'], $fila['titulo'], $fila['autor'], $fila['disponibilidad']);
        }
        return null;
    }

    // Implementar el método findAll
    public function findAll() {
        $sql = "SELECT * FROM libros";
        $resultado = $this->conexion->query($sql);

        $libros = [];
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = new Libro($fila['id'], $fila['titulo'], $fila['autor'], $fila['disponibilidad']);
        }
        return $libros;
    }
}
?>
