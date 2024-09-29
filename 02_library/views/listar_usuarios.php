<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Users</title>
</head>
<body>
    <h1>Lista de Users</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
        <?php
        include_once '../Connection.php';
        include_once '../controller/UserController.php';

        $conn = new Connection();
        $db = $conn->conectar();
        $usuarioController = new UserController($db);

        $usuarios = $usuarioController->listarUsers();
        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario->getId() . "</td>";
            echo "<td>" . $usuario->getNombre() . "</td>";
            echo "<td>" . $usuario->getEmail() . "</td>";
            echo "<td>" . $usuario->getRol() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
