<?php session_start (); ?> 
 <html>
<head><title>Schule - Adminlogin</title></head>
<body bgcolor="#F5F5F5" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<br/>
<form action="login.php" method="post">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="50%">
	<tr bgcolor="#CCCCCC">
		<td>
			<table cellpadding="3" cellspacing="1" border="0" height="100%" width="100%">
				<tr bgcolor="#EEEEEE">
					<td height="26" colspan="2"><font style="font-family: verdana, arial, helvetica, sans-serif; font-size: 13px; color: #003366; text-decoration: none; font-weight: bold;"><b>Schule - Adminlogin
<?php
$site = $_SERVER['QUERY_STRING'];
if (isset ($site)) {  
	echo '<br><br><font color="red">';
if ($site == "un") {
	echo "Die Zugangsdaten waren ung&uuml;ltig.";  
}
if ($site == "name") {
	echo "Es existiert kein User mit diesem Name.";  
}
if ($site == "ausg") {
	echo "Du wurdest ausgeloggt.";  
}
if ($site == "ung") {
	echo "Du bist nicht eingeloggt!";  
}
	echo '</font>';
}  
?> 
               </b></font></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td><font style="font-family: verdana, arial, helvetica, sans-serif; font-size: 13px; color: #006699; text-decoration: none; font-weight: bold;"><b>Loginname:</b></font></td>
					<td><input type="text" name="name" size="20"></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td><font style="font-family: verdana, arial, helvetica, sans-serif; font-size: 13px; color: #006699; text-decoration: none; font-weight: bold;"><b>Passwort:</b></font></td>
					<td><input type="password" name="pwd" size="20"></td>
				</tr>
               
				<tr bgcolor="#EEEEEE">
					<td height="26" colspan="2"><center><input type="submit" value="Login"></center>  </td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</form>

<br/>

</body>
</html>
