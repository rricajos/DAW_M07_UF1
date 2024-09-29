<?php
class Lend {
    private $id;
    private $usuario_id;
    private $libro_id;
    private $fecha_prestamo;
    private $fecha_devolucion;

    // Constructor
    public function __construct($id, $usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion = null) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->libro_id = $libro_id;
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_devolucion = $fecha_devolucion;
    }

    // Métodos getters y setters

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->usuario_id;
    }

    public function setUserId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function getBookId() {
        return $this->libro_id;
    }

    public function setBookId($libro_id) {
        $this->libro_id = $libro_id;
    }

    public function getFechaLend() {
        return $this->fecha_prestamo;
    }

    public function setFechaLend($fecha_prestamo) {
        $this->fecha_prestamo = $fecha_prestamo;
    }

    public function getFechaDevolucion() {
        return $this->fecha_devolucion;
    }

    public function setFechaDevolucion($fecha_devolucion) {
        $this->fecha_devolucion = $fecha_devolucion;
    }
}
?>
