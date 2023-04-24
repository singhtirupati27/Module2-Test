<?php

  /**
   * This class contains methods to upload book in database.
   */
  class Book {

    /**
     *  @var int $uploadOk
     *    Hold value 1 if all fields are valid, 0 if not.
     */
    public int $uploadOk = 1;

    /**
     *  @var string $uploadImgErr
     *    Stores image upload error message.
     */
    public string $uploadImgErr = "";

    /**
     * Initializing IMG_TARGET_DIR with directory path to upload cover image. 
     */
    const IMG_TARGET_DIR = "public/img/";

    /**
     *  @var string $imageFileLocation
     *    Holds cover image uploaded location with image file name.
     */
    public string $imageFileLocation = "";

    /**
     *  @var string $imageFileType
     *    Stores image file extension.
     */
    public string $imageFileType;

    /**
     * Function to upload cover image.
     * 
     *  @param array $bookCover
     *    Holds image path value.
     */
    public function uploadCoverImage(array $bookCover) {
      $this->imageFileLocation = self::IMG_TARGET_DIR . basename($bookCover["name"]);

      $this->imageFileType = strtolower(pathinfo($this->imageFileLocation, PATHINFO_EXTENSION));

      // Check file size is not 0.
      if (!$bookCover["size"] == 0) {  

        // Check for uploaded file size.
        if ($bookCover["size"] > 10000000) {
          $this->uploadImgErr = "Sorry, image file is too large.";
          $this->uploadOk = 0;
        }
  
        // Check for file extension format.
        if ($this->imageFileType != "jpg"
            && $this->imageFileType != "png"
            && $this->imageFileType != "jpeg"
            && $this->imageFileType != "gif") {
          $this->uploadImgErr = "Sorry, only JPG, PNG, JPEG and GIF file allowed.";
          $this->uploadOk = 0;
        }
      }
      else {
        $this->uploadImgErr = "Please select a cover image file.";
      }
    }

    /**
     * Function check wether input field is empty or not.
     * 
     *  @param string $name
     *    Holds field value.
     * 
     *  @return string
     */
    public function isEmpty(string $name) {
      if (empty($name)) {
        $this->uploadOk = 0;
        $this->uploadImgErr = "Field cannot be empty";
      }
    }

    /**
     * Function check whether entered book data is valid or not.
     * 
     *  @param array $book
     *    Holds book informations.
     */
    public function validateBookData(array $book) {
      $this->isEmpty($book["title"]);
      $this->isEmpty($book["author"]);
      $this->isEmpty($book["description"]);
      $this->isEmpty($book["cost"]);
    }
  }
?>