<?php 
$vbsScriptLocation = 'E:/wamp/wamp64/www/Olympiad/VBS/wordHandler.vbs';
$vbsParameters = 'E:/wamp/wamp64/www/Olympiad/db/Tasks/olimp_mat2009.docx'; //if more then 1 word in ""
$WshShell = new COM("WScript.Shell"); 
$oExec = $WshShell->Run($vbsScriptLocation.' "'.$vbsParameters.'"', 3, true); 
// E:/wamp/wamp64/www/Olympiad/VBS/wordHandler.vbs E:/wamp/wamp64/www/Olympiad/db/Tasks/olimp_mat2009.docx
echo "А теперь все огонь";?>