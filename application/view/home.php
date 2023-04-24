<?php
  require 'application/view/header.php';
?>

<!-- Book container -->
<div class="book-container">
  <div class="page-wrapper book-wrap">
    <div class="book-content">
    <div class="book-option">
      <div class="left-container">
        <label for="sort">Sort Books:</label>
        <select name="sort" id="sort">
          <option value="price" id="price">Price</option>
          <option value="author" id="author">Author</option>
        </select>
      </div>
      <div class="right-container" id="search-bar">
        <label for="search">Search Box</label>
        <input type="text" name="search-box" id="search-box" placeholder="Search books by name, author." value="">
      </div>
    </div>
      <div class="book-list" id="booklist">
      </div>
    </div>
  </div>
</div>

<?php
  require 'application/view/footer.php';
?>