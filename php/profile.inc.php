<?php
$userEmail = null;
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

$session_email=null;
$session_usertype=null;
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
    $userType = $row['usertype'];
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

    if ($birthDate != null) {
    $parts = explode("-", $birthDate);
    $year = $parts[0];
    $month = $parts[1];
    $day = $parts[2];
    }
  }
}
