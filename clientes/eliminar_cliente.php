<?php
// eliminar_cliente.php
include '../db.php';

$id = $_GET['id'];

$sql = "DELETE FROM clientes WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header('Location: ../clientes.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
