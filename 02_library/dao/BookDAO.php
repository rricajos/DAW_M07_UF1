<?php
include_once '_Connector.php';  // Archivo de conexión a la base de datos
include_once __DIR__ . '/../model/Book.php';  // Modelo de Book
include_once 'DAO.php';  // Interfaz DAO

class BookDAO implements DAO {

    
    private $connector;
    private $conn;

    public function __construct() {
        $this->connector = new Connector();  // Iniciar la conexión
        $this->conn = $this->connector->connect();
    }

    // Implementar el método insert
    public function insert($book) {
        $sql = "INSERT INTO books (title, author, availability) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        // Usamos bindValue con parámetros posicionados, específicos de PDO
        $stmt->bindValue(1, $book->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(2, $book->getAuthor(), PDO::PARAM_STR);
        $stmt->bindValue(3, $book->getAvailability(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Implementar el método update
    public function update($book) {
        $sql = "UPDATE books SET title = ?, author = ?, availability = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(1, $book->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(2, $book->getAuthor(), PDO::PARAM_STR);
        $stmt->bindValue(3, $book->getAvailability(), PDO::PARAM_INT);
        $stmt->bindValue(4, $book->getId(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Implementar el método delete
    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Implementar el método findById
    public function findById($id) {
        $sql = "SELECT * FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Usamos fetch para obtener una fila en PDO
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($fila) {
            return new Book($fila['id'], $fila['title'], $fila['author'], $fila['availability']);
        }
        
        return null;
    }

    // Implementar el método findAll
    public function findAll() {
        $sql = "SELECT * FROM books";
        $stmt = $this->conn->query($sql);  // Ejecuta la consulta directamente
        
        $books = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($fila['id'], $fila['title'], $fila['author'], $fila['availability']);
        }
        
        return $books;
    }
}
