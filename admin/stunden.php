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
	mysql_query("DELETE FROM stunden WHERE ID = ".$_GET['del']."", $link);
}
if($_POST['submit'] == "Absenden") {
	$ok = 1;
	if(empty($_POST['date'])) {
		$ok = 0;
		$fehler['date'] = '<br /><span style="color: red;">Du musst das Datum angeben!</span>';
	} else {
		if (!preg_match("{^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|((\d{4})(-)(0[469]|11)(-)([0][1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|1[0-9]|2[0-8]))|(([02468][048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(02)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02)(-)(29)))(\s([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))?$}", $_POST['date'])) {
			$ok = 0;
			$fehler['date'] = '<br /><span style="color: red;">Das Datumsformat ist falsch!</span>';
		}
	}
	if(empty($_POST['stunden'])) {
		$ok = 0;
		$fehler['stunden'] = '<br /><span style="color: red;">Du musst die Ausfallstunden angeben!</span>';
	}
	
	if(empty($_POST['afach'])) {
		$ok = 0;
		$fehler['afach'] = '<br /><span style="color: red;">Du musst das Ausfallfach angeben!</span>';
	}
	if(empty($_POST['alehrer'])) {
		$ok = 0;
		$fehler['alehrer'] = '<br /><span style="color: red;">Du musst den Ausfalllehrer angeben!</span>';
	}
	
	if($ok == 1) {
		$sql = "INSERT INTO stunden (`ID`, `typ`, `date`, `ausfallstunde`, `neuestunde`, `stunden`, `ausfalllehrer`, `neuerlehrer`, `infos`) 
			VALUES (NULL, '".$_POST['typ']."', '".$_POST['date']."', '".$_POST['afach']."', '".$_POST['vfach']."', '".$_POST['stunden']."', '".$_POST['alehrer']."', '".$_POST['vlehrer']."', '".$_POST['infos']."');";
		mysql_query($sql, $link);
		$sql = "UPDATE lastupdate SET `update` = '".date("Y-m-d H:i:00")."' WHERE `typ` = 'stunden';";
		mysql_query($sql, $link);
	}
}
?>
<div id="container">

<div id="header"><h1>BSZ <?php echo $conf['class']; ?> Infoseite</h1></div>

<div id="sub_header">Admin - Stundenplan&auml;nderungen</div>

<div id="main_content_top"></div>

<div id="main_content">

<div class="content">
<strong>Stundenplan&auml;nderungen</strong><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black; text-align: left;" cellspacing="0" rules="rows">
<thead><td></td><td><strong>Was?</strong></td><td><strong>Datum</strong></td><td><strong>Stunden</strong></td><td><strong>Ausfallfach</strong></td><td><strong>Vertretungsfach</strong></td><td><strong>Bemerkungen</strong></td></thead>
<?php
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$re = mysql_query("SELECT * FROM stunden ORDER BY ID ASC", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
	$phpdate = strtotime($daten['date']);
	$dd[d] = date( 'd', $phpdate );
	$dd[m] = date( 'm', $phpdate );
	$dd[y] = date( 'Y', $phpdate );
	$damalstime = mktime(23, 59, 59, $dd[m], $dd[d], $dd[y]);
	if($jetzt <= $damalstime) {
		$date = date( 'd.m.Y', $phpdate );
		if($daten['ausfalllehrer'] != "") {
			$ausfalllehrer = '('.$daten['ausfalllehrer'].')';
		}
		if($daten['neuerlehrer'] != "") {
			$neuerlehrer = '('.$daten['neuerlehrer'].')';
		}
	echo '<tr><td style="padding: 0px 5px 0px 2px;"><span style="color: red; font-size: 16px;"><a href="stunden.php?del='.$daten['ID'].'" onclick="return confirm(\'Wirklich l&ouml;schen?\');">X</a></span></td><td><span style="color: red;">'.$daten['typ'].'</span></td><td>'.$date.'</td><td>'.$daten['stunden'].'</td><td>'.$daten['ausfallstunde'].' ('.$daten['ausfalllehrer'].')</td><td>'.$daten['neuestunde'].' ('.$daten['neuerlehrer'].')</td><td>'.$daten['infos'].'</td></tr>';
	}
}
?>
</table>
<p align="right" style="padding: 0px;"><a href="javascript:spoil('new');">Neue &Auml;nderung einf&uuml;gen</a></p>
<div id="new" style="<?php if(isset($fehler)) { } else { echo "display:none;"; } ?> border: 1px solid black; padding: 10px;">
<form action="stunden.php" method="post" name="new">
<table border="0">
<tr><td width="100">Was?:</td>
	<td><select name="typ">
<option value="AUSFALL">AUSFALL</option>
<option value="ÄNDERUNG">&Auml;NDERUNG</option>
</select><?php echo $fehler['typ']; ?></td>
</tr>
<tr><td width="100">Datum:</td>
	<td style="line-height: 10px;">
	<input name="date" id="date" type="text"><A HREF="#"
   onClick="javascript: showCalendar('date'); return false;"><img src="images/calendar.png" border="0"></A><br />
	<span style="font-size:10px;">Datumsformat: yyyy-MM-dd</span><?php echo $fehler['date']; ?>
	</td>
</tr>
<tr><td width="100">Stunden:</td>
	<td style="line-height: 10px;"><input name="stunden" type="text"><br />
	<span style="font-size:10px;">Format: 1. + 2. + ...</span><?php echo $fehler['stunden']; ?></td>
</tr>
<tr><td width="100">Ausfallfach:</td>
	<td><input name="afach" type="text"><?php echo $fehler['afach']; ?></td>
</tr>
<tr><td width="100">Ausfalllehrer:</td>
	<td><input name="alehrer" type="text"><?php echo $fehler['alehrer']; ?></td>
</tr>
<tr><td width="100" style="line-height: 9px;">Vertretungsfach:<br /><span style="font-size:10px; padding:0px;">(Optional)</span></td>
	<td><input name="vfach" type="text"><?php echo $fehler['vfach']; ?></td>
</tr>
<tr><td width="100" style="line-height: 9px;">Vertretungslehrer:<br /><span style="font-size:10px; padding:0px;">(Optional)</span></td>
	<td><input name="vlehrer" type="text"><?php echo $fehler['vlehrer']; ?></td>
</tr>
<tr><td width="100" style="line-height: 9px;">Bemerkungen:<br /><span style="font-size:10px; padding:0px;">(Optional)</span></td>
	<td><input name="infos" type="text"><?php echo $fehler['infos']; ?></td>
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
