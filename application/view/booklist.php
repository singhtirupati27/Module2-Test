<?php
  $book = $_SESSION["loadBooks"];
  $num_of_rows = $_SESSION["rowCount"];

  $page = "";

  if(isset($_POST["page_no"])) {
    $page = $_POST["page_no"];
  }
  else {
    $page = 1;
  }

  $total_pages = ceil($num_of_rows/8);

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
    <p>Price: ₹<?php echo $value['book_cost'] ?></p>
  </div>
</div>

<?php
    }
  }
  else {
?>

<div class="book-box">
  <h2>No book found</h2>
</div>

<?php
  }
?>

<div class="page-num" id="pagination">
  <?php
    for($i = 1; $i <= $total_pages; $i++) {
      if($i == $page) {
        $class_name = "active";
      }
      else {
        $class_name = "inactive";
      }
  ?>
  <a class='<?php echo $class_name ?>' id='<?php echo $i ?>' href=''><?php echo $i ?></a>
  <?php
    }
  ?>
</div>