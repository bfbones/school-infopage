<?php
echo '<br /><hr style="width: 140px;" noshade="1" />
Benachrichtigung und FTP-Zugang:
<form action="index.php" method="post">
<input type="text" name="email" placeholder="info@example.de" style="width: 140px;" />'.$fehler['email'].'
<div style="padding:0; float:right;"><input type="submit" name="submit" value="Eintragen" /></div>
</form>';
?>