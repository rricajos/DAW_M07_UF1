<h3>Id: <?php echo $_SESSION["id"] ?></h3>
<h3>Name: <?php echo $_SESSION["name"] ?></h3>
<h3>Email: <?php echo $_SESSION["email"] ?></h3>
<h3>Rol: <?php echo $_SESSION["rol"] ?></h3>

<form action="cpass.php" method="post">
  <div>
    <label for="newpassword">
      <h3>Contraseña: </h3>
    </label>
    <input type="password" name="newpassword" id="newpassword" placeholder="<?php echo $_SESSION["password"] ?>">

    <button type="submit">Change Password</button>

  </div>
</form>


<form action="signout.php" method="post">
  <button type="submit">Disconnect</button>
</form>