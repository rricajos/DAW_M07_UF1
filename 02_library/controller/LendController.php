<?php
include_once 'LendDAO.php';

class LendController {
    private $prestamoDAO;

    public function __construct($db) {
        $this->prestamoDAO = new LendDAO($db);
    }

    public function registrarLend($usuario_id, $libro_id, $fecha_prestamo) {
        $prestamo = new Lend(null, $usuario_id, $libro_id, $fecha_prestamo);
        if ($this->prestamoDAO->agregarLend($prestamo)) {
            return "Préstamo registrado exitosamente.";
        } else {
            return "Error al registrar préstamo.";
        }
    }

    public function listarLends() {
        return $this->prestamoDAO->obtenerLends();
    }
}
?>
