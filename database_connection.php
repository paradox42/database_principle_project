<?php 
      ini_set('display_errors', '1');
	  $servername = "localhost";
	  $username = "root";
	  $password = "he19910813";
	  $db_name="bookstore"; 
	  $port = 3306;
	  
	  // Create connection
      $conn = new mysqli($servername, $username, $password, $db_name, $port);
	  
	  // Check connection
	  if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	  }
?>