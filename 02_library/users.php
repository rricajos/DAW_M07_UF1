<?php
session_start();
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 'admin') {
  header(header: "Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users Panel</title>
</head>

<body>
<table border="1">
        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php 
       include_once "controller/UserController.php";
       $controller = new UserController();
       $users = $controller->usersArr();

        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user->getId() . "</td>";
            echo "<td>" . $user->getRol() . "</td>";
            echo "<td>" . $user->getName() . "</td>";
            echo "<td>" . $user->getEmail() . "</td>";
            echo "<td>" . $user->getAnnonAlgoritmPassword() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>
