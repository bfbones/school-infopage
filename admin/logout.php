<?php  
// Wird ausgeführt um mit der Ausgabe des Headers zu warten.  
ob_start ();  

session_start ();  
session_unset ($_SESSION["user_id"]);  
session_unset ($_SESSION["user_nickname"]);
session_destroy ();  

header ("Location: index.php?ausg");  
ob_end_flush ();  
?>