<?php

include_once __DIR__ . '/../dao/UserDAO.php';


class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function session($email)
    {
        $user = $this->userDAO->findByEmail($email);

        $_SESSION['id'] = $user->getId();
        $_SESSION['name'] = $user->getName();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['password'] = $user->getPassword(); 
        $_SESSION['rol'] = $user->getRol();

    }

    public function signin($email, $password)
    {
        $user = $this->userDAO->findByEmail($email);

        return $user !== null ?
            password_verify($password, $user->getPassword())
            :
            false;

    }

    public function signup($name, $email, $password, $rol)
    {
        $user = new User(null, $name, $email, $password, $rol);

        return $this->userDAO->insert($user);
    }

    public function updatePassword($userId, $newPassword)
    {
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        // Usar el UserDAO para actualizar la contraseña en la base de datos
        return $this->userDAO->updatePassword($userId, $passwordHash);
    }


    public function findByEmail($email)
    {
        return $this->userDAO->findByEmail($email);
    }

    public function usersArr()
    {
        return $this->userDAO->findAll();
    }
}

?>