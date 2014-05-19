<?php
## MYSQL - CONFIG ##
$mysql_host = 'localhost';
$mysql_database = 'fi12';
$mysql_user = 'fi12';
$mysql_password = 'pw';
##

$conf['class'] = "Fi12"; # Klassenname
$conf['city'] = "Plauen"; # Schulort
$conf['url'] = "http://fi12-plauen.tk"; # URL der Seite
$conf['admurl'] = "http://admin.fi12-plauen.tk"; # Admin-URL der Seite
$conf['subject5'] = $conf['class']." Erinnerung 5 Tage"; # Betreff für Mails
$conf['subject1'] = $conf['class']." Erinnerung 1 Tage"; # Betreff für Mails
$conf['subjectconfirm'] = $conf['class']." Infoseite - Anmeldung"; # Betreff für Mails
$conf['from'] = "support@fi12-plauen.tk"; # Absendermail
$conf['fromfull'] = $conf['class']."-".$conf['city']." Schulwebsite <".$conf['from'].">"; # Absendermail
$conf['host'] = "ssl://localhost"; # SMTP Server
$conf['port'] = "465"; # PORT
$conf['username'] = "support@fi12-plauen.tk"; # Nutzername
$conf['pw'] = ""; # Passwort
$conf['logpath'] = "/var/www/fi12/notification_log"; # Path für Notification Log

### FTP Daten
$conf['ftp_host'] = "fi12-plauen.tk";
$conf['ftp_port'] = "21";
$conf['ftp_user'] = "fi12";
$conf['ftp_pw'] = "password";


### Texte für die automatischen notifications
$conf['textdavor'] = "Dies ist eine Erinnerungsmail fuer anstehende Hausaufgaben oder Arbeiten.\n";
$conf['hwtext5'] = "Folgende Hausaufgaben sind bis in 5 Tage auf:\n\r";
$conf['abtext5'] = "Folgende Arbeiten sind in 5 Tagen:\n\r";
$conf['hwtext1'] = "Folgende Hausaufgaben sind bis in 1 Tag auf:\n\r";
$conf['abtext1'] = "Folgende Arbeiten sind in 1 Tag:\n\r";
$conf['textdanach'] = "

Weitere Informationen unter ".$conf['url']."
Dein Erinnerungsservice der ".$conf['class']."-".$conf['city']." Seite";
$conf['adminnot'] = 'Hallo!

es sind neue E-Mailadressen vorhanden, welche auf Freischaltung warten.

Bitte autorisiere diese im Adminpanel unter '.$conf['admurl'].' unter "E-Mails".

Deine '.$conf['class'].'-Infoseite

- Dies ist eine automatisch generierte E-Mail! -';

$conf['confirmtext'] = 'Hallo!
	 
du hast dich auf der '.$conf['class'].'-Infoseite registriert und bekommst nun immer eine Benachrichtigung wenn Hausaufgaben und Arbeiten anstehen. Hier deine FTP-Logindaten:
	
Host: '.$conf['ftp_host'].'
PORT: '.$conf['ftp_port'].'
Benutzername: '.$conf['ftp_user'].'
Kennwort: '.$conf['ftp_pw'].'
 
Der FTP ist NICHT fuer private Daten oder Aenliches gedacht, nur fuer unsere Schulsachen.
Bitte auch kein Weitergabe der Daten an andere, vor allem nicht Lehrer!
 
Deine '.$conf['class'].'-Infoseite';


?>
