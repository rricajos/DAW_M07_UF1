<?php
class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $rol;

    // Constructor
    public function __construct($id, $name, $email, $password, $rol)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    // Métodos getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAnnonAlgoritmPassword()
    {
        return substr($this->password, 7);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }
}
?>