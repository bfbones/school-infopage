<?php  
session_start ();  
if (!isset ($_SESSION["user_id"]) and !isset($_SESSION["user_nickname"]))  
{  
  header ("Location: index.php?ung");  
}  
?>
