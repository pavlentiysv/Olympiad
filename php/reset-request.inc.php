<?php
require 'config.inc.php';

if (isset($_POST['reset-request-submit'])) {
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);
  $url = "${serverHostIP}/olympiad/create-new-password.php?selector=$selector&validator=" . bin2hex($token);
  $expires = date("U") + 1800;

  require '../db/dbHandler.inc.php';
  $userEmail = $_POST['email'];

  $sql = "SELECT * FROM accounts WHERE email=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../reset-password.php?error=sqlError");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      header("Location: ../reset-password.php?error=UserNotFound");
      exit();
    }
  }

  $sql = "DELETE FROM password_reset WHERE email=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Произошла непредвиденная ошибка";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO password_reset (email, selector, token, expires) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Произошла непредвиденная ошибка";
    exit();
  } else {
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  $to = $userEmail;
  $subject = 'Восстановление пароля на сайте олимпиады БГУИР';
  $message = '<p>Мы получили запрос для восстановления вашего пароля. Ссылка для восстановления находится ниже. Если вы не посылали запрос проигнорируйте это сообщение.</p>';
  $message .= '<p>Вот ваша ссылка для восстановления пароля: </br>';
  $message .= "<a href='$url'>$url</a></p>";

  $headers = 'From: whereisinput.help@gmail.com' . " \r\n";
  $headers .= 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();

  if (mail($to, $subject, $message, $headers)) {
    header("Location: ../reset-password.php?reset=success");
  } else {
    header("Location: ../reset-password.php?error=emailSendError");
  }
} else {
  header("Location: ../index.php");
}
