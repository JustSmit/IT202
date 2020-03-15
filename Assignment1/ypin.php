<?php
session_start();
//test if logged in?
if ( !isset ($_SESSION["logged"]))
{
   print "<br> Please log in Dumbass";
   header("refresh: 7 ; url=y.html");
   exit();
}
print "pin check<br>";
//get the form pin from the form also get the remembered pin and then check them, if they dont match ask redirect to ynext.php else redirect to yserver.php

?>