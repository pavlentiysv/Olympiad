<?php
require 'session.inc.php';

if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  if (!empty($_SESSION['userType'])) {
    $session_usertype = $_SESSION['userType'];
  } else {
    $session_usertype = null;
  }
} else {
  header("Location: ../signin.php?error=noSession");
}

if (isset($_POST['submit-search'])) {
  $desiredUserEmail = $_POST['desired-email'];
} else if (isset($_GET['email'])) {
  $desiredUserEmail = $_GET['email'];
} else {
  header("Location: ../profile.php?error=noSubmit");
  exit();
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
  header("Location: ../profile.php?error=sqlError");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "s", $desiredUserEmail);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: ../profile.php?error=userNotFound");
    exit();
  } else {
    $email = $desiredUserEmail;
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

    $autoFill = "&email=${email}&usertype=$userType&surname=${surname}&name=${name}&middlename=${middlename}&city=${city}&institution_type=${institution_type}&institution_number=${institution_number}&grade=${grade}&gender=${gender}&day=${day}&month=${month}&year=${year}&birthdate=$birthDate&telephone=${telephone}&photo=$photo";

    header("Location: ../profile.php?search=success$autoFill");
  }
}
