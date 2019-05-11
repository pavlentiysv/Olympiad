<?php
$email = null;
$userType = null;
$surname = null;
$name = null;
$middlename = null;
$city = null;
$institution_type = null;
$institution_number = null;
$grade = null;
$gender = null;
$birthDate = null;
$year = null;
$month = null;
$day = null;
$telephone = null;
$photo = null;

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

$sql = "SELECT accounts.usertype, users.surname, users.name, users.middlename, users.city, institutions.type, institutions.number, users.grade, users.gender, users.birthdate, users.telephoneNumber, users.photo FROM users RIGHT JOIN accounts ON accounts.accountID = users.accountID LEFT JOIN institutions ON institutions.institutionID=users.institutionID WHERE accounts.email = ?";
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
      $email = $_GET['email'];
      $userType = $_GET['usertype'];
      $surname = $_GET['surname'];
      $name = $_GET['name'];
      $middlename = $_GET['middlename'];
      $city = $_GET['city'];
      $institution_type = $_GET['institution_type'];
      $institution_number = $_GET['institution_number'];
      $grade = $_GET['grade'];
      $gender = $_GET['gender'];
      $birthDate = $_GET['birthdate'];
      $telephone = '+' . trim($_GET['telephone']);
      $photo = $_GET['photo'];
    } else {
      $email = $session_email;
      $userType = $session_usertype;
      $surname = $row['surname'];
      $name = $row['name'];
      $middlename = $row['middlename'];
      $city = $row['city'];
      $institution_type = $row['type'];
      $institution_number = $row['number'];
      $grade = $row['grade'];
      $gender = $row['gender'];
      $birthDate = $row['birthdate'];
      $telephone = $row['telephoneNumber'];
      $photo = $row['photo'];
    }

    if ($birthDate != null) {
      $parts = explode("-", $birthDate);
      $year = $parts[0];
      $month = $parts[1];
      $day = $parts[2];
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
        $event[$i] = new Event($row['eventID'], $row['title'], $row['logo'], $row['country'], $row['city'], $row['street'], $row['houseNumber'], $row['cabinet'], $row['startDate'], $row['endDate'], $row['site'], $row['shortInfo'], $row['fullInfo']);

        $i++;
      }
    }
  }
}
