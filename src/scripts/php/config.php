<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'finalprojectadmin');
define('DB_PASSWORD', 'admin123');
define('DB_NAME', 'BugMe');
 
/* Attempt to connect to MySQL database */
try{
  $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
  // Set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
  die("ERROR: Could not connect. " . $e->getMessage());
}
?>