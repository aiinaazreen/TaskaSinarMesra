<?php
  // Start the session if not already started
  session_start();

  // Database access information
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'taska2023');

  // Make the database connection
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());
  
  // Set the character set encoding
  mysqli_set_charset($dbc, 'utf8');
?>
