<?php
session_start();

$sidvalue = session_id(); 
echo "<br>Your session id: " . $sidvalue . "<br>";

$_SESSION = array();		
session_destroy();			
setcookie("PHPSESSID", "", time()-3600); ;

echo "Your session is terminated."; 

?>
