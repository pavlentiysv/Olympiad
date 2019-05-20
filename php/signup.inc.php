<?php

if (!isset($_POST['signup-submit'])) {
  header("Location: ../signup.php?error=noSubmit");
  exit();
}

require '../db/dbHandler.inc.php';
require 'config.inc.php';
require 'user.class.php';
$newUser = null;

$newUser = new User(null, $_POST['email'], $_POST['password'], null, null, null, $_POST['surname'], $_POST['name'], $_POST['middlename'], $_POST['city'], $_POST['institution_type'], $_POST['institution_number'], $_POST['grade'], $_POST['gender'], date("y-m-d", strtotime($_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'])), $_POST['telephone'], null);

$passwordRepeat = $_POST['passwordRepeat'];
$photo = $_FILES['photo'];

$photoNameNew = null; //global for inserting to db
$token = null;
$url = null;

//для проверки правильности почты
$token = bin2hex(random_bytes(8));
$url = "${serverHostIP}/olympiad/php/activation.inc.php?activator=$token";

if (empty($middlename)) {
  $middlename = null;
}

if ($photo['name'] == null) {
  $photo = null;
}

if (
        empty($newUser->getEmail()) || empty($newUser->getPassword()) || empty($newUser->getSurname()) || empty($newUser->getName()) ||
        empty($newUser->getCity()) || empty($newUser->getInstitutionType()) || empty($newUser->getInstitutionNumber()) ||
        empty($newUser->getGrade()) || empty($newUser->getGender()) || empty($newUser->getBirthDate()) ||
        empty($newUser->getTelephoneNumber())
) {
  header("Location: ../signup.php?error=emptyFields" . $newUser->getAutoFill());
  exit();
} else if (!filter_var($newUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
  header("Location: ../signup.php?error=invalidEmail".$newUser->getAutoFill());
  exit();
} else if ($newUser->getPassword() != $passwordRepeat) {
  header("Location: ../signup.php?error=passwordNotMatching".$newUser->getAutoFill());
  exit();
}


$sql = "SELECT accountID, email, status FROM accounts WHERE email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../signup.php?error=sqlError".$newUser->getAutoFill());
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  // <!-- IF email exist --!>
  if ($row = mysqli_fetch_assoc($result)) {
    if ($row['status'] == 1) {
      header("Location: ../signup.php?error=emailTaken".$newUser->getAutoFill());
      exit();
    } else {
      // <!-- Update account if No Activation --!>
      $photoNameNew = uploadPhoto($photo, $newUser->getEmail());

      $sql = "call updateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlError".$newUser->getAutoFill());
        exit();
      } else {
        mysqli_stmt_bind_param(
                $stmt, "sssssssssissss", $email, $password, $userType, $surname, $name, $middlename, $city, $institution_type, $institution_number, $grade, $gender, $birthdate, $telephone, $photoNameNew
        );
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE accounts SET token = ?, password='' WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlError".$newUser->getAutoFill());
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "ss", $token, $email);
          mysqli_stmt_execute($stmt);
        }

        sendEmail();
      }
    }
  } else {
    $newUser->setPhoto(uploadPhoto($photo));

    $email = $newUser->getEmail();
    $password = $newUser->getPassword();
    $userType = $newUser->getUserType();
    $surname = $newUser->getSurname();
    $name = $newUser->getName();
    $middlename = $newUser->getMiddlename();
    $city = $newUser->getCity();
    $institution_type = $newUser->getInstitutionType();
    $institution_number = $newUser->getInstitutionNumber();
    $grade = $newUser->getGrade();
    $gender = $newUser->getGender();
    $birthdate = date("y", strtotime($newUser->getBirthDate()))."-".date("m", strtotime($newUser->getBirthDate()))."-".date("d", strtotime($newUser->getBirthDate()));
    $telephone = $newUser->getTelephoneNumber();
    $photoNameNew = $newUser->getPhoto();

    $sql = "call addUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlError".$newUser->getAutoFill());
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "sssssssssissss", $email, $password, $token, $surname, $name, $middlename, $city, $institution_type, $institution_number, $grade, $gender, $birthdate, $telephone, $photoNameNew);
      mysqli_stmt_execute($stmt);

      sendEmail($newUser->getEmail());
    }
  }
}

function uploadPhoto($photo, $email) {
  global $autoFill;
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

function sendEmail($email) {
  global $newUser;
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
