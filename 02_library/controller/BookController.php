<?php

include_once __DIR__ . '/../dao/BookDAO.php';
class BookController
{
    private $bookDAO;

    public function __construct()
    {
        $this->bookDAO = new BookDAO();
    }

    public function registrarBook($titulo, $autor, $disponibilidad)
    {
        $libro = new Book(null, $titulo, $autor, $disponibilidad);
        if ($this->bookDAO->agregarBook($libro)) {
            return "Book registrado exitosamente.";
        } else {
            return "Error al registrar libro.";
        }
    }
    public function session($book_id)
    {
        $_SESSION["book_id"] = $book_id;
    }
    
    public function book($id)
    {
        return $this->bookDAO->findById($id);
    }

    public function booksArr()
    {
        return $this->bookDAO->findAll();
    }
}
?>