<?php

if (isset($_POST["reset-password-submit"])) {
  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];

  if (empty($password) || empty($passwordRepeat)) {
    header("Location: ../create-new-password.php?error=emptyFields&selector=$selector&validator=$validator");
    exit();
  } else if ($password != $passwordRepeat) {
    header("Location: ../create-new-password.php?error=passwordNotMatching&selector=$selector&validator=$validator");
    exit();
  }

  $currentDate = date("U");

  require '../db/dbHandler.inc.php';

  $sql = "SELECT * FROM password_reset WHERE selector=? AND expires >= ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Произошла непредвиденная ошибка.";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      echo "Вы должны подтвердить заново ваш запрос восстановления.";
      exit();
    } else {
      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row["token"]);

      if (!$tokenCheck) {
        echo "Вы должны подтвердить заново ваш запрос восстановления.";
        exit();
      } elseif ($tokenCheck) {
        $tokenEmail = $row['email'];
        $sql = "SELECT * FROM accounts WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "Произошла непредвиденная ошибка.";
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          if (!$row = mysqli_fetch_assoc($result)) {
            echo "Произошла непредвиденная ошибка.";
            exit();
          } else {
            $sql = "UPDATE accounts SET password=? WHERE email=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "Произошла непредвиденная ошибка.";
              exit();
            } else {
              mysqli_stmt_bind_param($stmt, "ss", $password, $tokenEmail);
              mysqli_stmt_execute($stmt);

              $sql = "DELETE FROM password_reset WHERE email=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Произошла непредвиденная ошибка.";
                exit();
              } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);

                header("Location: ../signin.php?newpwd=success");
              }
            }
          }
        }
      }
    }
  }
} else {
  header("Location: ../index.php");
}
