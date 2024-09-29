<?php
class Book {
    private $id;
    private $title;
    private $author;
    private $availability;

    // Constructor
    public function __construct($id, $title, $author, $availability) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->availability = $availability;
    }

    // Métodos getters y setters

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getAvailability() {
        return $this->availability;
    }

    public function setAvailability($availability) {
        $this->availability = $availability;
    }
}
?>
