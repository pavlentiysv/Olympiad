<?php

if (isset($_GET['activator'])) {

  $token = $_GET['activator'];
  $email = null;

  require '../db/dbHandler.inc.php';

  $sql = "SELECT * FROM accounts WHERE token = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../signup.php?error=sqlError");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      header("Location: ../index.php?error=invalidToken");
      exit();
    } else {
      $email = $row['email'];

      $sql = "UPDATE accounts SET status = 1, token = null, password='' WHERE email = ? AND token = ?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlError");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $token);
        mysqli_stmt_execute($stmt);

        header("Location: ../signin.php?success=activation");
        exit();
      }
    }
  }
} else {
  header("Location: ../index.php&error=noActivator");
  exit();
}
