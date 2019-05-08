<?php
$to = '1361799@gmail.com';
$subject = 'Testing sendmail.exe';
$message = 'Проверка правильности кодировки';
$headers ='From: whereisinput.help@gmail.com' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=utf-8'."\r\n" .'X-Mailer: PHP/' . phpversion();

echo "$to<br>$subject<br>$message<br>$headers";
// if (mail($to, $subject, $message, $headers)) {
//   echo "Email was sent";
// } else {
//   echo "Email sending failed";
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style/main.css" />
    <link rel="stylesheet" href="style/fixed.css" />
    <link rel="stylesheet" href="style/profile.css" />
    <link rel="icon" href="img/bsuirlogo_mini.png" />
    <title>Тесты</title>
</head>
<body>
<img class="avatar" src="./uploads/users/avatars/greerz@mail.ru.png>" alt="avatar">
</body>
