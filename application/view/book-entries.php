<?php
  require 'application/view/header.php';
?>

<!-- Book entry container -->
<div class="book-entry-container">
  <div class="page-wrapper book-entry-content-wrap">
    <div class="book-entry-content">
      <div class="title-head">
        <h1>Add Books.</h1>
      </div>
      </div>
      <div class="right-container">
        <div class="error-msg">
          <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
        </div>
        <h2>Register</h2>
        
        <!-- Form container -->
        <div class="form-container">
          <form action="/admin/bookEntry" method="post" enctype="multipart/form-data">
            <div class="form-input">
              <label for="fname">Title</label>
              <input type="text" name="title" id="title" placeholder="Book title" onblur="validateName()" value="<?php if(isset($_POST["title"])) { echo $_POST["title"]; } ?>">
              <span class="error" id="checkName"></span>
            </div>

            <div class="form-input">
              <label for="author">Author</label>
              <input type="text" name="author" id="author" placeholder="Book author" onblur="validateName()" value="<?php if(isset($_POST["author"])) { echo $_POST["author"]; } ?>">
              <span class="error" id="checkAuthor"></span>
            </div>

            <div class="form-input">
              <label for="description">Description</label>
              <input type="text" name="description" id="description" placeholder="Book description" onblur="validateName()" value="<?php if(isset($_POST["description"])) { echo $_POST["description"]; } ?>">
              <span class="error" id="checkDescription"></span>
            </div>

            <div class="form-input">
              <label for="cost">Cost</label>
              <input type="text" name="cost" id="cost" placeholder="Book cost" value="<?php if(isset($_POST["description"])) { echo $_POST["description"]; } ?>">
              <span class="error" id="checkCost"></span>
            </div>

            <div class="form-input">
              <label for="image">Image</label>
              <input type="file" name="image" id="image">
              <span class="error" id="checkImage"></span>
            </div>

            <div class="form-input">
              <input type="submit" name="add-book" id="submit-btn" value="Add Book">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  require 'application/view/footer.php';
?>