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
          <option value="book_title" id="title">Title (A-Z)</option>
          <option value="book_title DESC" id="title-desc">Title (Z-A)</option>
          <option value="book_author" id="author">Author (A-Z)</option>
          <option value="book_author DESC" id="author-desc">Author (Z-A)</option>
          <option value="book_description" id="description">Description (A-Z)</option>
          <option value="book_description DESC" id="description-desc">Description (Z-A)</option>
          <option value="book_cost" id="price-low">Price Low</option>
          <option value="book_cost DESC" id="price-high">Price High</option>
        </select>
      </div>
      <div class="right-container">
        <label for="search">Search Box</label>
        <input type="text" name="search-box" id="search-box" placeholder="Search books by name, author." value="">
        <div class="search-box">
          <label for="search-in">Search In:</label>
          <select name="search-in" id="search-in">
            <option value="book_title" id="title">Title</option>
            <option value="book_author" id="author">Author</option>
            <option value="book_description" id="description">Description</option>
            <option value="book_cost" id="price">Price</option>
          </select>
        </div>
      </div>
    </div>
      <div class="book-list" id="booklist">
      </div>
      <div id="sorted-book"></div>
    </div>
  </div>
</div>

<?php
  require 'application/view/footer.php';
?>
