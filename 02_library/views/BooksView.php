<style>
  * {
    box-sizing: border-box;
  }

  .book_cards_container {
    padding: 0.5em;
    display: grid;
    gap: 0.5em;
    grid-template-columns: repeat(auto-fit, minmax(10em, 1fr));
    transition: .3s;
  }

  .book_card {
    display: flex;
    flex-flow: column nowrap;
    padding: 0.5em;
    border-radius: 0.5em;
    background-color: #eee;
    width: 100%;
    height: 100%;
    box-shadow: 0.2px 0.2px 0.2px black;
    text-align: left;

  }
  
  .book_card:hover {
    transform: scale(0.95);
    cursor: pointer;
   
  }

  .book_card_cover_container {
    width: 100%;
  }
  .book_card_cover {
    max-width: 100%;
  }
  .book_card_title {
    margin: 0;
    font-size: 1.2em;
  }

  .book_card_author {
    margin: 0;
    font-size: 1em;
    color: #555;
  }

  .book_card button {
    border: none;
    background: none;
    padding: 0;
    width: 100%;
    text-align: left;
  }
</style>


<section class="supercontainer">
  <div class="book_cards_container">
    <?php
    include_once "controller/BookController.php";

    $controller = new BookController();
    $books = $controller->booksArr();

    for ($i = 0; $i < sizeof($books); $i++) {
      $book = $books[$i];
      ?>

      <form action="books.php" method="post">
        <input type="hidden" name="book_id" value="<?php echo $book->getId(); ?>">
        <button type="submit" class="book_card">

          <span>#<?php echo $book->getId(); ?></span>
          <div class="book_card_cover_container">
          <img class="book_card_cover" 
            src="https://imgs.search.brave.com/EeHFJfwNU5iLHe9YONjJUhSF5YPiwIEm8DmrD9uptyE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMtbmEuc3NsLWlt/YWdlcy1hbWF6b24u/Y29tL2ltYWdlcy9J/LzUxbFZ2U0RMUUpM/LmpwZw" 
            alt="ruiseñor">
          </div>
          
          <h3 class="book_card_title"><?php echo $book->getTitle(); ?></h3>
          <h4 class="book_card_author"><?php echo $book->getAuthor(); ?></h4>

        </button>
      </form>

      <?php
    }
    ?>
  </div>

</section>