<?php

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim(string: $_POST['password']);

if (empty($email) || empty($name) || empty($password)) {
    header('Location: user.php');

}


include_once 'controller/UserController.php';

$controller = new UserController();


if ($controller->signup($name, $email, $password, "usuario")) {

    $controller->session($email);


}
header('Location: user.php');
exit();

?>