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
        <script type="text/javascript" src="core/ezcalendar.js"></script>
        <link rel="stylesheet" type="text/css" href="core/ezcalendar.css" />
</head>

<body>
<?php
if(isset($_GET['del'])) {
	mysql_query("DELETE FROM homeworks WHERE ID = ".$_GET['del']."", $link);
}
if($_POST['submit'] == "Absenden") {
	$ok = 1;
	if(empty($_POST['fach'])) {
		$ok = 0;
		$fehler['fach'] = '<br /><span style="color: red;">Du musst das Fach angeben!</span>';
	}
	if(empty($_POST['date'])) {
		$ok = 0;
		$fehler['date'] = '<br /><span style="color: red;">Du musst das Datum angeben!</span>';
	} else {
		if (!preg_match("{^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|((\d{4})(-)(0[469]|11)(-)([0][1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|1[0-9]|2[0-8]))|(([02468][048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(02)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02)(-)(29)))(\s([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))?$}", $_POST['date'])) {
		$ok = 0;
		$fehler['date'] = '<br /><span style="color: red;">Das Datumsformat ist falsch!</span>';
		}
	}
	if(empty($_POST['infos'])) {
		$ok = 0;
		$fehler['infos'] = '<br /><span style="color: red;">Du musst Infos angeben!</span>';
	}
	
	if($ok == 1) {
		$sql = "INSERT INTO homeworks
		 (`ID`, `typ`, `fach`, `date`, `info`, `link`) VALUES (NULL, '".$_POST['typ']."', '".$_POST['fach']."', '".$_POST['date']."', '".$_POST['infos']."', '".$_POST['link']."');";
		mysql_query($sql, $link);
		$sql = "UPDATE lastupdate SET `update` = '".date("Y-m-d H:i:00")."' WHERE `typ` = 'homeworks';";
		mysql_query($sql, $link);
	}
}
?>
<div id="container">

<div id="header"><h1>BSZ <?php echo $conf['class']; ?> Infoseite</h1></div>

<div id="sub_header">Admin - Hausaufgaben</div>

<div id="main_content_top"></div>

<div id="main_content">

<div class="content">
<strong>Aktuelle Aufgaben</strong><hr style="width: 550px;">
<table border="1" width="550" style="border: 1px solid black; text-align: left;" cellspacing="0" rules="rows">
<thead><td></td><td><strong>Was?</strong></span></td><td><strong>Fach</strong></td><td><strong>Bis zum?</strong></td><td><strong>Infos</strong></td><td><strong>Link?</strong></td></thead>
<?php
$re = mysql_query("SELECT * FROM homeworks ORDER BY ID ASC", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
	$phpdate = strtotime($daten['date']);
	$dd[d] = date( 'd', $phpdate );
	$dd[m] = date( 'm', $phpdate );
	$dd[y] = date( 'Y', $phpdate );
	$damalstime = mktime(23, 59, 59, $dd[m], $dd[d], $dd[y]);
	if($jetzt <= $damalstime) {
		if($daten['link'] == "") {
			$url = "Kein Link vorhanden.";
		} else {
			$explodelink = explode("/", $daten['link']);
			$lastblock = count($explodelink)-1;
			$url = '<a href="'.$daten['link'].'">'.$explodelink[$lastblock].'</a>';
		}
	$date = date( 'd.m.Y', $phpdate );
	echo '<tr><td style="padding: 0px 5px 0px 2px;"><span style="color: red; font-size: 16px;"><a href="homeworks.php?del='.$daten['ID'].'" onclick="return confirm(\'Wirklich l&ouml;schen?\');">X</a></span></td><td><span style="color: red;">'.$daten['typ'].'</span></td><td>'.$daten['fach'].'</td><td>'.$date.'</td><td>'.$daten['info'].'</td><td>'.$url.'</td></tr>';
	}
}
?>
</table>
<p align="right" style="padding: 0px;"><a href="javascript:spoil('new');">Neue Aufgabe einf&uuml;gen</a></p>
<div id="new" style="<?php if(isset($fehler)) { } else { echo "display:none;"; } ?> border: 1px solid black; padding: 10px;">
<form action="homeworks.php" method="post" name="new">
<table border="0">
<tr><td width="100">Was?:</td>
	<td><select name="typ">
<option value="HAUSAUFGABE">HAUSAUFGABE</option>
<option value="AUSARBEITUNG">AUSARBEITUNG</option>
</select><?php echo $fehler['typ']; ?></td>
</tr>
<tr><td width="100">Fach:</td>
	<td><input name="fach" type="text"><?php echo $fehler['fach']; ?></td>
</tr>
<tr><td width="100">Bis zum?:</td>
	<td style="line-height: 10px;">
	<input name="date" id="date" type="text"><A HREF="#"
   onClick="javascript: showCalendar('date'); return false;"><img src="images/calendar.png" border="0"></A><br />
	<span style="font-size:10px;">Datumsformat: yyyy-MM-dd</span><?php echo $fehler['date']; ?>
	</td>
</tr>
<tr><td width="100">Infos:</td>
	<td><input name="infos" type="text"><?php echo $fehler['infos']; ?></td>
</tr>
<tr><td width="100" style="line-height: 9px;">Link:<br /><span style="font-size:10px; padding:0px;">(Optional)</span></td>
	<td><input name="link" type="text"><?php echo $fehler['link']; ?></td>
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
