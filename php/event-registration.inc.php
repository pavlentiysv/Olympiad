<?php
require 'session.inc.php';
$session_email = null;
$session_usertype = null;
$session_accountID = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  $session_usertype = $_SESSION['userType'];
  $session_accountID = $_SESSION['accountID'];
} else {
  header("Location: ../signin.php?error=noSession");
}

if ($session_email == null) {
  header("Location: ../signin.php?error=noSession");
}

$eventID = null;
$conn = getConnection();

if (isset($_POST['registration-submit'])) {
  if (isset($_POST['eventID'])) {
    $eventID = $_POST['eventID'];

    $sql = "INSERT INTO events_users (eventID, accountID, isOrganisator) VALUES ($eventID, $session_accountID,0)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../event.php?error=sqlError$autoFill");
      exit();
    } else {
      mysqli_stmt_execute($stmt);

      header("Location: ../event.php?success=registartion&eventID=$eventID");
      exit();
    }
  } else {
    header("Location: ../event.php?error=noEventID$autoFill");
    exit();
  }
} else {
  header("Location: ../event.php?error=noSubmit$autoFill");
  exit();
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