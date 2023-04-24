<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Log In</title>
    <link rel="icon" href="" type="image/icon type">
    <link rel="stylesheet" href="/public/css/login.css">
  </head>
  <body>
    <!-- Main container -->
    <div class="main-container">

    <!-- Login container -->
      <div class="login-container">
        <div class="page-wrapper login-content-wrap">
          <div class="login-content">
            <div class="error-msg">
              <span><?php if (isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
            </div>
            <div class="logo">
              <img src="" alt="E-Library">
            </div>
            <div class="title-head">
              <h1>Admin Login</h1>
            </div>

            <!-- Form container -->
            <div class="form-container">
              <form action="/admin/login" method="post">
                <div class="form-input">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" placeholder="Enter your email" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; } ?>" onblur="validateEmail()">
                  <span class="error"><?php if (isset($GLOBALS["emailErr"])) {echo $GLOBALS["emailErr"];} ?></span>
                  <span class="error" id="checkEmail"></span>
                </div>

                <div class="form-input">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" placeholder="Password" onblur="validatePassword()">
                  <span class="error"><?php if (isset($GLOBALS["passwordErr"])) {echo $GLOBALS["passwordErr"];} ?></span>
                  <span class="error" id="checkPass"></span>
                </div>

                <div class="form-input">
                  <input type="submit" name="login" id="submit-btn" value="Sign In">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/public/js/validations.js"></script>
  </body>
</html>
