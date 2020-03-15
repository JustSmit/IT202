<?php

session_start();


include ("myfunctions.php");

if ( !isset ($_SESSION["logged"]))
{
   print "<br> Please log in";
   header("refresh: 2 ; url= auth.html");
   exit();
}



$pin = mt_rand(999,10000);
$_SESSION["pin"] = $pin;
$subj = "your pin";
$msg = $pin;
$to = "ssp277@g.njit.edu";
//mail($to, $subj, $msg);

echo "<br> The pin is '$pin'";

?>



<form action = "pin2.php">
<input type = text name ="pin"> Enter Pin
<input type = submit>
</form>
