<?php
  function OpenCon()
  {
    $dbhost = "localhost";
    $dbuser = "app_db_user";
    $dbpass = "securepassword";
    $db = "App_Database";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
    return $conn;
  }
    
  function CloseCon($conn)
  {
    $conn -> close();
  }
      
?>