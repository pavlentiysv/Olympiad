<?php

require 'php/session.inc.php';
require 'php/printSelect.inc.php';
require 'user.class.php';

$user = null;

$session_email = null;
$session_usertype = null;
$session_accountID = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  $session_usertype = $_SESSION['userType'];
  $session_accountID = $_SESSION['accountID'];
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

$sql = "SELECT accounts.usertype, accounts.registrationDate, accounts.status, users.surname, users.name, users.middlename, users.city, institutions.type, institutions.number, users.grade, users.gender, users.birthdate, users.telephoneNumber, users.photo FROM users RIGHT JOIN accounts ON accounts.accountID = users.accountID LEFT JOIN institutions ON institutions.institutionID=users.institutionID WHERE accounts.email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ./profile.php?error=sqlError");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "s", $session_email);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: ./signin.php?error=infoNotFound");
    exit();
  } else {
    if (isset($_GET['email'])) {
      $user = new User(null, $_GET['email'], null, $_GET['usertype'], null, null, $_GET['surname'], $_GET['name'], $_GET['middlename'], $_GET['city'], $_GET['institution_type'], $_GET['institution_number'], $_GET['grade'], $_GET['gender'], $_GET['birthdate'], "+".trim($_GET['telephone']), $_GET['photo']);
    } else {
      $user = new User($session_accountID, $session_email, null, $session_usertype, $row['registrationDate'], 1, $row['surname'], $row['name'], $row['middlename'], $row['city'], $row['type'], $row['number'], $row['grade'], $row['gender'], $row['birthdate'], $row['telephoneNumber'], $row['photo']);
    }
  }
}


// <!-- FOR EVENTS --!>

if ($session_usertype == 'admin' || $session_usertype == 'org') {
  require 'event.class.php';
  $event = array();

  $sql = "SELECT * FROM events ORDER BY startDate DESC";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./profile.php?error=sqlError");
    exit();
  } else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows < 1) {
      header("Location: ./profile.php?error=noEvent");
      exit();
    } else {
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $event[$i] = new Event($row['eventID'], $row['title'], $row['logo'], $row['country'], $row['city'], $row['street'], $row['houseNumber'], $row['cabinet'], $row['startDate'], $row['endDate'], $row['site'], $row['shortInfo'], $row['fullInfo'], $row['isPublished']);

        $i++;
      }
    }
  }
}


// <!-- FOR UNLOADING --!>

if ($session_usertype == 'admin') {
  $table = array();

  $sql = "SHOW TABLES";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./profile.php?error=sqlError");
    exit();
  } else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows < 1) {
      header("Location: ./profile.php?error=noTables");
      exit();
    } else {
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $table[$i] = $row['Tables_in_bsuir_olympiad'];
        $i++;
      }
    }
  }
}
