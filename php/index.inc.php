<?php
require 'event.class.php';
$conn = getConnection();
$event = null;

$sql = "SELECT * FROM (SELECT *, TIMESTAMPDIFF(SECOND, NOW(),startDate) as dif FROM events) as temp WHERE dif>0 ORDER BY dif LIMIT 1";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ./index.php?error=sqlError");
  exit();
} else {
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if ($result->num_rows != 1) {
    header("Location: ./index.php?error=noEvent");
    exit();
  } else {
    $row = mysqli_fetch_assoc($result);
    $event = new Event($row['eventID'], $row['title'], $row['logo'], $row['country'], $row['city'], $row['street'], $row['houseNumber'], $row['cabinet'], $row['startDate'], $row['endDate'], $row['site'], $row['shortInfo'], $row['fullInfo'], $row['isPublished']);
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