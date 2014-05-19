<?php  
session_start (); 
require("config.php");
$name = $_POST['name'];
$password = $_POST['pwd'];

$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$result = mysql_query("SELECT * FROM `login` WHERE `name`='".$name."';");

if (mysql_num_rows($result) == 0) {
	header ("Location: index.php?name");
} 
$re = mysql_query("SELECT * FROM login  WHERE name = '".$name."';", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
	$uID = $daten['ID'];
	$ppasswort = $daten['password'];
	$nname = $daten['name'];
}

if (md5($password) == $ppasswort and $name == $nname)  {  
	$_SESSION["user_id"] = $uID;
	$_SESSION["user_nickname"] = $nname; 
	header ("Location: intern.php");
} else {  
  header ("Location: index.php?un");  
}
?>

