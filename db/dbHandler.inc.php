<?php
if (file_exists('../php/config.inc.php')) {
    require '../php/config.inc.php';
} else if (file_exists('./php/config.inc.php')) {
    require './php/config.inc.php';
} else {
    echo "Error 404. Page not found.";
}
$databaseHost = $serverHostIP; // адрес сервера
$databaseUser = 'root'; // имя пользователя
$databasePassword = 'root'; // пароль
$database = 'bsuir_olympiad'; // имя базы данных

$conn = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $database);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}