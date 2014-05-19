Schulinfoseite
=====

Übersicht über Hausaufgaben, Arbeiten, Stundenplanänderungen. Außerdem gibts ein Blackboard und Stundenpläne.

**Anforderungen**
- PHP 5.x
- MySQL 5.x
- Pear::Mail (Debian-Paket: php-mail)
- Mail-Postfach

**Installation**

1. git clone
2. MySQL DB anlegen, setup.sql importieren
3. in Tabelle "Logins" Adminlogin anlegen (PW als MD5.. wird noch geändert)
4. Postfach am SMTP Server anlegen für Absenderadresse der Website
5. admin/config.php entsprechend anpassen. Kommentare beachten.

Admin Login unter /admin.
