$(document).ready(function() {

  /**
   * Function to load books on page load and add pagination to load more book.
   * 
   *  @param int page
   *    Holds page number to be display.
   */
  function loadBook(page) {
    $.ajax({
      url: "/home/loadMoreBook",
      type: "POST",
      data: {page_no :page},
      success: function(data) {
        $("#booklist").html(data);
      }
    });
  }

  loadBook();

  // It will page number to be loaded.
  $(document).on("click", "#pagination a", function(e) {
    e.preventDefault();
    var page_id = $(this).attr("id");

    loadBook(page_id);
  });

  /**
   * Function to sort book by price and author.
   * 
   *  @param string sortBy
   *    Hold how to sort data. 
   */
  function sortBook(sortBy) {
    $.ajax({
      url: "home/sortBook",
      type: "POST",
      data: {sortBy :sortBy},
      success: function(data) {
        $("#booklist").html(data);
      }
    });
  }

  $(document).on("click", "#sort select", function(e) {
    e.preventDefault();
    var sort_option = $(this).attr("id");

    sortBook(sort_option);
  });

  /**
   * Function to search book.
   * 
   *  @param string searchBy
   *    Hold how to search book. 
   */
  function searchBook(searchBy) {
    $.ajax({
      url: "home/searchBook",
      type: "POST",
      data: {bookQuery: searchBy},
      success: function(data) {
        $("#booklist").html(data);
      }
    });
  }

  $(document).on("click", "#search-bar input", function(e) {
    e.preventDefault();
    var search_option = $(this).attr("id");

    searchBook(search_option);
  });
});