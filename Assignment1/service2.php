<?php

session_start();
include ("account.php");
include ("myfunctions.php");

$db = mysqli_connect($hostname, $username, $password, $project);
mysqli_select_db($db, $project);

  if ( !isset ($_SESSION["pinpass"]))
{
   print "<br> Please enter the pin again";
   header("refresh: 2 ; url= pin1.php");
   exit();
}

$choice = safe ("choice");

if ($choice == "List"){
  $number = safe ("number");
  $ucid= $_SESSION["ucid"];
  retrieve ($ucid, $number);
  
  }
else if ($choice == "Perform"){
  $account = safe ("account");
  $amount = safe ("amount");
  $ucid= $_SESSION["ucid"];
  update ($ucid, $account, $amount);
  }
else {
  $ucid = $_SESSION["ucid"];
  $account = safe ("account");
  clear ($ucid, $account);
  }

echo '<br> <a href = service1.php> Backwards </a> <br>';
echo '<br> <a href = logout.php>  Logout </a> <br>';
  

?>