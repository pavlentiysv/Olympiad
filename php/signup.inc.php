<?php

if (!isset($_POST['signup-submit'])) {
    header("Location: ../signup.php?error=noSubmit");
    exit();
}

require '../db/dbHandler.inc.php';
require 'config.inc.php';
require 'user.class.php';

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
$photo = $_FILES['photo'];
$userType = null;

$birthdate = $year . "-" . $month . "-" . $day;
$photoNameNew = null; //global for inserting to db
$token = null;
$url = null;

//для проверки правильности почты
$token = bin2hex(random_bytes(8));
$url = "${serverHostIP}/olympiad/php/activation.inc.php?activator=$token";

$autoFill = "&email=${email}&surname=${surname}&name=${name}&middlename=${middlename}&city=${city}&institution_type=${institution_type}&institution_number=${institution_number}&grade=${grade}&gender=${gender}&day=${day}&month=${month}&year=${year}&telephone=${telephone}&$password&$passwordRepeat";

if (empty($middlename)) {
    $middlename = null;
}

if ($photo['name'] == null) {
    $photo = null;
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
}


$sql = "SELECT accountID, email, status FROM accounts WHERE email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../signup.php?error=sqlError${autoFill}");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // <!-- IF email exist --!>
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['status'] == 1) {
            header("Location: ../signup.php?error=emailTaken${autoFill}");
            exit();
        } else {
            // <!-- Update account if No Activation --!>
            $photoNameNew = uploadPhoto($photo);

            $sql = "call updateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlError${autofill}");
                exit();
            } else {
                mysqli_stmt_bind_param(
                    $stmt,
                    "sssssssssissss",
                    $email,
                    $password,
                    $userType,
                    $surname,
                    $name,
                    $middlename,
                    $city,
                    $institution_type,
                    $institution_number,
                    $grade,
                    $gender,
                    $birthdate,
                    $telephone,
                    $photoNameNew
                );
                mysqli_stmt_execute($stmt);

                $sql = "UPDATE accounts SET token = ?, password='' WHERE email = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlError${autoFill}");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
                    mysqli_stmt_execute($stmt);
                }

                sendEmail();
            }
        }
    } else {
        $photoNameNew = uploadPhoto($photo);

        $sql = "call addUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlError${autoFill}");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssssssssissss", $email, $password,  $token, $surname, $name, $middlename, $city, $institution_type, $institution_number, $grade, $gender, $birthdate, $telephone, $photoNameNew);
            mysqli_stmt_execute($stmt);

            sendEmail();
        }
    }
}



function uploadPhoto($photo)
{
    global $autoFill;
    global $email;
    //<!-- Checking photo input --!>
    if ($photo != null) {
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $photoSize = $photo['size'];
        $photoError = $photo['error'];
        $photoExt = explode('.', $photoName);
        $photoActualExt = strtolower(end($photoExt));

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($photoActualExt, $allowed)) {
            if ($photoError === 0) {
                if ($photoSize <= 5242880) {
                    //5242880 Kb = 5 Mb
                    $photoNameNew = $email . "." . $photoActualExt;
                    $photoDestination = '../uploads/users/avatars/' . $photoNameNew;
                    move_uploaded_file($photoTmpName, $photoDestination);
                } else {
                    header("Location: ../signup.php?error=photoSize${autoFill}");
                    exit();
                }
            } else {
                header("Location: ../signup.php?error=photoUpload${autoFill}");
                exit();
            }
        } else {
            header("Location: ../signup.php?error=photoExt${autoFill}");
            exit();
        }
    }
    return $photoNameNew;
}

function sendEmail()
{
    global $email;
    global $url;

    $to = $email;
    $subject = 'Подтверждение регистрации на сайте Олимпиады БГУИР';
    $message = '<p>Для подтверждения регистрации на сайте Олимпиады БГУИР перейдите по ссылке ниже. Если вы не регистрировались на сайте, то проигнорируйте это сообщение.</p>';
    $message .= '<p>Вот ваша ссылка для подтверждения почты: </br>';
    $message .= "<a href='$url'>$url</a></p>";

    $headers = 'From: whereisinput.help@gmail.com' . " \r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        header("Location: ../signin.php?success=signup");
        exit();
    } else {
        header("Location: ../signup.php?error=emailSendError");
        exit();
    }
}
