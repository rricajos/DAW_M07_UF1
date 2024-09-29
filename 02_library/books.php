
<?php include_once "header.php" ?>
<!-- <body> -->

<?php 
  if (isset($_POST["book_id"])) {
    $_SESSION["book_id"] = $_POST["book_id"];
  }
  
  if(!isset($_SESSION["book_id"]) || $_SESSION["book_id"] === null) {
    include_once "views/BooksView.php";

  } else {
    include_once "views/BookView.php";
  }
  ?>

<!-- </body> -->
<?php include_once "footer.php" ?>
