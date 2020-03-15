<!DOCTYPE html>
 
<meta charset="utf-8">

<style>   
    #number, #account, #amount {display:  none;}
    form {margin: auto; border:1px dashed blue; padding: 20px; width: 300px;}                                                                                                 
</style>

<?php 
session_start();
include ("account.php");
$db = mysqli_connect($hostname, $username, $password, $project);
mysqli_select_db($db, $project);

  if ( !isset ($_SESSION["pinpass"]))
{
   print "<br> Please enter the pin again";
   header("refresh: 2 ; url= pin1.php");
   exit();
}

?>
 <form action = "service2.php" autocomplete = "off">
 
<input type = radio name="choice" id="List"     value="List">List<br>
<input type = radio name="choice" id="Perform"  value="Perform">Perform<br>
<input type = radio name="choice" id="Clear"    value="Clear">Clear<br>
  

<div id = "number" ><input type=text name = "number"  > Enter number <br></div>
<div id = "account"><input type=text name = "account" > Enter account<br></div>
<div id = "amount" ><input type=text name = "amount"  > Enter amount <br></div>
 
<input type= submit>
</form>

<script>


var ptrNumber  = document.getElementById("number")
var ptrAccount = document.getElementById("account")
var ptrAmount  = document.getElementById("amount")

var ptrList    = document.getElementById("List")
var ptrPerform = document.getElementById("Perform")
var ptrClear   = document.getElementById("Clear")

ptrList.addEventListener   ("click", F)
ptrPerform.addEventListener("click", F)
ptrClear.addEventListener  ("click", F)

function F() 
{

  ptrNumber.style.display = "none"
  ptrAccount.style.display = "none"
  ptrAmount.style.display = "none"
  
 
    if (this.value == "List")
    {
      ptrNumber.style.display = "block" 
    }
    else if (this.value == "Perform")
    {
      ptrAccount.style.display = "block"
      ptrAmount.style.display  = "block"
    }
    else if (this.value == "Clear")
    {
      ptrAccount.style.display = "block"
    }
}

  
  </script>