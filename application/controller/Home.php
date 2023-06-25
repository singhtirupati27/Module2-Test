<?php
  session_start();
  $_SESSION["message"] = "";

  /**
   * Home controller class to load home, login, dashboard, forget password
   * and sign out page.
   */
  class Home extends Framework {
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
     * Function to load landing page.
     */
    public function index() {

      // Check if user is already logged in or not.
      if (isset($_SESSION["loggedIn"])) {
        $this->view("welcome");
      }
      else {
        $this->view("login");
      }
    }

    /**
     * Function to load login page and perform login operation.
     */
    public function login() {
      // Check if user is already logged in or not.
      if (isset($_SESSION["loggedIn"])) {
        $this->view("welcome");
      }
      // Check if login button has been clicked or not.
      if (isset($_POST["login"])) {
        $this->validation->validateEmail($_POST["email"]);
        $this->validation->validatePassword($_POST["password"]);
        // Check if input data is valid or not.
        if ($this->validation->dataValid) {
          // Check if user details exists in database or not.
          if ($this->database->checkUserLogin($_POST["email"], $_POST["password"])) {
            $_SESSION["loggedIn"] = TRUE;
            $this->view("home");
          }
          else {
            $_SESSION["message"] = "Invalid username or password";
            $this->view("login");
          }
        }
        else {
          $GLOBALS["emailErr"] = $this->validation->errorMsg["emailErr"];
          $GLOBALS["emailErr"] = $this->validation->errorMsg  ["passwordErr"];
        }
      }
    }

    /**
     * Function load books with load more button.
     * 
     *  @return response
     *    It will return html page with book list with pagination.
     */
    public function loadMoreBook() {
      $_SESSION["loadBooks"] = $this->database->bookList();
      $_SESSION["rowCount"] = $this->database->calculateRows();   
      return $this->view("booklist");
    }

    /**
     * Function to sort books as option chosen by user.
     * 
     *  @return response
     *    It will return html page with sorted book list with pagination.
     */
    public function sortBook() {
      $_SESSION["loadBooks"] = $this->database->sortBooks($_POST["sortBy"]);
      $_SESSION["rowCount"] = $this->database->calculateRows(); 
      return $this->view("booklist");
    }

    /**
     * Function to search book.
     * 
     *  @return response
     *    It will return html page with searched book list with pagination.
     */
    public function searchBook() {
      $_SESSION["loadBooks"] = $this->database->searchBook($_POST["searchFor"], $_POST["searchColumn"]);
      return $this->view("booklist");
    }

    /**
     * Function to load signout page.
     * After sign out destroy session.
     */
    public function signout() {
      session_unset();
      session_destroy();
      $this->redirect("home");
    }

    /**
     * Function to load error page.
     */
    public function page() {
      $this->error('error');
    }

  }
?>
