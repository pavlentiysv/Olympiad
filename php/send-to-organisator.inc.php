<?php

$email = null;
$emailTo = null;
$eventID = null;
$message = null;

$accountID = null;

if (isset($_POST['message-submit'])) {
  $email = $_POST['email'];
  $eventID = $_POST['eventID'];
  $message = $_POST['message'];
} else {
  header("Location: ../event.php&error=noSubmit&eventID=$eventID");
  exit();
}

$conn = getConnection();

$sql = "SELECT * FROM events_users WHERE eventID = ? AND isOrganisator=1 LIMIT 1";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../event.php&error=sqlError&eventID=$eventID");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "i", $eventID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($result)) {
    $accountID = $row['accountID'];
  } else {
    header("Location: ../event.php&error=noOrganisator&eventID=$eventID");
    exit();
  }
}

$sql = "SELECT * FROM accounts WHERE accountID = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../event.php&error=sqlError&eventID=$eventID");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "i", $accountID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($result)) {
    $emailTo = $row['email'];
  } else {
    header("Location: ../event.php&error=noAccount&eventID=$eventID");
    exit();
  }
}

$to = $emailTo;
$subject = "Вопрос организатору от $email";

$headers = 'From: whereisinput.help@gmail.com' . " \r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
  header("Location: ../event.php?success=emailSend&eventID=$eventID");
} else {
  header("Location: ../event.php?error=emailSendError&eventID=$eventID");
}

function getConnection()
{
  if (file_exists('../db/dbHandler.inc.php')) {
    require '../db/dbHandler.inc.php';
  } else if (file_exists('./db/dbHandler.inc.php')) {
    require './db/dbHandler.inc.php';
  } else {
    header("Location: ./profile.php?error=pageNotFound");
  }
  return $conn;
}
