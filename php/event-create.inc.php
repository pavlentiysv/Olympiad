<?php
require 'event.class.php';
require 'session.inc.php';

$conn = getConnection();

$session_email = null;
$session_usertype = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  $session_usertype = $_SESSION['userType'];
} else {
  header("Location: ../signin.php?error=noSession");
}

$event = null;
$logo = null;
$startDate = null;
$endDate = null;
$autoFill = null;

$startYear = null;
$startMonth = null;
$startDay = null;
$startTime = null;
$endYear = null;
$endMonth = null;
$endDay = null;
$endTime = null;

if (isset($_POST['create-event-submit'])) {

  if (!empty($_POST['cabinet'])) {
    $cabinet = $_POST['cabinet'];
  } else {
    $cabinet = null;
  }
  if (!empty($_POST['site'])) {
    $site = $_POST['site'];
  } else {
    $site = null;
  }
  if (!empty($_POST['fullInfo'])) {
    $fullInfo = $_POST['fullInfo'];
  } else {
    $fullInfo = null;
  }

  $startYear = $_POST['startYear'];
  $startMonth = $_POST['startMonth'];
  $startDay =  $_POST['startDay'];
  $startTime = $_POST['startTime'];
  $endYear = $_POST['endYear'];
  $endMonth =  $_POST['endMonth'];
  $endDay = $_POST['endDay'];
  $endTime = $_POST['endTime'];

  $startDate = "$startYear-$startMonth-$startDay $startTime:00";
  $endDate = "$endYear-$endMonth-$endDay $endTime:00";

  $newEvent = new Event(null, $_POST['title'], $logo, $_POST['country'], $_POST['city'], $_POST['street'], $_POST['houseNumber'], $cabinet, $startDate, $endDate, $site, $_POST['shortInfo'], $fullInfo, 0);
  // public function __construct($eventID, $title, $logo, $country, $city, $street, $houseNumber, $cabinet, $startDate, $endDate, $site, $shortInfo, $fullInfo, $isPublished)

  $autoFill = $newEvent->getAutoFill() . "&startDay=$startDay&startMonth=$startMonth&startYear=$startYear&startTime=$startTime&endDay=$endDay&endMonth=$endMonth&endYear=$endYear&endTime=$endTime";

  $logo = null;

  $title = $newEvent->getTitle();
  $country = $newEvent->getCountry();
  $city = $newEvent->getCity();
  $street = $newEvent->getStreet();
  $houseNumber = $newEvent->getHouseNumber();
  $cabinet = $newEvent->getCabinet();
  $site = $newEvent->getSite();
  $shortInfo = $newEvent->getShortInfo();
  $fullInfo = $newEvent->getFullInfo();

  $sql = "INSERT INTO events (title, logo, country, city, street, houseNumber, cabinet, startDate, endDate, site, shortInfo, fullInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../event.php?error=sqlError2$autoFill");
    exit();
  } else {
    mysqli_stmt_bind_param(
      $stmt,
      "ssssssssssss",
      $title,
      $logo,
      $country,
      $city,
      $street,
      $houseNumber,
      $cabinet,
      $startDate,
      $endDate,
      $site,
      $shortInfo,
      $fullInfo
    );
    mysqli_stmt_execute($stmt);

    $eventID = null;
    $accountID = null;

    $sql = "SELECT MAX(eventID) FROM events";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../event.php?error=sqlError3$autoFill");
      exit();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $eventID = $row['MAX(eventID)'];
      } else {
        header("Location: ../event.php?error=sqlError4$autoFill");
        exit();
      }
    }
    $logoFile = null;
    $newEvent->setEventID($eventID);
    $logo = $_FILES['logo'];

    if ($logo['name'] == null) {
      $logo = null;
    } else {
      $logoFile = uploadPhoto($logo, $eventID);
      $newEvent->setLogo($logoFile);
      $sql = "UPDATE events SET logo = ? WHERE eventID = ?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../event.php?error=sqlError3$autoFill");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "ss", $logoFile, $eventID);
        mysqli_stmt_execute($stmt);
      }
    }

    $sql = "SELECT * FROM accounts WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../event.php?error=sqlError5$autoFill");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $session_email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $accountID = $row['accountID'];
      } else {
        header("Location: ../signin.php?error=noGmail&email=" . $session_email);
        exit();
      }
    }

    $sql = "INSERT INTO events_users (eventID, accountID, isOrganisator) VALUES ($eventID, $accountID,1)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../event.php?error=sqlError6$autoFill");
      exit();
    } else {
      mysqli_stmt_execute($stmt);
    }


    header("Location: ../event.php?success=create&eventID=$eventID");
    exit();
  }
} else if (isset($_POST['update-event-submit'])) {


  if (!empty($_POST['cabinet'])) {
    $cabinet = $_POST['cabinet'];
  } else {
    $cabinet = null;
  }
  if (!empty($_POST['site'])) {
    $site = $_POST['site'];
  } else {
    $site = null;
  }
  if (!empty($_POST['fullInfo'])) {
    $fullInfo = $_POST['fullInfo'];
  } else {
    $fullInfo = null;
  }
  $evenID = $_POST['eventID'];
  $startYear = $_POST['startYear'];
  $startMonth = $_POST['startMonth'];
  $startDay =  $_POST['startDay'];
  $startTime = $_POST['startTime'];
  $endYear = $_POST['endYear'];
  $endMonth =  $_POST['endMonth'];
  $endDay = $_POST['endDay'];
  $endTime = $_POST['endTime'];

  $startDate = "$startYear-$startMonth-$startDay $startTime:00";
  $endDate = "$endYear-$endMonth-$endDay $endTime:00";

  $logoFile = null;
  $logo = $_FILES['logo'];

  if ($logo['name'] == null) {
    $logoFile = "logo" . $evenID;
    if (file_exists('../uploads/events/logos/' . $logoFile . ".jpg")) {
      $logoFile = "logo" . $evenID . ".jpg";
    } else if (file_exists('../uploads/events/logos/' . $logoFile . ".png")) {
      $logoFile = "logo" . $evenID . ".png";
    } else if (file_exists('../uploads/events/logos/' . $logoFile . ".jpeg")) {
      $logoFile = "logo" . $evenID . ".jpeg";
    } else {
      $logoFile = null;
    }
  } else {
    $logoFile = uploadPhoto($logo, $evenID);
  }

  $newEvent = new Event($_POST['eventID'], $_POST['title'], null, $_POST['country'], $_POST['city'], $_POST['street'], $_POST['houseNumber'], $cabinet, $startDate, $endDate, $site, $_POST['shortInfo'], $fullInfo, $_POST['isPubslished']);
  // public function __construct($eventID, $title, $logo, $country, $city, $street, $houseNumber, $cabinet, $startDate, $endDate, $site, $shortInfo, $fullInfo, $isPublished)

  $autoFill = $newEvent->getAutoFill() . "&startDay=$startDay&startMonth=$startMonth&startYear=$startYear&startTime=$startTime&endDay=$endDay&endMonth=$endMonth&endYear=$endYear&endTime=$endTime";

  $title = $newEvent->getTitle();
  $logo = $logoFile;
  $country = $newEvent->getCountry();
  $city = $newEvent->getCity();
  $street = $newEvent->getStreet();
  $houseNumber = $newEvent->getHouseNumber();
  $cabinet = $newEvent->getCabinet();
  $site = $newEvent->getSite();
  $shortInfo = $newEvent->getShortInfo();
  $fullInfo = $newEvent->getFullInfo();

  $sql = "UPDATE events SET title = ?, logo = ?, country = ?, city = ?, street = ?, houseNumber = ?, cabinet = ?, site = ?, shortInfo = ?, fullInfo = ? WHERE eventID = $evenID";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../event.php?error=sqlError$autoFill");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "ssssssssss", $title, $logo, $country, $city, $street, $houseNumber, $cabinet, $site, $shortInfo, $fullInfo);
    mysqli_stmt_execute($stmt) or die();

    header("Location: ../event.php?success=update&eventID=$evenID");
    exit();
  }
} else {
  header("Location: ../event.php?error=noSubmit");
  exit();
}

function uploadPhoto($photo, $eventID)
{
  global $autoFill;
  $photoNameNew = null;
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
          $photoNameNew = 'logo' . $eventID . "." . $photoActualExt;
          $photoDestination = '../uploads/events/logos/' . $photoNameNew;
          if (file_exists("../uploads/events/logos/$photoName")) {
            unlink("../uploads/events/logos/$photoName");
          }
          move_uploaded_file($photoTmpName, $photoDestination);
        } else {
          header("Location: ../event.php?error=photoSize${autoFill}");
          exit();
        }
      } else {
        header("Location: ../event.php?error=photoUpload${autoFill}");
        exit();
      }
    } else {
      header("Location: ../event.php?error=photoExt${autoFill}");
      exit();
    }
  }
  return $photoNameNew;
}

function getConnection()
{
  if (file_exists('../db/dbHandler.inc.php')) {
    require '../db/dbHandler.inc.php';
  } else if (file_exists('./db/dbHandler.inc.php')) {
    require './db/dbHandler.inc.php';
  } else {
    header("Location: ./profile.php?error=pageNotFound");
  }
  return $conn;
}
