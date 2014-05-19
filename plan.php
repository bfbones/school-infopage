<?php 
include("admin/config.php");
if($_GET['gr'] == "1" || $_GET['gr'] == "2") {
$gr = $_GET['gr'];
} else {
echo "Injection Attacke erkannt! Hau ab!";
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="BSZ FI_12a Infoseite" />
	<title>Schule - Stundenplan</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="container">
<div id="header"><h1>BSZ FI_12a Infoseite</h1></div>
<div id="sub_header">Stundenplan</div>
<div id="main_content_top"></div>
<div id="main_content">
<div class="content">
<div style="float:left;"><strong>Stundenplan Gruppe <?php echo $gr; ?></strong></div><div style="float:right; font-size:11px;">
</div><div style="clear: both;"></div><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black; text-align:left;" cellspacing="0" cellpadding="3">
<thead><td><strong>Stunde</strong></span></td><td><strong>Zeit</strong></td><td><strong>Montag</strong></td><td><strong>Dienstag</strong></td><td><strong>Mittwoch</strong></td><td><strong>Donnerstag</strong></td><td><strong>Freitag</strong></td></thead>
<?php
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$re = mysql_query("SELECT plan_gr".$gr.".ID, plan_zeiten.time, plan_gr".$gr.".mon, plan_gr".$gr.".tue, plan_gr".$gr.".wed, plan_gr".$gr.".thu, plan_gr".$gr.".fri FROM `plan_gr".$gr."`
		INNER JOIN `plan_zeiten` ON plan_gr".$gr.".ID=plan_zeiten.ID
		ORDER BY plan_zeiten.ID ASC;", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {			
	echo '<tr><td><strong>'.$daten['ID'].'<strong></td><td><strong>'.$daten['time'].'</strong></td><td>'.$daten['mon'].'</td><td>'.$daten['tue'].'</td><td>'.$daten['wed'].'</td><td>'.$daten['thu'].'</td><td>'.$daten['fri'].'</td></tr>';
}
?>
</table>
</div>

<div class="menu">
<div class="menu_title">Menu</div>
<?php
include("core/menu.php");
include("core/addmail.php");
?>
</div>
<div id="clear"></div>
</div>
<div id="main_content_bottom">
</div>
<div id="footer"><strong>Copyright &copy; <?php echo date("Y"); ?></strong> | <a href="http://konradmallok.de">Konrad Mallok</a></div>
</div>
</body>
</html>
