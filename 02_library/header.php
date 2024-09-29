<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .superheader {
      background-color: #eee;
      width: 100%;
      padding: 1rem;
    }

    .superheader>* {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;

      display: flex;
      flex-flow: row nowrap;
      justify-content: space-between;
    }

    .supernav-div {

      display: flex;
      flex-flow: row nowrap;
      gap: 1rem;
    }

    .supercontainer {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    }

    /* Para navegadores webkit (Chrome, Safari) */
    ::-webkit-scrollbar {
      width: 0;
      background: transparent;
    }
  </style>
</head>

<body></body>
<header class="superheader">
  <h1>Bibliotecarium</h1>
  <nav class="supernav">

    <div class="supernav-div">
      <a href="index.php">Home</a>
      <a href="books.php">Books</a>
      <a href="prestamos.php">Offices</a>
      <a href="prestamos.php">AIWritter</a>
      <a href="prestamos.php">Work with us</a>
    </div>

    <div class="supernav-div">
      <?php if (isset($_SESSION['id'])): ?>
        <a href="user.php">@<?php echo htmlspecialchars($_SESSION['name']); ?></a>

      <?php else: ?>
        <a href="user.php">Sign In / Up</a>

      <?php endif; ?>
    </div>


  </nav>
</header>