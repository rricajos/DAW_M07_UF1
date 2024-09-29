<?php 

session_start();
$_SESSION["book_id"] = null; 
header(("Location: ../books.php"));
exit();

?>
