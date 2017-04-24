<?php
session_start();

error_reporting(E_ALL);


$host="sql1.njit.edu";
$database="mid6";
$username="mid6";
$pass="ydkFcXjX";

try{
    $dbh=new PDO("mysql:host=$host;dbname=$database",$username, $pass);
    //echo "Connection Successful";
  }
  catch(PDOException $e){
    print "Connection Error: ". $e->getMessage();
    die();
  }

  include_once 'user.php';
  $user= new User($dbh);

?>
