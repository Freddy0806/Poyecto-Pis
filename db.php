<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flash_distribuidora";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>