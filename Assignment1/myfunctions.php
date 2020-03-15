<?php

function safe($fieldname)
{
  global $db;
  $temp = $_GET [$fieldname];
  $temp = trim ($temp);
  $temp = mysqli_real_escape_string($db, $temp);
  return $temp;
}

 function retrieve ($ucid, $number) 
{
   global $db;
   
   $b= "select * from accounts where ucid= '$ucid'";
   ($a= mysqli_query ($db, $b)) or die (mysqli_error($db) );
   
 
   while ($r= mysqli_fetch_array ($a, MYSQLI_ASSOC))
   {
		print "<hr>";
		$ucid= $r["ucid"];
		$account= $r["account"];
		$balance= $r["balance"];
		$recent= $r["recent"];
		print "<strong> $ucid $accounts balance: $$balance $recent</strong>";
    
	    $s= "select * from transactions where ucid= '$ucid' and account= '$account' limit $number";
	 
		($t= mysqli_query ($db, $s)) or die (mysqli_error($db) );
		while($q= mysqli_fetch_array ($t, MYSQLI_ASSOC))
		{ 
		  $amount 		= $q["amount"];
		  $timestamp 	= $q["timestamp"];
		  $mail			= $q["mail"];
		  print "<br> <em> $$amount $timestamp mail copy: '$mail'</em>";
		}      
  }
}

function authenticate ($ucid, $pass) 
{
  global $db;
  $s= "select * from users where ucid = '$ucid' and pass = '$pass'"; 
($t= mysqli_query ($db, $s)) or die (mysqli_error($db) );
$num= mysqli_num_rows($t);

if ($num==0) { return false;}
else          { return true;}

}

function update ($ucid, $account, $amount){
  global $db;
  $s = "insert into transactions values ('$ucid', '$account', '$amount', NOW(), 'N' )";
  ($t = mysqli_query ($db, $s)) or die (mysqli_error($db) );

  $s = "update accounts Set  balance = balance + '$amount', recent = NOW() where ucid = '$ucid' and account = '$account' and balance + $amount >= 0.00";
  ($t = mysqli_query ($db, $s)) or die (mysqli_error($db) );

  
  $rows = mysqli_affected_rows ($db);

  if ($rows == 0){
    echo "<br> Overdraft Rejected";
    return;
  
  }
  echo "<br> Your transaction has been successfully processed for user '$ucid' account '$account'";
}

function clear ($ucid, $account){
  global $db;
  $s = "delete from transactions where ucid = '$ucid' and account = '$account'";
  (mysqli_query ($db, $s)) or die (mysqli_error($db));
  $s = "update accounts set  balance = 0.00, recent = NOW() where ucid = '$ucid' and account = '$account'";
  ($t = mysqli_query ($db, $s)) or die (mysqli_error($db) );
  echo "<br> Your table has been cleared";
}

?>