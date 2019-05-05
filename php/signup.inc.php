<?php

if (isset($_POST['signup-submit'])) {

    require '../db/dbHandler.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $city = $_POST['city'];
    $institution_type = $_POST['institution_type'];
    $institution_number = $_POST['institution_number'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $telephone = $_POST['telephone'];
    $photo = $_POST['photo'];

    $birthdate = $year."-".$month."-".$day;

    if (empty($middlename)) {
        $middlename=null;
    }

    if (empty($photo)) {
        $photo=null;
    }

    if (
        empty($email) || empty($password) || empty($surname) || empty($name) ||
        empty($city) || empty($institution_type) || empty($institution_number) ||
        empty($grade) || empty($gender) || empty($day) || empty($month) || empty($year) ||
        empty($telephone)
    ) {
        header("Location: ../signup.php?error=emptyFields&email=" . $email . "");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidEmail=" . $email . "");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../signup.php?error=passwordNotMatching=" . $email . "");
        exit();
    } else {
        $sql = "SELECT email FROM accounts WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=emailTaken");
                exit();
            } else {
                // $sql= "call addUser('{$email}','{$password}', '{$surname}', '{$name}', '{$middlename}', '{$city}',
                // '{$in}', '{$institution_number}', 14, 'М', '1998-11-12', 291302524, null)";
                $sql = "call addUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlError");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssssssissis", $email, $password, $surname, $name, 
                    $middlename, $city, $institution_type, $institution_number, $grade, $gender, $birthdate, $telephone, $photo);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}
