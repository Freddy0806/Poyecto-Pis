<?php
// eliminar_producto.php
include '../db.php';

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header('Location: ../productos.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
