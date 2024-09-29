<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar User</title>
</head>
<body>
    <h1>Registrar User</h1>
    <form action="procesar_registro_usuario.php" method="post">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="usuario">User</option>
            <option value="administrador">Administrador</option>
        </select>
        <br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
