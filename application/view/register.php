<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="/public/img/logo.svg" type="image/icon type">
    <link rel="stylesheet" href="/public/css/register.css">
  </head>
  <body>
    <!-- Main container -->
    <div class="main-container">

      <!-- Register container -->
      <div class="register-container">
        <div class="page-wrapper register-content-wrap">
          <div class="register-content">
            <div class="left-container">
              <div class="logo">
                <img src="/public/img/logo.svg" alt="">
              </div>
              <div class="title-head">
                <h1>E-LIBRARY.</h1>
              </div>
            </div>
            <div class="right-container">
              <div class="error-msg">
                <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
              </div>
              <h2>Register</h2>
              
              <!-- Form container -->
              <div class="form-container">
                <form action="/register/signup" method="post">
                  <div class="form-input">
                    <label for="fname">Name</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" onblur="validateName()" value="<?php if(isset($_POST["name"])) { echo $_POST["name"]; } ?>">
                    <span class="error" id="checkName"><?php if(isset($GLOBALS["errorMsg"]["nameErr"])) { echo $GLOBALS["errorMsg"]["nameErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="phone">Contact Number</label>
                    <input type="text" name="phone" id="phone" placeholder="Contact Number" onblur="validatePhone()" value="<?php if(isset($_POST["phone"])) { echo $_POST["phone"]; } ?>">
                    <span class="error" id="checkPhone"><?php if(isset($GLOBALS["errorMsg"]["phoneErr"])) { echo $GLOBALS["errorMsg"]["phoneErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()" value="<?php if(isset($_POST["email"])) { echo $_POST["email"]; } ?>">
                    <span class="error" id="checkEmail"><?php if(isset($GLOBALS["errorMsg"]["emailErr"])) { echo $GLOBALS["errorMsg"]["emailErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" onblur="validatePassword()">
                    <span class="error" id="checkPass"><?php if(isset($GLOBALS["errorMsg"]["passwordErr"])) { echo $GLOBALS["errorMsg"]["passwordErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="cnfpassword" id="cnfpassword" placeholder="Password" onblur="matchPassword()">
                    <span class="error" id="checkCnfPass"><?php if(isset($GLOBALS["errorMsg"]["cnfpasswordErr"])) { echo $GLOBALS["errorMsg"]["cnfpasswordErr"]; } ?></span>
                  </div>
  
                  <div class="form-input">
                    <input type="submit" name="register" id="submit-btn" value="Sign Up">
                  </div>
                </form>
              </div>
              <div class="signin-container">
                <p>Already have an account?</p>
                <a href="/home/login">Sign In</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/public/js/script.js"></script>
  </body>
</html>