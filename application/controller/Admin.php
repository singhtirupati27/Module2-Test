<?php
  session_start();
  $_SESSION["message"] = "";

  /**
   * Admin controller class to load login, addbook and sign out page.
   */
  class Admin extends Framework {
    /**
     *  @var object $validation
     *    Stores validations class object.
     */
    public object $validation;

    /**
     *  @var object $database
     *    Store database class object.
     */
    public object $database;

    /**
     *  @var object $book
     *    Stores book class object.
     */
    public object $book;

    /**
     * Contructor to create database and validation object.
     */
    public function __construct() {
      $this->model("Validations");
      $this->model("Database");
      $this->model("Book");
      $this->validation = new Validations();
      $this->database = new Database();
      $this->book = new Book();
    }

    /**
     * Function to load landing page.
     */
    public function index() {

      // Check if user is already logged in or not.
      if (isset($_SESSION["loggedIn"])) {
        $this->view("book-entries");
      }
      else {
        $this->view("adminlogin");
      }
    }

    /**
     * Function to load admin login page and perform login operation.
     */
    public function login() {
      // Check if admin is already logged in or not.
      if (isset($_SESSION["adminLoggedIn"])) {
        $this->view("book-entries");
      }
      // Check if login button has been clicked or not.
      if (isset($_POST["login"])) {
        $this->validation->validateEmail($_POST["email"]);
        $this->validation->validatePassword($_POST["password"]);
        // Check if input data is valid or not.
        if ($this->validation->dataValid) {
          // Check if admin details exists in database or not.
          if ($this->database->checkAdminLogin($_POST["email"], $_POST["password"])) {
            $_SESSION["adminLoggedIn"] = TRUE;
            $this->view("book-entries");
          }
          else {
            $_SESSION["message"] = "Invalid username or password";
            $this->view("adminlogin");
          }
        }
        else {
          $GLOBALS["emailErr"] = $this->validation->emailErr;
          $GLOBALS["emailErr"] = $this->validation->passwordErr;
        }
      }
    }

    /**
     * Function to add books in book database.
     */
    public function bookEntry() {
      // Check if admin is already logged in or not.
      if (isset($_SESSION["adminLoggedIn"])) {
        $this->view("book-entries");
      }
      // Check if login button has been clicked or not.
      if (isset($_POST["add-book"])) {
        $this->book->validateBook($_POST);
        $this->book->uploadCoverImage($_FILES);
        // Check if uploaded book data is valid or not.
        if ($this->book->uploadOk) {
          // Check whether book data has been added to database or not.
          if ($this->database->addBooks($_POST, $this->book->imageFileLocation)) {
            $_SESSION["message"] = "Book data added successfully";
            $this->view("entries");
          }
        }
        else {
          $_SESSION["message"] = "Please enter valid book information.";
          $this->view("book-entries");
        }
      }
    }

  }
?>
