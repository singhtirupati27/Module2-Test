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
  function sortBook(sort) {
    $.ajax({
      url: "/home/sortBook",
      type: "POST",
      data: {sortBy :sort},
      success: function(data) {
        $("#booklist").html(data);
      }
    });
  }

  // It will work when the element change on selection.
  $(document).on("change", "#sort", function() {
    $(this).find(":selected").attr("id");
    var value = $("#sort").val();
    sortBook(value);
  });

  /**
   * Function to search book.
   * 
   *  @param string searchBy
   *    Hold how to search book. 
   * 
   *  @param string searchIn
   *    Hold the value of column to be searched in.
   */
  function searchBook(searchBy, searchIn) {
    $.ajax({
      url: "/home/searchBook",
      type: "POST",
      data: {searchFor: searchBy, searchColumn: searchIn},
      success: function(data) {
        $("#booklist").html(data);
      }
    });
  }

  // This event will occur while text is being typed in search box.
  $(document).on("keyup", "#search-box", function() {
    var searchIn = $("#search-in").val();
    var search = $("#search-box").val();
    searchBook(search, searchIn);
  });
});
