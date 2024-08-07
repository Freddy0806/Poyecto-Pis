<?php
include '../db.php';

$id = $_GET['id'];

// Eliminar los registros relacionados en detalle_factura
$sql_detalle = "DELETE FROM detalle_factura WHERE factura_id = $id";
if ($conn->query($sql_detalle) === TRUE) {
    // Luego eliminar la factura en sí
    $sql_factura = "DELETE FROM facturas WHERE id = $id";
    if ($conn->query($sql_factura) === TRUE) {
        header('Location: ../facturas.php');
        exit();
    } else {
        echo "Error al eliminar la factura: " . $conn->error;
    }
} else {
    echo "Error al eliminar los detalles de la factura: " . $conn->error;
}
?>
 