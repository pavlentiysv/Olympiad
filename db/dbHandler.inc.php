<?php
$host = '192.168.1.99'; // адрес сервера
$database = 'bsuir_olympiad'; // имя базы данных
$user = 'root'; // имя пользователя
$password = 'root'; // пароль

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}