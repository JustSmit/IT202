<?php
session_start();

include ("myfunctions.php");
include ("account.php");

if ( !isset ($_SESSION["logged"]))
{
   print "<br> Please log in";
   header("refresh: 2 ; url= auth.html");
   exit();
}

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
  
$db = mysqli_connect($hostname, $username, $password, $project);
mysqli_select_db($db, $project);

$pin= safe("pin");
$realpin= $_SESSION ["pin"];

echo "<br> The random pin is '$realpin'";

if ($pin == $realpin){
  echo "<br> Pin is correct";
  header("refresh: 2 ; url= service1.php");
  $_SESSION ["pinpass"]= true;
  exit();
  }
else {
  echo "<br> Pin is wrong";
  header("refresh: 2 ; url= pin1.php");
  exit();
  }
  
?>