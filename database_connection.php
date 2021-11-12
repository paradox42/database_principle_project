<?php 
	  // Create connection
	  ini_set('display_errors', 1);
      $conn = new SQLite3("bookstore.db") or die("Cannot open the databse");
?>