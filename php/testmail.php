<?php
$to = '1361799@gmail.com';
$subject = 'Testing sendmail.exe';
$message = 'Проверка правильности кодировки';
$headers ='From: whereisinput.help@gmail.com' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=utf-8'."\r\n" .'X-Mailer: PHP/' . phpversion();

echo "$to<br>$subject<br>$message<br>$headers";

if (mail($to, $subject, $message, $headers)) {
  echo "Email was sent";
} else {
  echo "Email sending failed";
}