<?php
class dbManager
{

    private $conn;

    public function __construct()
    {
        global $conn;
        require('connection_config.php');
        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // echo "Success connection";
        }
    }

    public function __destruct()
    {
        global $conn;
        $conn->close();
    }

    public function getConnection()
    {
        global $conn;
        return $conn;
    }
}
