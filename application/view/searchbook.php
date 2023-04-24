<?php
  $book = $_SESSION["searchedBookData"];

  if(!empty($book)) {
    foreach($book as $value) {
?>

<div class="book-box">
  <div class="book-cover-img">
    <img src="/<?php echo $value['book_image'] ?>" alt="<?php $value['book_title'] ?>">
  </div>
  <div class="book-details">
    <h3><?php echo $value['book_title'] ?></h3>
    <h3>Author: <?php echo $value['book_author'] ?></h3>
    <h4>Description: <?php echo $value['book_description'] ?></h4>
    <p>Price: <?php echo $value['book_cost'] ?></p>
  </div>
</div>

<?php
    }
  }
  else {
?>

<div class="book-box">
  <h2>No book matched</h2>
</div>

<?php
  }
?>

</div>