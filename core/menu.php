<?php
echo '<ul>
<li><a href="index.php"><span>&Uuml;bersicht</span></a></li>
<li><a href="plan.php?gr=1"><span>Stundenplan GR1</span></a></li>
<li><a href="plan.php?gr=2"><span>Stundenplan GR2</span></a></li>
<li><a href="ftp://'.$conf['ftp_host'].':'.$conf['ftp_port'].'" target="_blank"><span>Filebrowser (FTP)</span></a></li>
</ul>';
?>
