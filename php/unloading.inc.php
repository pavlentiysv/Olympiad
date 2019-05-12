<?php
require 'session.inc.php';

$table = null;
$tables = null;
$type = null;

$session_email = null;
$session_usertype = null;
if (isset($_SESSION['userEmail'])) {
  $session_email = $_SESSION['userEmail'];
  $session_usertype = $_SESSION['userType'];
} else {
  header("Location: ../signin.php?error=noSession");
  exit();
}

if ($session_email == null) {
  header("Location: ../signin.php?error=noSession");
  exit();
}

if (isset($_POST['unload-submit'])) {
  $table = $_POST['table'];
  $type = $_POST['type'];
}

if (empty($table)) {
  header("Location: ../profile.php?error=noTableSelect");
  exit();
}

if (empty($type)) {
  header("Location: ../profile.php?error=noTypeSelect");
  exit();
}

if (file_exists('../db/dbHandler.inc.php')) {
  require '../db/dbHandler.inc.php';
} else if (file_exists('./db/dbHandler.inc.php')) {
  require './db/dbHandler.inc.php';
} else {
  header("Location: ./profile.php?error=pageNotFound");
}

if ($table != '*') {
  switch ($type) {
    case 'Excel':
      dataToExcel($table);
      break;
    case 'Xml':
      dataToXml($table);
      break;
    case 'JSON':
      dataToJSON($table);
      break;
    default:
      dataToExcel($table);
      break;
  }
} else {

  $tables = array();

  $sql = "SHOW TABLES";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./profile.php?error=sqlError");
    exit();
  } else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows < 1) {
      header("Location: ./profile.php?error=noTables");
      exit();
    } else {
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {

        $tmpTable = $row['Tables_in_bsuir_olympiad'];
        $sql = "SELECT * FROM $tmpTable";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../profile.php?error=sqlError&$table.");
          exit();
        } else {
          mysqli_stmt_execute($stmt);

          $tmpResult = mysqli_stmt_get_result($stmt);
          if ($tmpResult->num_rows > 0) {

            $tables[$i] = $row['Tables_in_bsuir_olympiad'];
            $i++;
          }
        }
      }
    }
  }

  // $sql = "SELECT * FROM $table";
  // $stmt = mysqli_stmt_init($conn);
  // if (!mysqli_stmt_prepare($stmt, $sql)) {
  //   header("Location: ../profile.php?error=sqlError&$table.");
  //   exit();
  // } else {
  //   mysqli_stmt_execute($stmt);

  //   $result = mysqli_stmt_get_result($stmt);

  switch ($type) {
    case 'Excel':
      dataToExcelArray($tables);
      break;
    case 'Xml':
      dataToXmlArray($tables);
      break;
    case 'JSON':
      dataToJSONArray($tables);
      break;
    default:
      dataToExcelArray($tables);
      break;
  }
}

// header("Location: ../profile.php?success=unload&table=$table&type=$type");
// exit();

function dataToExcel($table)
{
  global $conn;
  $sql = "SELECT * FROM $table";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../profile.php?error=sqlError&$table.");
    exit();
  } else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Download file 
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename = "Export.' . $table . '.' . date("Y-m-d") . '.xls"');
    header('Pragma: no-cache');
    $flag = false;
    while ($row = mysqli_fetch_assoc($result)) {
      if (!$flag) {
        echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", implode("\t", array_keys($row)) . "\r\n");
        $flag = true;
      }
      echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", implode("\t", array_values($row)) . "\r\n");
    }
  }
}

function dataToExcelArray($tables)
{
  global $conn;
  foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../profile.php?error=sqlError&$table.");
      exit();
    } else {
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      // Download file 
      header("Content-Type: application/octet-stream");
      header("Content-Transfer-Encoding: binary");
      header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
      header('Content-Disposition: attachment; filename = "Export.bsuir_olympiad.' . date("Y-m-d") . '.xls"');
      header('Pragma: no-cache');
      $flag = false;
      echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", "-\t Таблица \t" . $table . "\t-" . "\r\n");
      while ($row = mysqli_fetch_assoc($result)) {
        if (!$flag) {
          echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", implode("\t", array_keys($row)) . "\r\n");
          $flag = true;
        }
        echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", implode("\t", array_values($row)) . "\r\n");
      }
      echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", "\n\n\n");
    }
  }
}


function dataToXml($table)
{
  global $conn;
  $sql = "SELECT * FROM $table";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../profile.php?error=sqlError&$table.");
    exit();
  } else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $dom   = new DOMDocument('1.0', 'utf-8');
    $dom->formatOutput = True;

    $root  = $dom->createElement("$table");
    $dom->appendChild($root);
    while ($row = mysqli_fetch_assoc($result)) {
      $node = $dom->createElement(rtrim($table, 's'));
      foreach ($row as $key => $val) {
        $child = $dom->createElement($key);
        $child->appendChild($dom->createTextNode("$val"));
        $node->appendChild($child);
      }
      $root->appendChild($node);
    }

    header('Content-type: text/xml');
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename = "Export.' . $table . '.' . date("Y-m-d") . '.xml"');
    echo $dom->saveXML();
    exit;
  }
}

function dataToXmlArray($tables)
{
  global $conn;
  header('Content-type: text/xml');
  header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
  header('Content-Disposition: attachment; filename = "Export.bsuir_olympiad.' . date("Y-m-d") . '.xml"');
  $dom   = new DOMDocument('1.0', 'utf-8');
  $dom->formatOutput = True;
  $_root  = $dom->createElement("bsuir_olympiad");
  $dom->appendChild($_root);
  foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../profile.php?error=sqlError&$table.");
      exit();
    } else {
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      if ($result->num_rows > 0) {

        $root  = $dom->createElement("$table");
        $dom->appendChild($root);
        while ($row = mysqli_fetch_assoc($result)) {
          $node = $dom->createElement(rtrim($table, 's'));
          foreach ($row as $key => $val) {
            $child = $dom->createElement($key);
            $child->appendChild($dom->createTextNode("$val"));
            $node->appendChild($child);
          }
          $root->appendChild($node);
        }
      }
    }
    $_root->appendChild($root);
  }
  echo $dom->saveXML();
}

function dataToJSON($table)
{
  global $conn;
  $sql = "SELECT * FROM $table";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../profile.php?error=sqlError&$table.");
    exit();
  } else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Download file 
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename = "Export.' . $table . '.' . date("Y-m-d") . '.json"');
    header('Pragma: no-cache');
    $row = array();
    while ($r = mysqli_fetch_assoc($result)) {
      $row[$table][] = $r;
    }
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
  }
}

function dataToJSONArray($tables)
{
  global $conn;
  echo "{";
  echo "\"bsuir_olympiad\"";
  echo ": [";
  $num = count($tables);
  $i = 0;
  foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../profile.php?error=sqlError&$table.");
      exit();
    } else {
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      // Download file 
      header("Content-Type: application/octet-stream");
      header("Content-Transfer-Encoding: binary");
      header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
      header('Content-Disposition: attachment; filename = "Export.bsuir_olympiad.' . date("Y-m-d") . '.json"');
      header('Pragma: no-cache');
      $row = array();
      while ($r = mysqli_fetch_assoc($result)) {
        $row[$table][] = $r;
      }
    }
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
    if ($i != $num - 1) {
      echo ",";
    }
    $i++;
  }
  echo "]";
  echo "}";
}
