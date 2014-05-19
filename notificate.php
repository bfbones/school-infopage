<?php
error_reporting(0);
require_once "Mail.php";
require("admin/config.php");
$homeworks;
$arbeiten;
$jetzt = time();
$z5 = 1;
$z1 = 1;
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$re = mysql_query("SELECT * FROM homeworks", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
	$splitdate = explode("-",$daten['date']);
	$time51 = mktime(0, 0, 1, $splitdate[1], $splitdate[2]-5, $splitdate[0]);
	$time52 = mktime(23, 59, 59, $splitdate[1], $splitdate[2]-5, $splitdate[0]);
	$time11 = mktime(0, 0, 1, $splitdate[1], $splitdate[2]-1, $splitdate[0]);
	$time12 = mktime(23, 59, 59, $splitdate[1], $splitdate[2]-1, $splitdate[0]);
	if($jetzt >= $time51 and $jetzt <= $time52) {
	    $homeworks[5][$z5][typ] = $daten['typ'];
	    $homeworks[5][$z5][fach] = $daten['fach'];
	    $homeworks[5][$z5][date] = $daten['date'];
	    $homeworks[5][$z5][info] = $daten['info'];
	    $homeworks[5][$z5][link] = $daten['link'];
	    $z5++;
// 	    print_r($homeworks[5][$z]);
	}
	if($jetzt >= $time11 and $jetzt <= $time12) {
	    $homeworks[1][$z1][typ] = $daten['typ'];
	    $homeworks[1][$z1][fach] = $daten['fach'];
	    $homeworks[1][$z1][date] = $daten['date'];
	    $homeworks[1][$z1][info] = $daten['info'];
	    $homeworks[1][$z1][link] = $daten['link'];
	    $z1++;
// 	    print_r($homeworks[1][$z]);
	}
       }
$z5 = 1;
$z1 = 1;

$re = mysql_query("SELECT * FROM arbeiten", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
	$splitdate = explode("-",$daten['date']);
	$time51 = mktime(0, 0, 1, $splitdate[1], $splitdate[2]-5, $splitdate[0]);
	$time52 = mktime(23, 59, 59, $splitdate[1], $splitdate[2]-5, $splitdate[0]);
	$time11 = mktime(0, 0, 1, $splitdate[1], $splitdate[2]-1, $splitdate[0]);
	$time12 = mktime(23, 59, 59, $splitdate[1], $splitdate[2]-1, $splitdate[0]);
	if($jetzt >= $time51 and $jetzt <= $time52) {
	    $arbeiten[5][$z5][typ] = $daten['typ'];
	    $arbeiten[5][$z5][fach] = $daten['fach'];
	    $arbeiten[5][$z5][date] = $daten['date'];
	    $arbeiten[5][$z5][info] = $daten['info'];
	    $arbeiten[5][$z5][link] = $daten['link'];
	    $z5++;
// 	    print_r($arbeiten[5][$z]);
	}
	if($jetzt >= $time11 and $jetzt <= $time12) {
	    $arbeiten[1][$z1][typ] = $daten['typ'];
	    $arbeiten[1][$z1][fach] = $daten['fach'];
	    $arbeiten[1][$z1][date] = $daten['date'];
	    $arbeiten[1][$z1][info] = $daten['info'];
	    $arbeiten[1][$z1][link] = $daten['link'];
	    $z1++;
// 	    print_r($arbeiten[1][$z]);
	}
       }

for($i = 1; $i <= count($homeworks[5]); $i++) {
$splitdate = explode("-",$homeworks[5][$i][date]);
$date = $splitdate[2].'.'.$splitdate[1].'.'.$splitdate[0];
$homeworks5 .= $date." ".$homeworks[5][$i][typ].": ".$homeworks[5][$i][fach]." ".$homeworks[5][$i][info]."\n";
}
for($i = 1; $i <= count($homeworks[1]); $i++) {
$splitdate = explode("-",$homeworks[1][$i][date]);
$date = $splitdate[2].'.'.$splitdate[1].'.'.$splitdate[0];
$homeworks1 .= $date." ".$homeworks[1][$i][typ].": ".$homeworks[1][$i][fach]." ".$homeworks[1][$i][info]."\n";
}

for($i = 1; $i <= count($arbeiten[5]); $i++) {
$splitdate = explode("-",$arbeiten[5][$i][date]);
$date = $splitdate[2].'.'.$splitdate[1].'.'.$splitdate[0];
$arbeiten5 .= $date." ".$arbeiten[5][$i][typ].": ".$arbeiten[5][$i][fach]." ".$arbeiten[5][$i][info]."\n";
}
for($i = 1; $i <= count($arbeiten[1]); $i++) {
$splitdate = explode("-",$arbeiten[1][$i][date]);
$date = $splitdate[2].'.'.$splitdate[1].'.'.$splitdate[0];
$arbeiten1 .= $date." ".$arbeiten[1][$i][typ].": ".$arbeiten[1][$i][fach]." ".$arbeiten[1][$i][info]."\n";
}
logg("############### Logeintrag ".date("d.m.Y H:i:s")." #############\n");


if($homeworks5 != 0 or $arbeiten5 != 0) {
$nottext5 = $conf['textdavor5'];
if($homeworks5 != 0) {
$nottext5 .= $conf['hwtext5'].$homeworks5;
$nottext5 .= "\n\r";
logg("Hausaufgaben in 5 Tagen vorhanden\n");
} else {
logg("keine Hausaufgaben in 5 Tagen\n");
}
if($arbeiten5 != 0) {
$nottext5 .= $conf['abtext5'].$arbeiten5;
logg("Arbeiten in 5 Tagen vorhanden\n");
} else {
logg("keine Arbeiten in 5 Tagen\n");
}
$nottext5 .= $conf['textdanach'];
} else {
logg("keine Hausaufgaben oder Arbeiten in 5 Tagen\n");
}

if($homeworks1 != 0 or $arbeiten1 != 0) {
$nottext1 = $conf['textdavor'];
if($homeworks1 != 0) {
$nottext1 .= $conf['hwtext'].$homeworks1;
$nottext1 .= "\n\r";
logg("Hausaufgaben in 1 Tag vorhanden\n");
} else {
logg("keine Hausaufgaben in 1 Tag\n");
}

if($arbeiten1 != 0) {
$nottext1 .= $conf['abtext'].$arbeiten1;
logg("Arbeiten in 1 Tag vorhanden\n");
} else {
logg("keine Arbeiten in 1 Tag\n");
}
$nottext1 .= $conf['textdanach'];
} else {
logg("keine Hausaufgaben oder Arbeiten in 1 Tag\n");
}

if($nottext5 != "") {
    logg("Email fuer 5 Tage wird verschickt\n");
    sendmails($conf['subject5'], $nottext5);
} else {
logg("keine Email fuer 5 Tage verschickt\n");
}
if($nottext1 != "") {
    logg("Email fuer 1 Tag wird verschickt\n");
    sendmails($conf['subject1'], $nottext1);
} else {
logg("keine Email fuer 1 Tag verschickt\n");
}
logg("######################################################\n");

function sendmails($betreff, $text) {
require("pw.php"); 
require("admin/config.php"); 
$from = $conf['fromfull'];
 
$host = $conf['host'];
$port = $conf['port'];
$username = $conf['username'];
$password = $conf['pw'];

$smtp = Mail::factory('smtp',
   array ('host' => $host,
     'port' => $port,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db = mysql_select_db($mysql_database);
$re = mysql_query("SELECT * FROM emails", $link);
while($daten = mysql_fetch_array($re, MYSQL_ASSOC))
            {
		$to = $daten['email'];
		$headers = array ('From' => $from,
   				'To' => $to,
   				'Subject' => $betreff);
		if($daten['confirmed'] == 1) {
 		$mail = $smtp->send($to, $headers, $text);
		}
 		if (PEAR::isError($mail)) {
   			logg($mail->getMessage());
  		} else {
   			logg("Nachricht an ".$to." verschickt\n");
 		}
 
       }
}


/////////////////Administratoren bei neuen freizuschaltenden Mails informieren
$adminmails = array();
$re = mysql_query("SELECT * FROM emails WHERE confirmed =  '0'", $link);
if(mysql_num_rows($re) > 0) {
	logg("Es sind E-Mails zum freischalten vorhanden\n");
	$from = $conf['fromfull'];

	$host = $conf['host'];
	$port = $conf['port'];
	$username = $conf['username'];
	$password = $conf['pw'];

	$smtp = Mail::factory('smtp',
	   array ('host' => $host,
	     'port' => $port,
	     'auth' => true,
	     'username' => $username,
	     'password' => $password));
	

	$re = mysql_query("SELECT * FROM login", $link);
	while($daten = mysql_fetch_array($re, MYSQL_ASSOC)) {
			$to = $daten['email'];
			$headers = array ('From' => $from,
                                'To' => $to,
                                'Subject' => 'Neue E-Mails!');
                		$mail = $smtp->send($to, $headers, $conf['adminnot']);
                	if (PEAR::isError($mail)) {
                        	logg($mail->getMessage());
                	} else {
                        	logg("Nachricht an Admin ".$to." verschickt\n");
                	}
	
       }


} else {
	logg("Keine E-Mails zum Freischalten vorhanden\n");
} 

logg("######################################################\n\n");

function logg($text) {
$fp = fopen($conf['logpath'],"a");
fwrite($fp, $text);
fclose($fp);
}
?>
