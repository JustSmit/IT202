
<?php
session_start();
//test if logged in?
if ( !isset ($_SESSION["logged"]))
{
   print "<br> Please log in Dumbass";
   header("refresh: 7 ; url=y.html");
   exit();
}

print "PIN Handling...";
//make a pin and then mail the pin and remember the pin

$pin = mt_rand(9999, 100000);
$_SESSION["pin"] = $pin;
$subj = "your pin";
$msg = $pin;
$to = "ssp277@g.njit.edu";
mail($to, $subj, $msg);

?>



<form action = "ypin.php">
<input type = text name ="pin"> Enter Pin
<input type = submit>
</form>