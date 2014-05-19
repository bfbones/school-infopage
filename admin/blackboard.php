<?php  
include ("checklogin.php"); 
require("config.php");
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$jetzt = time();
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Website short description." />
<meta name="keywords" content="website main keywords" />
	<title>Schule - Admin</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function spoil(id) {
	if (document.getElementById) {
		var divid = document.getElementById(id);
		divid.style.display = (divid.style.display=='block'?'none':'block');
	}
}
</script>
<SCRIPT LANGUAGE="JavaScript" SRC="core/CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
	</SCRIPT>
</head>

<body>
<?php
if(isset($_GET['del'])) {
	mysql_query("DELETE FROM blackboard WHERE ID = ".$_GET['del']."", $link);
}
if($_POST['submit'] == "Absenden") {
	$ok = 1;
	if(empty($_POST['text'])) {
		$ok = 0;
		$fehler['text'] = '<br /><span style="color: red;">Du musst eine Nachricht eingeben!</span>';
	}
	
	if($ok == 1) {
		$sql = "INSERT INTO blackboard
		 (`ID`, `date`, `text`) VALUES (NULL, '".date("Y-m-d 00:00:00")."', '".$_POST['text']."');";
		mysql_query($sql, $link);
	}
}
?>
<div id="container">

<div id="header"><h1>BSZ <?php echo $conf['class']; ?> Infoseite</h1></div>

<div id="sub_header">Admin - Blackboard</div>

<div id="main_content_top"></div>

<div id="main_content">

<div class="content">
<strong>Blackboard</strong><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black;" cellspacing="0" rules="rows">
<?php
$re = mysql_query("SELECT * FROM blackboard ORDER BY date DESC", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {			
	$phpdate = strtotime($daten['date']);
	$date = date( 'd.m.Y', $phpdate );
	echo '<tr><td style="padding: 0px 5px 0px 2px;"><span style="color: red; font-size: 16px;"><a href="blackboard.php?del='.$daten['ID'].'" onclick="return confirm(\'Wirklich l&ouml;schen?\');">X</a></span></td><td width="115" style="padding-left: 7px;"><strong>'.$date.'</strong></td><td style="padding:5px;">'.$daten['text'].'</td></tr>';
}
?>
</table>
<p align="right" style="padding: 0px;"><a href="javascript:spoil('new');">Neuer Blackboard Eintrag</a></p>
<div id="new" style="<?php if(isset($fehler)) { } else { echo "display:none;"; } ?> border: 1px solid black; padding: 10px;">
<form action="blackboard.php" method="post" name="new">
<table border="0">
<tr><td width="100">Text:</td>
	<td><input name="text" type="text"><?php echo $fehler['text']; ?></td>
</tr>
<tr><td colspan="2"><br /><input type="submit" name="submit" value="Absenden">
        <input type="reset" value=" Abbrechen"></td>
</tr>
</table>
</form>
</div>
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
