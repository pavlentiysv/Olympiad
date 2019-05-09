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

$password = $_POST['password'];

$newUserType = $_POST['usertype'];
$newSurname = $_POST['surname'];
$newName = $_POST['name'];
$newMiddlename = $_POST['middlename'];
$newCity = $_POST['city'];
$newInstitution_type = $_POST['institution_type'];
$newInstitution_number = $_POST['institution_number'];
$newGrade = $_POST['grade'];
$newGender = $_POST['gender'];
$newYear = $_POST['year'];
$newMonth = $_POST['month'];
$newDay = $_POST['day'];
$newTelephone = $_POST['telephone'];
$newPassword = $_POST['newpassword'];
$newRepeatPassword = $_POST['newrepeatpassword'];

$newPhoto = $_FILES['newphoto'];
$photoNameNew = null;

$newBirthDate = "$newYear-$newMonth-$newDay";

if (empty($newPassword)) {
  $newPassword = null;
}

if (empty($middlename)) {
  $middlename = null;
}

if ($newPhoto['name']==null) {
  $newPhoto = null;
}

if (
  empty($newSurname) || empty($newName) || empty($newCity) || empty($newInstitution_type) || empty($newInstitution_number) || empty($newGrade) || empty($newGender) || empty($newDay) || empty($newMonth) || empty($newYear) || empty($newTelephone)
) {
  header("Location: ../profile.php?error=emptyFields");
  exit();
}

if ($newPassword != null) {
  if ($newPassword != $newRepeatPassword) {
    header("Location: ../profile.php?error=newPasswordNotMatching");
    exit();
  }
}

if (file_exists('../db/dbHandler.inc.php')) {
  require '../db/dbHandler.inc.php';
} else if (file_exists('./db/dbHandler.inc.php')) {
  require './db/dbHandler.inc.php';
} else {
  header("Location: ./profile.php?error=pageNotFound");
}

$sql = "SELECT * FROM accounts WHERE email = ? AND password = md5(?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../profile.php?error=sqlError");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "ss", $session_email, $password);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: ../profile.php?error=passwordNotMatching");
    exit();
  } else {
    $accountID = $row['accountID'];
    $userType = $row['userType'];

    $sql = "SELECT users.surname, users.name, users.middlename, users.city, institutions.type, institutions.number, users.grade, users.gender, users.birthdate, users.telephoneNumber, users.photo FROM users RIGHT JOIN accounts ON accounts.accountID = users.accountID LEFT JOIN institutions ON institutions.institutionID=users.institutionID WHERE accounts.accountID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../profile.php?error=sqlError");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "i", $accountID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if (!$row = mysqli_fetch_assoc($result)) {
        header("Location: ../profile.php?error=infoNotFound");
        exit();
      } else {
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

        $parts = explode("-", $birthDate);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];

        $photoName = null;
        if ($newPhoto != null) {
          $photoName = $newPhoto['name'];
          $photoTmpName = $newPhoto['tmp_name'];
          $photoSize = $newPhoto['size'];
          $photoError = $newPhoto['error'];
          $photoExt = explode('.', $photoName);
          $photoActualExt = strtolower(end($photoExt));
          
          $allowed = array('jpg', 'jpeg', 'png');
          if (in_array($photoActualExt, $allowed)) {
            if ($photoError === 0) {
              if ($photoSize <= 5242880) {
                //5242880 Kb = 5 Mb
                $photoNameNew = $session_email . "." . $photoActualExt;
                $photoDestination = '../uploads/users/avatars/' . $photoNameNew;
                if (file_exists("$photoDestination")) {
                  unlink($photoDestination);
                }
                move_uploaded_file($photoTmpName, $photoDestination);
              } else {
                header("Location: ../profile.php?error=photoSize");
                exit();
              }
            } else {
              header("Location: ../profile.php?error=photoUpload");
              exit();
            }
          } else {
            header("Location: ../profile.php?error=photoExt&".$photoName);
            exit();
          }
        }

        if ($name == $newName && $surname == $newSurname && $middlename == $newMiddlename && $city == $newCity && $institution_type == $newInstitution_type && $institution_number == $newInstitution_number && $gender == $newGender && $day == $newDay && $month == $newMonth && $year == $newYear && $userType == $newUserType && $password == $newPassword && $photo==$photoNameNew) {
          header("Location: ../profile.php?error=nothingUpdate");
          exit();
        } else {
          $sql = "call updateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../profile.php?error=sqlError");
            exit();
          } else {
            mysqli_stmt_bind_param(
              $stmt,
              "sssssssssissss",
              $session_email,
              $newPassword,
              $newUserType,
              $newSurname,
              $newName,
              $newMiddlename,
              $newCity,
              $newInstitution_type,
              $newInstitution_number,
              $newGrade,
              $newGender,
              $newBirthDate,
              $newTelephone,
              $photoNameNew
            );
            mysqli_stmt_execute($stmt);
            header("Location: ../profile.php?update=success");
            exit();
          }
        }
      }
    }
  }
}
