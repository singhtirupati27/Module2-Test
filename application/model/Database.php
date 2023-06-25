<?php

  // Including Dotenv to access env variables.
  require './vendor/autoload.php';
  use Dotenv\Dotenv;
  $dotenv = Dotenv::createImmutable("./");
  $dotenv->load();

  /**
   * Database class hold database data.
   * This class have methods to insert and update data in databse.
   */
  class Database {
    /**
     *  @var string $dbName
     *    Contains database name.
     */
    private string $dbName;

    /**
     *  @var string $dbUsername
     *    Contains database username.
     */
    private string $dbUsername;

    /**
     *  @var string $dbPassword
     *    Stores database user password.
     */
    private string $dbPassword;

    /**
     *  @var object $connectionData
     *    Holds database connection object.
     */
    public object $connectionData;

    /**
     * Constructor to initialize UserDb class with databasename, username and 
     * password.
     */
    public function __construct() {
      $this->dbName = $_ENV['DBNAME'];
      $this->dbUsername = $_ENV['USERNAME'];
      $this->dbPassword = $_ENV['PASSWORD'];
      $this->databaseConnet();
    }

    /**
     * Function to connect database.
     */
    public function databaseConnet() {
      try {
        $this->connectionData = new PDO("mysql:host=localhost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
        $this->connectionData->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e) {
        echo "Error while connecting database: " . $e->getMessage();
      }
    }

    /**
     * Function to close database connection.
     */
    public function disconnectDb() {
      $this->connectionData = NULL;
    }

    /**
     * Function to check whether admin login email and password exist in the database
     * or not.
     * 
     *  @param string $username
     *    Contains admin email used for login.
     * 
     *  @param string $password
     *    Contains admin login password
     * 
     *  @return bool
     *    Return TRUE if data exists in database, if not then return FALSE.
     */
    public function checkAdminLogin(string $username, string $password) {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM admin WHERE admin_email = :username AND admin_password = :password");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        // Check how many rows are returned
        if ($query->rowCount() == 1) {
          return TRUE;
        }
        return FALSE;
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to check whether user login email and password exist in the database
     * or not.
     * 
     *  @param string $username
     *    Contains user email used for login.
     * 
     *  @param string $password
     *    Contains user login password
     * 
     *  @return bool
     *    Return TRUE if data exists in database, if not then return FALSE.
     */
    public function checkUserLogin(string $username, string $password) {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM user WHERE user_email = :username AND user_password = :password");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        // Check how many rows are returned
        if ($query->rowCount() == 1) {
          return TRUE;
        }
        return FALSE;
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to check whether username or email exists in the database or
     * not.
     * 
     *  @param string $email
     *    Contains user email used for login.
     * 
     *  @return bool
     *    Return TRUE if data exists in database, if not then return FALSE.
     */
    public function checkUserNameExists(string $email) {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM user WHERE user_email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        // Check row count.
        if ($query->rowCount() == 1) {
          return TRUE;
        }
        return FALSE;
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to check whether phone number exists or not.
     * 
     *  @param string $phone
     *    Holds phone number to check for.
     * 
     *  @return bool
     *    Return true if phone number exists, false if not.
     */
    public function checkUserContactExists(string $phone) {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM user_info WHERE user_phone = :phone");
        $query->bindParam(':phone', $phone);
        $query->execute();
        // Check row count.
        if ($query->rowCount() == 1) {
          return TRUE;
        }
        return FALSE;
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to register new user data into table.
     *  
     *  @param array $user_data
     *    Contains user all data.
     * 
     *  @return bool
     *    It will return TRUE if user data has been insert, FALSE if not.
     */
    public function registerUser(array $user_data) {
      try {
        $query = $this->connectionData->prepare("INSERT INTO user (user_email, user_password)
         VALUES (:email, :password)");
        $query->bindParam(':email', $user_data["email"]);
        $query->bindParam(':password', $user_data["password"]);
        $query->execute();
        $query1 = $this->connectionData->prepare("INSERT INTO user_info(user_name, user_phone)
          VALUES (:name, :phone)");
        $query1->bindParam(':name', $user_data["name"]);
        $query1->bindParam(':phone', $user_data["phone"]);
        $query1->execute();
        return ($query && $query1);
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to check whether book already exists or not in database.
     *  
     *  @param string $bookTitle
     *    Contains book title.
     * 
     *  @param string $author
     *    Contains book author name.
     * 
     *  @return bool
     *    It will return false if book data exists or true if not.
     */
    public function isBookExists($bookTitle, $author) {
      try {
        $query = $this->connectionData->prepare("SELECT book_title FROM books
          WHERE book_title = :title AND book_author = :author");
        $query->bindParam(':title', $bookTitle);
        $query->bindParam(':author', $author);
        $query->execute();
        // Check row count.
        if ($query->rowCount() == 1) {
          return FALSE;
        }
        return TRUE;
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to add books in database.
     * 
     *  @param array $bookData
     *    Holds books informations.
     * 
     *  @param string $imageLink
     *    Holds book cover image link.
     * 
     *  @return bool
     */
    public function addBooks(array $bookData, string $imageLink) {
      try {
        // Check if book exists or not. If not then add book.
        if($this->isBookExists($bookData["title"], $bookData["author"])) {
          $query = $this->connectionData->prepare("INSERT INTO books (book_title, book_description, book_author, book_cost, book_image)
            VALUES (:title, :desc, :author, :price, :img)");
          $query->bindParam(':title', $bookData["title"]);
          $query->bindParam(':desc', $bookData["description"]);
          $query->bindParam(':author', $bookData["author"]);
          $query->bindParam(':price', $bookData["cost"]);
          $query->bindParam(':img', $imageLink);
          return $query->execute();
        }
        return FALSE;
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to check whether passed data is empty or not. If empty then
     * return false, if not then return data itself.
     * 
     *  @param mixed $data
     *    Holds values need to be checked.
     * 
     *  @return mixed
     *    Return false if empty, if not then return data parameter itself.
     */
    public function isEmpty(mixed $data) {
      if(empty($data)) {
        return FALSE;
      }
      return $data;
    }

    /**
     * Function to calculate number of records returned in query.
     * 
     *  @return mixed
     */
    public function calculateRows() {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM books");
        $query->execute();
        return $query->rowCount();
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to fetch all book from database with limit.
     * 
     *  @return mixed
     *    Return array if data is present, else return false.
     */
    public function bookList() {
      try {
        $limit_per_page = 8;
        $page = "";
        // Check if page number is set.
        if(isset($_POST["page_no"])) {
          $page = $_POST["page_no"];
        }
        // If not set then set page number to 1.
        else {
          $page = 1;
        }
        $offsets = ($page - 1) * $limit_per_page;
        $query = $this->connectionData->prepare("SELECT * FROM books LIMIT {$offsets}, {$limit_per_page}");
        $query->execute();
        $response = $query->fetchAll();
        return $this->isEmpty($response);
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to books by provided in parameter.
     * 
     *  @param string $sortBy
     *    Hold how to sort data.
     * 
     *  @return mixed
     */
    public function sortBooks(string $sortBy) {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM books ORDER BY {$sortBy}");
        $query->execute();
        $response = $query->fetchAll();
        return $this->isEmpty($response);
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    }

    /**
     * Function to search book in database by passed parameter.
     * 
     *  @param string $keyword
     *    Holds information about data to be searched.
     * 
     *  @param string $columnName
     *    Holds column name to search in for data.
     * 
     *  @return mixed
     */
    public function searchBook(string $keyword, string $columnName) {
      try {
        $query = $this->connectionData->prepare("SELECT * FROM books 
          WHERE {$columnName} LIKE :term");
        $query->bindValue(':term', '%' . $keyword . '%');
        $query->execute();
        $response = $query->fetchAll();
        return $this->isEmpty($response);
      }
      catch (PDOException $e) {
        echo $e;
        return FALSE;
      }
    } 

  }
?>
