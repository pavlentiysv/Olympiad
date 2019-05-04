<?php

if (isset($_POST['signin-submit'])) {
    
    require '../db/dbHandler.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../signin.php?error=emptyFields");
        exit();
    } else {
        $sql = "SELECT * FROM accounts WHERE email = ? AND password = md5(?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signin.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['accountID'] = $row['accountID'];
                // Заменит потом на Имя Фамилию для использования по сайту
                $_SESSION['userEmail'] = $row['email'];
                
                header("Location: ../signin.php?signin=success");
                exit();
            } else {
                header("Location: ../signin.php?error=noGmail");
                exit();
            }
        }
    }

} else {
    header("Location: ../signin.php");
    exit();
}