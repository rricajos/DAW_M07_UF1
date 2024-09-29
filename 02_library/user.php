<?php include_once "header.php"; ?>

<div class="supercontainer">

  <?php if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    include_once "views/UserViewSign.php";
  } else {
    include_once "views/UserViewSubNav.php";
  }
  ?>
</div>

<?php include_once "footer.php"; ?>
</body>

</html>