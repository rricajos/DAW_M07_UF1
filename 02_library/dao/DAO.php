<?php
interface DAO {
    // Método para insertar una nueva entidad en la base de datos
    public function insert($entity);

    // Método para actualizar una entidad existente
    public function update($entity);

    // Método para eliminar una entidad por su ID
    public function delete($id);

    // Método para encontrar una entidad por su ID
    public function findById($id);

    // Método para obtener todas las entidades
    public function findAll();
}
?>
