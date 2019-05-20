<?php

require 'session.inc.php';
require 'user.class.php';

$desiredUser = null; //которого надо поменять
$newUser = null; //новая инфа о том кого надо поменять
$curUser = User::create(); //меняющий пользователь (мб админ)

$session_email = null;
$session_usertype = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  if (!empty($_SESSION['userType'])) {
    $session_usertype = $_SESSION['userType'];
  } else {
    $session_usertype = null;
  }
} else {
  header("Location: ../signin.php?error=noSession");
  exit();
}

if (isset($_POST['update-submit'])) {
  $newUser = new User(null, $_POST['email'], null, $_POST['usertype'], null, null, $_POST['surname'], $_POST['name'], $_POST['middlename'], $_POST['city'], $_POST['institution_type'], $_POST['institution_number'], $_POST['grade'], $_POST['gender'], date("y-m-d", strtotime($_POST['year'] ."-". $_POST['month'] ."-". $_POST['day'])), $_POST['telephone'], null);

  $curUser->setEmail($session_email);
  $curUser->setPassword($_POST['password']);
  $newRepeatPassword = $_POST['newrepeatpassword'];

  $newPhoto = $_FILES['newphoto'];
} else {
  header("Location: ../profile.php?error=noSubmit");
  exit();
}

if (!empty($_POST['newPassword'])) {
  $newUser->setPassword($_POST['newPassword']);
}

if ($newPhoto['name'] == null) {
  $newPhoto = null;
}

if (
        empty($newUser->getSurname()) || empty($newUser->getName()) || empty($newUser->getCity()) || empty($newUser->getInstitutionType()) || empty($newUser->getInstitutionNumber()) || empty($newUser->getGrade()) || empty($newUser->getGender()) || empty($newUser->getBirthDate()) || empty($newUser->getTelephoneNumber())
) {
  header("Location: ../profile.php?error=emptyFields");
  exit();
}

if ($newUser->getPassword() != null) {
  if ($newUser->getPassword() != $newRepeatPassword) {
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

// <!-- Проверка пароля по сессии (как для админа так и для пользователей) --!>
$sql = "SELECT * FROM accounts WHERE email = ? AND password = md5(?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../profile.php?error=sqlError");
  exit();
} else {
  $curPassword = $curUser->getPassword();
  mysqli_stmt_bind_param($stmt, "ss", $session_email, $curPassword);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: ../profile.php?error=passwordNotMatching");
    exit();
  } else {

    // <!-- Выборка инфы о пользователе, указанного в форме редактирования --!>
    $sql = "SELECT * FROM users RIGHT JOIN accounts ON accounts.accountID = users.accountID LEFT JOIN institutions ON institutions.institutionID=users.institutionID WHERE accounts.email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../profile.php?error=sqlError");
      exit();
    } else {
      $desiredEmail = $newUser->getEmail();
      mysqli_stmt_bind_param($stmt, "s", $desiredEmail);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if (!$row = mysqli_fetch_assoc($result)) {
        header("Location: ../profile.php?error=infoNotFound");
        exit();
      } else {
        $desiredUser = new User($row['accountID'], $row['email'], null, $row['userType'], $row['registrationDate'], 1, $row['surname'], $row['name'], $row['middlename'], $row['city'], $row['type'], $row['number'], $row['grade'], $row['gender'], $row['birthDate'], $row['telephoneNumber'], $row['photo']);

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
                $photoNameNew = $newUser->getEmail(). "." . $photoActualExt;
                $photoDestination = '../uploads/users/avatars/' . $photoNameNew;
                if (file_exists("../uploads/users/avatars/$photoName")) {
                  unlink("../uploads/users/avatars/$photoName");
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
            header("Location: ../profile.php?error=photoExt&" . $photoName);
            exit();
          }
        } else {
          $photoNameNew = $desiredUser->getPhoto();
        }
        $newUser->setPhoto($photoNameNew);

        if ($desiredUser->getName() == $newUser->getName() &&
                $desiredUser->getSurname() == $newUser->getSurname() &&
                $desiredUser->getMiddlename() == $newUser->getMiddlename() &&
                $desiredUser->getCity() == $newUser->getCity() &&
                $desiredUser->getInstitutionType() == $newUser->getInstitutionType() &&
                $desiredUser->getInstitutionNumber() == $newUser->getInstitutionNumber() &&
                $desiredUser->getGrade() == $newUser->getGrade() &&
                $desiredUser->getGender() == $newUser->getGender() &&
                $desiredUser->getBirthDate() == $newUser->getBirthDate() &&
                $desiredUser->getUserType() == $newUser->getUserType() &&
                $desiredUser->getPassword() == $newUser->getPassword() &&
                $desiredUser->getPhoto() == $newUser->getPhoto()) {
          header("Location: ../profile.php?error=nothingUpdate");
          exit();
        } else {
          $sql = "call updateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../profile.php?error=sqlError");
            exit();
          } else {
            $email = $newUser->getEmail();
            $newPassword = $newUser->getPassword();
            $newUserType = $newUser->getUserType();
            $newSurname = $newUser->getSurname();
            $newName = $newUser->getName();
            $newMiddlename = $newUser->getMiddlename();
            $newCity = $newUser->getCity();
            $newInstitution_type = $newUser->getInstitutionType();
            $newInstitution_number = $newUser->getInstitutionNumber();
            $newGrade = $newUser->getGrade();
            $newGender = $newUser->getGender();
            $newBirthDate = date("y", strtotime($newUser->getBirthDate()))."-".date("m", strtotime($newUser->getBirthDate()))."-".date("d", strtotime($newUser->getBirthDate()));
            $newTelephone = $newUser->getTelephoneNumber();
            $photoNameNew = $newUser->getPhoto();

            mysqli_stmt_bind_param(
                    $stmt, "sssssssssissss", $email, $newPassword, $newUserType, $newSurname, $newName, $newMiddlename, $newCity, $newInstitution_type, $newInstitution_number, $newGrade, $newGender, $newBirthDate, $newTelephone, $photoNameNew
            );
            mysqli_stmt_execute($stmt);

            if ($session_email == $newUser->getEmail() && $session_usertype != $newUser->getUserType()) {
              $session_usertype = $newUser->getUserType();
            }

            header("Location: profile-find-user.inc.php?update=success&email=$email");
            exit();
          }
        }
      }
    }
  }
}
