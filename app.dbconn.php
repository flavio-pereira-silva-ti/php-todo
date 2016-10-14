<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '8889');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'PHPTODO');

function get_conn() {
  // Create connection
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: $conn->connect_error");
  }
  
  return $conn;
}
?>