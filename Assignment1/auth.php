<?php

session_start();

include ("account.php");

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
  
include ("myfunctions.php");

$db = mysqli_connect($hostname, $username, $password, $project);
mysqli_select_db($db, $project);


$ucid = safe ("ucid");
$pass = safe ("pass");

if (!authenticate ($ucid, $pass))  {
  print "<br> Not auth.";
  header("refresh: 2 ; url= auth.html");
   exit();
  }
 else                          {
  print "<br> Yes auth.";
  $_SESSION["logged"]= true;
  $_SESSION["ucid"]= $ucid;
  header("refresh: 2 ; url= pin1.php");
   exit();
  }





?>