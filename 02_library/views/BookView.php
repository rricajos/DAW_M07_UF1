<style>
  * {
    box-sizing: border-box;
  }

  .book_full_container {
    display: flex;
    flex-flow: column nowrap;
    gap: 0.5em;
    margin: 0.5em;
    padding: 0.5em;
    width: auto;
    background-color: #eee;
  }

  .book_card:hover {
    transform: scale(0.95);
    cursor: pointer;
  }

  .book_full_title {
    margin: 0;
  }

  .book_full_author {
    margin: 0;
  }
</style>


<nav class="supercontainer book_full_nav">
  <form action="views/BooksViewBack.php" method="post">
    <button type="submit"><- Back</button>
  </form>
</nav>

<article class="supercontainer">
  <div class=" book_full_container">
    <?php
    include_once "controller/BookController.php";

    $controller = new BookController();
    if (isset($_POST["book_id"])) {
      $book = $controller->book($_POST["book_id"]);

    } else {
      $book = $controller->book($_SESSION["book_id"]);
    }


    ?>
    <h2 class="book_full_title"><?php echo $book->getTitle() ?></h2>
    <h3 class="book_full_author"><?php echo $book->getAuthor() ?></h3>


  </div>

</article>
<?php exit ?>