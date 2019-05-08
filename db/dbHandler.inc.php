<?php
require '../php/config.inc.php';
$databaseHost = $serverHostIP; // адрес сервера
$databaseUser = 'root'; // имя пользователя
$databasePassword = 'root'; // пароль
$database = 'bsuir_olympiad'; // имя базы данных

$conn = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $database);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}