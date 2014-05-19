<?php 
include("admin/config.php");
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$jetzt = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="BSZ <?php echo $conf['class']; ?> Infoseite" />
	<title>Schule - &Uuml;bersicht</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="container">
<div id="header"><h1>BSZ <?php echo $conf['class']; ?> Infoseite</h1></div>
<div id="sub_header">&Uuml;bersicht</div>
<div id="main_content_top"></div>
<div id="main_content">
<div class="content">
<div style="float:left;"><strong>Aktuelle Aufgaben</strong></div><div style="float:right; font-size:11px;">
<?php
if($_POST['submit'] == "Eintragen") {
	$ok = 1;
	if(empty($_POST['email'])) {
		$ok = 0;
		$fehler['email'] = '<br /><span style="color: red;">Du musst eine E-Mail angeben!</span>';
	} else {
		if(!preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $_POST['email'])) {
			$ok = 0;
			$fehler['email'] = '<br /><span style="color: red;">Falsches E-Mail Format!</span>';
		}
	}
	if($ok == 1) {
		$sql = "INSERT INTO emails (`ID`,`confirmed`, `email`) 
			VALUES (NULL,'0', '".$_POST['email']."');";
		mysql_query($sql, $link);
		$fehler['email'] = '<br /><span style="color:green;">E-Mail Adresse wurde eingetragen. Du bekommst bald deine FTP-Daten zugesendet.</span>';
	}
}

$re = mysql_query("SELECT * FROM lastupdate WHERE typ = 'homeworks'", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {			
	$phpdate = strtotime( $daten['update'] );
	$mysqldate = date( 'd.m.Y, H:i', $phpdate );
	echo "Zuletzt aktualisiert: ".$mysqldate;
}
?>
</div><div style="clear: both;"></div><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black; text-align:left;" cellspacing="0" cellpadding="3" rules="rows">
<thead><td><strong>Was?</strong></span></td><td><strong>Fach</strong></td><td><strong>Bis zum?</strong></td><td><strong>Infos</strong></td><td><strong>Link?</strong></td></thead>
<?php
$re = mysql_query("SELECT * FROM homeworks ORDER BY date ASC", $link);
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
	echo '<tr><td><span style="color: red;">'.$daten['typ'].'</span></td><td>'.$daten['fach'].'</td><td>'.$date.'</td><td>'.$daten['info'].'</td><td>'.$url.'</td></tr>';
    }
}
?>
</table>
<br />
<div style="float:left;"><strong>Aktuelle Arbeiten</strong></div><div style="float:right; font-size:11px;">
<?php
$re = mysql_query("SELECT * FROM lastupdate WHERE typ = 'arbeiten'", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {			
	$phpdate = strtotime( $daten['update'] );
	$mysqldate = date( 'd.m.Y, H:i', $phpdate );
	echo "Zuletzt aktualisiert: ".$mysqldate;
}
?>
</div><div style="clear: both;"></div><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black; text-align:left;" cellspacing="0" cellpadding="3" rules="rows">
<thead><td><strong>Was?</strong></span></td><td><strong>Fach</strong></td><td><strong>Am?</strong></td><td><strong>Infos</strong></td><td><strong>Link?</strong></td></thead>
<?php
$re = mysql_query("SELECT * FROM arbeiten ORDER BY date ASC", $link);
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
	echo '<tr><td><span style="color: red;">'.$daten['typ'].'</span></td><td>'.$daten['fach'].'</td><td>'.$date.'</td><td>'.$daten['info'].'</td><td>'.$url.'</td></tr>';
	}
}
?>
</table>
<br />
<div style="float:left;"><strong>Stundenplan&auml;nderungen</strong></div><div style="float:right; font-size:11px;">
<?php
$re = mysql_query("SELECT * FROM lastupdate WHERE typ = 'stunden'", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {			
	$phpdate = strtotime( $daten['update'] );
	$mysqldate = date( 'd.m.Y, H:i', $phpdate );
	echo "Zuletzt aktualisiert: ".$mysqldate;
}
?>
</div><div style="clear: both;"></div><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black; text-align:left;" cellspacing="0" cellpadding="3" rules="rows">
<thead><td><strong>Was?</strong></td><td><strong>Datum</strong></td><td><strong>Stunden</strong></td><td><strong>Ausfallfach</strong></td><td><strong>Vertretungsfach</strong></td><td><strong>Bemerkungen</strong></td></thead>
<?php
$re = mysql_query("SELECT * FROM stunden ORDER BY date ASC", $link);
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
		echo '<tr><td><span style="color: red;">'.$daten['typ'].'</span></td><td>'.$date.'</td><td>'.$daten['stunden'].'</td><td>'.$daten['ausfallstunde'].' '.$ausfalllehrer.'</td><td>'.$daten['neuestunde'].' '.$neuerlehrer.'</td><td>'.$daten['infos'].'</td></tr>';
		$ausfalllehrer = "";
		$neuerlehrer = "";
	}
}
?>
</table>
<br />

<strong>Blackboard</strong><hr style="width: 550px;">
<table border="1" width="600" style="border: 1px solid black; text-align:left;" cellspacing="0" rules="rows">
<?php
$re = mysql_query("SELECT * FROM blackboard ORDER BY date DESC limit 0,5", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {			
	$phpdate = strtotime( $daten['date'] );
	$mysqldate = date( 'd.m.Y', $phpdate );
	echo '<tr><td width="115" style="padding-left: 7px;"><strong>'.$mysqldate.'</strong></td><td style="padding:5px;">'.$daten['text'].'</td></tr>';
}
?>
</table>
<br />
</div>

<div class="menu">
<div class="menu_title">Menu</div>
<ul>
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
