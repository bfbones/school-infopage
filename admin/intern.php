<?php  
include ("checklogin.php");  
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

<div id="container">

<div id="header"><h1>BSZ <?php echo $conf['class']; ?> Infoseite</h1></div>

<div id="sub_header">Admin</div>

<div id="main_content_top"></div>

<div id="main_content">

<div class="content">
<center>
Willkommen in der Konfigurationsoberfl&auml;che der Infoseite "BSZ <?php echo $conf['class']; ?>"!<br /><br /></center>
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
