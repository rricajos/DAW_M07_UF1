<?php
class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $disponibilidad;

    // Constructor
    public function __construct($id, $titulo, $autor, $disponibilidad) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->disponibilidad = $disponibilidad;
    }

    // Métodos getters y setters

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getDisponibilidad() {
        return $this->disponibilidad;
    }

    public function setDisponibilidad($disponibilidad) {
        $this->disponibilidad = $disponibilidad;
    }
}
?>
