<?php
include ("checklogin.php");
require("config.php");
require_once "Mail.php";
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Website short description." />
<meta name="keywords" content="website main keywords" />
        <title>Schule - Admin</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
if(isset($_GET['del'])) {
	mysql_query("DELETE FROM emails WHERE ID = ".$_GET['del']."", $link);
}
if(isset($_GET['con'])) {
	mysql_query("UPDATE emails SET `confirmed`=1 WHERE ID=".$_GET['con']."", $link);
	
	$host = $conf['host'];
	$port = $conf['port'];
	$username = $conf['username'];
	$betreff = $conf['subjectconfirm'];
	$to = $_GET['mail'];
	$password = $conf['pw'];
	
	$text = $conf['confirmtext'];
	
	$smtp = Mail::factory('smtp',
	   array ('host' => $host,
	     'port' => $port,
	     'auth' => true,
	     'username' => $username,
	     'password' => $password));
	                $headers = array ('From' => $conf['fromfull'],
	                                'To' => $to,
	                                'Subject' => $betreff);
	$mail = $smtp->send($to, $headers, $text);
	if (PEAR::isError($mail)) {
		$info = "Fehler beim verschicken der Best&auml;tigungsmail: ".$mail->getMessage()."<br /><br />";
	} else {
		$info = "Best&auml;tigungsmail wurde verschickt und E-Mail freigeschalten<br /><br />";
	}
}

?>

<div id="container">

<div id="header"><h1>BSZ <?php echo $conf['class']; ?> Infoseite</h1></div>

<div id="sub_header">Admin - E-Mails</div>

<div id="main_content_top"></div>

<div id="main_content">

<div class="content">
<?php if(isset($info)) echo $info; ?>
<strong>Freizuschaltende E-Mailadressen</strong><hr style="width: 350px;" align="left">
<table border="1" width="400" style="border: 1px solid black;" cellspacing="0" rules="rows">
<?php
$re = mysql_query("SELECT * FROM emails", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
	if($daten['confirmed'] == 0) {
		echo '<tr><td width="315" style="padding-left: 7px;"><strong>'.$daten['email'].'</strong></td><td style="padding:5px;"><a href="emails.php?con='.$daten['ID'].'&mail='.$daten['email'].'" style="color: green;">Freischalten</a></td><td style="padding:5px;"><a href="emails.php?del='.$daten['ID'].'" style="color: red;">L&ouml;schen</a></td></tr>';
	}       
}
?>
</table>
<br /><br />
<strong>Alle E-Mailadressen</strong><hr style="width: 350px;" align="left">
<table border="1" width="400" style="border: 1px solid black;" cellspacing="0" rules="rows">
<?php
$re = mysql_query("SELECT * FROM emails", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
        if($daten['confirmed'] == 1) {
                echo '<tr><td width="315" style="padding-left: 7px;"><strong>'.$daten['email'].'</strong></td><td style="padding:5px;"><a href="emails.php?del='.$daten['ID'].'" style="color: red;">L&ouml;schen</a></td></tr>';
        }       
}
?>
</table>
</div>

<div class="menu">
<div class="menu_title">Menu</div>
<ul>
<?php
include("images/menu.php");
?>
</ul>
</div>
<div id="clear"></div>
</div>
<div id="main_content_bottom">
</div>
<div id="footer"><strong>Copyright &copy; <?php echo date("Y"); ?></strong> | <a href="http://konradmallok.de">Konrad Mallok</a></div>
</div>
</body>
</html>
