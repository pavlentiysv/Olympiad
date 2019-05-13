<?php
require 'event.class.php';
$session_email = null;
$session_usertype = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  $session_usertype = $_SESSION['userType'];
}
 
$event = null;
$isCreate = 0;
$isRegistred = null;
$isOrganisator = null;

if (isset($_POST['eventID']) && !isset($_POST['update-event-submit'])) {
  $eventID = $_POST['eventID'];
  $event = getEventInfo($eventID);
  if ($session_email!=null) {
    checkRegistration($eventID);
  } else {
    $isRegistred = 2; //Guest
  }
} else if (isset($_GET['eventID'])) {
  $eventID = $_GET['eventID'];
  $event = getEventInfo($eventID);

} else if (isset($_POST['create-event-submit'])) {
  $isCreate = 1;

} else if (isset($_POST['update-event-submit'])) {
  $isCreate = 2;
  $eventID = $_POST['eventID'];
  $event = getEventInfo($eventID);
  $startYear = $startDate = date("Y", strtotime($event->getStartDate()));
  $startMonth = date("m", strtotime($event->getStartDate()));
  $startDay =  date("d", strtotime($event->getStartDate()));
  $startTime = date("G:i", strtotime($event->getStartDate()));
  $endYear = date("Y", strtotime($event->getEndDate()));
  $endMonth =  date("m", strtotime($event->getEndDate()));
  $endDay = date("d", strtotime($event->getEndDate()));
  $endTime = date("G:i", strtotime($event->getEndDate()));
  
} else if (isset($_GET['success'])) {
  $eventID = $_GET['eventID'];
  $event = getEventInfo($eventID);

  if ($_GET['success'] == 'registartion') {
    $isRegistred = 1;
  }

} else if (isset($_GET['error'])) {
  $isCreate = 1;
  $event = new Event(null, $_GET['title'], null, $_GET['country'], $_GET['city'], $_GET['street'], $_GET['houseNumber'], $_GET['cabinet'], $_GET['startDate'], $_GET['endDate'], $_GET['site'], null, null, null);
  $startYear = $_GET['startYear'];
  $startMonth = $_GET['startMonth'];
  $startDay =  $_GET['startDay'];
  $startTime = $_GET['startTime'];
  $endYear = $_GET['endYear'];
  $endMonth =  $_GET['endMonth'];
  $endDay = $_GET['endDay'];
  $endTime = $_GET['endTime'];
} else {
  header("Location: ./profile.php?error=noAction");
  exit();
}

function checkRegistration($eventID)
{
  global $isRegistred, $isOrganisator, $session_email;
  $accountID = null;
  $conn = getConnection();

  $sql = "SELECT * FROM accounts WHERE email = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../event.php?error=1sqlError");
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

  $sql = "SELECT * FROM events_users WHERE accountID = $accountID AND eventID = $eventID";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./profile.php?error=2sqlError");
    exit();
  } else {
    // mysqli_stmt_bind_param($stmt, "i", $accountID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows < 1) {
      $isRegistred = 0;
      $isOrganisator = 0;
      return;
    } else {
      if ($row = mysqli_fetch_assoc($result)) {
        $isRegistred = 1;
        $isOrganisator = $row['isOrganisator'];
        return;
      }
    }
  }
}


// Для отображения инфы на странице Event
function getEventInfo($eventID)
{
  $conn = getConnection();

  $sql = "SELECT * FROM events WHERE eventID = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./profile.php?error=4sqlError");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "i", $eventID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows < 1) {
      header("Location: ./profile.php?error=5sqlError");
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result)) {
        $event = new Event($row['eventID'], $row['title'], $row['logo'], $row['country'], $row['city'], $row['street'], $row['houseNumber'], $row['cabinet'], $row['startDate'], $row['endDate'], $row['site'], $row['shortInfo'], $row['fullInfo'], $row['isPublished']);
        return $event;
      } else {
        header("Location: ./profile.php?error=noEvent");
        exit();
      }
    }
  }
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
