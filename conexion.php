<?php
$host = "localhost";
$user = "root";
$password = "frankpaviac3323";
$database = "dulceria_fiestita";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>