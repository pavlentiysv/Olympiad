<?php


$session_email = null;
$session_usertype = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  $session_usertype = $_SESSION['userType'];
} else {
  header("Location: ./signin.php?error=noSession");
}

if ($session_email == null) {
  header("Location: ./signin.php?error=noSession");
}

if (file_exists('../db/dbHandler.inc.php')) {
  require '../db/dbHandler.inc.php';
} else if (file_exists('./db/dbHandler.inc.php')) {
  require './db/dbHandler.inc.php';
} else {
  header("Location: ./profile.php?error=pageNotFound");
}

$eventID = null;
$event = null;

if (isset($_GET['eventID'])) {
  $eventID = $_GET['eventID'];
} else {
  header("Location: ./profile.php?error=noEvent");
  exit();
}

if ($session_usertype == 'admin' || $session_usertype == 'org') {
  require 'event.class.php';

  $sql = "SELECT * FROM events WHERE eventID = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./profile.php?error=sqlError");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt,"i",$eventID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows < 1) {
      header("Location: ./profile.php?error=noEvent");
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result))
       {
        $event = new Event($row['eventID'], $row['title'], $row['logo'], $row['country'], $row['city'], $row['street'], $row['houseNumber'], $row['cabinet'], $row['startDate'], $row['endDate'], $row['site'], $row['shortInfo'], $row['fullInfo']);
       } else {
        header("Location: ./profile.php?error=1noEvent");
        exit();
       }
    }
  }
}
