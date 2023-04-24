<?php
  $_SESSION["message"] = "";

  /**
   * Register controller class to register user.
   */
  class Register extends Framework {
    /**
     *  @var object $validation
     *    Stores validations class object.
     * 
     *  @var object $database
     *    Store database class object.
     */
    public object $validation;
    public object $database;

    /**
     * Contructor to create database and validation object.
     */
    public function __construct() {
      $this->model("Validations");
      $this->model("Database");
      $this->validation = new Validations();
      $this->database = new Database();
    }

    /**
     * Function to register user.
     */
    public function register() {
      // Check if login button has been clicked or not.
      if (isset($_POST["register"])) {
        if ($this->validation->checkRegistration($_POST)
          && !$this->database->checkUserNameExists($_POST["email"])
          && !$this->database->checkUserContactExists($_POST["phone"])) {
          if ($this->database->registerUser($_POST)) {
            $_SESSION["message"] = "Account created successfully";
            $this->view("login");
          }
        }
        else {
          $GLOBALS["errorMsg"] = ["nameErr" => $this->validation->nameErr,
            "emailErr" => $this->validation->emailErr,
            "phoneErr" => $this->validation->phoneErr,
            "passwordErr" => $this->validation->passwordErr,
            "cnfPasswordErr" => $this->validation->cnfPasswordErr,
          ];
          $_SESSION["message"] = "User already exists!";
          $this->view("register");
        }
      }
    }
  }
?>