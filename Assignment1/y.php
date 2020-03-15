
<?php 

session_start();
$ucid = $_GET["ucid"];


include ("account.php") ;
$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db( $db, $project ); 

function safe($fieldname)
{
  global $db;
  $temp = $_GET [$fieldname];
  $temp = trim ($temp);
  $temp = mysqli_real_escape_string($db, $temp);
//print "<br> $fieldname $temp";
  return $temp;
}


//ucid= $_GET("ucid"); $ucid = safe ($ucid);
$ucid = safe ("ucid");
$pass = safe ("pass");

//$ucid = $_GET["ucid"]; $ucid = mysqli_real_escape_string($db, $ucid;)
//print "<br> ucid $ucid";
//$pass = $_GET["pass"]; $pass = mysqli_real_escape_string($db, $pass;)
//print "<br> pass $pass";
//$accounts = $_GET["accounts"]; 

$accounts= safe( "accounts");
//print " <br> accounts $accounts";
//$amount = $_GET["amount"];  
$amount= safe("amount");
//print  " <br> amount $amount";


//retrieve & display data on user & account from the transactions function

  $s= "select * from transactions where ucid = '$ucid' and accounts= '$accounts'"; 
 // print "<br>  SQL select transactions  $s"; 
  
  function retrieve ($ucid) 
{
   global $db;
   
   $b= "select * from accounts where ucid= '$ucid'";
   ($a= mysqli_query ($db, $b)) or die (mysqli_error($db) );
   
   //$numTrans= mysqli_num_rows($t);
   //$numAcc= mysqli_num_rows($a);
  
   while ($r= mysqli_fetch_array ($a, MYSQLI_ASSOC))
   {
		print "<hr>";
		$ucid= $r["ucid"];
		$accounts= $r["accounts"];
		$balance= $r["balance"];
		$recent= $r["recent"];
		print "<strong> $ucid $accounts balance: $$balance $recent</strong>";
    
	    $s= "select * from transactions where ucid= '$ucid' and accounts= '$accounts'";
		echo "<br><br> s is:  $s "; 
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
 retrieve ($ucid);



  ($t= mysqli_query ($db, $s)) or die (mysqli_error($db) );
    while ($r= mysqli_fetch_array ($t, MYSQLI_ASSOC))
  {
      $amount= $r["amount"];
      $timestamp= $r["timestamp"];
      
      print "<br>  date + amount $timestamp + $amount"; 
  }

function authenticate ($ucid, $pass) 
{
  global $db;
  $s= "select * from users where ucid = '$ucid' and pass = '$pass'"; 
//print "<br>  SQL select  $s"; 
($t= mysqli_query ($db, $s)) or die (mysqli_error($db) );
$num= mysqli_num_rows($t);

if ($num==0) { return false;}
else          { return true;}

}

if (!authenticate ($ucid, $pass))  
  {print "<br> Not auth.";
  // header("refresh: 7 ; url=y.html");
   exit();
 }
 else                               
  {print "<br> Yes auth.";
  $_SESSION["logged"]= true;
  $_SESSION["ucid"]= $ucid;
  retrieve ($ucid);
  //header("refresh: 7 ; url=ynext.php");
   exit();
 }

$s= "select * from users where ucid = '$ucid' and pass = '$pass'"; 
print "<br>  SQL select  $s"; 
($t= mysqli_query ($db, $s)) or die (mysqli_error($db) );

$num= mysqli_num_rows($t);

if ($numm==0) { print "<br> Not auth.";}
else          {print "<br> Yes auth.";}


$s = "insert into transactions values ('$ucid', '$accounts', '$amount', NOW(), 'N' )";
//print "<br>  SQL insert  $s"; 
($t = mysqli_query ($db, $s)) or die (mysqli_error($db) );

print "<br> Bye";

/*

$s = "update accounts Set  balance = balance + '$amount', recent = NOW() where ucid = '$ucid' and accounts = '$accounts' ";
        
print "<br>  SQL update  $s";
 
($t = mysqli_query ($db, $s)) or die (mysqli_error($db) );

*/
//print "<br>  bye";


?>