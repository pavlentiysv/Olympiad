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

    $autoFill = "&email=${email}&surname=${surname}&name=${name}&middlename=${middlename}&city=${city}&institution_type=${institution_type}&institution_number=${institution_number}&grade=${grade}&gender=${gender}&day=${day}&month=${month}&year=${year}&telephone=${telephone}&photo=${photo}";
    
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
        header("Location: ../signup.php?error=emptyFields${autoFill}");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidEmail${autoFill}");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../signup.php?error=passwordNotMatching${autoFill}");
        exit();
    } else {
        $sql = "SELECT email FROM accounts WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlError${autoFill}");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=emailTaken${autoFill}");
                exit();
            } else {
                $sql = "call addUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlError${autoFill}");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssssssissss", $email, $password, $surname, $name, 
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
