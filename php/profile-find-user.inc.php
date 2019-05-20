<?php

require 'session.inc.php';
require 'user.class.php';

$desiredUser = null;

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

$sql = "SELECT * FROM users RIGHT JOIN accounts ON accounts.accountID = users.accountID LEFT JOIN institutions ON institutions.institutionID=users.institutionID WHERE accounts.email = ?";
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
    $desiredUser = new User($row['accountID'], $row['email'], null, $row['userType'], $row['registrationDate'], 1, $row['surname'], $row['name'], $row['middlename'], $row['city'], $row['type'], $row['number'], $row['grade'], $row['gender'], $row['birthDate'], $row['telephoneNumber'], $row['photo']);
  }

  header("Location: ../profile.php?search=success".$desiredUser->getAutoFill());
}

