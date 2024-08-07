<?php
// anular_factura.php
include '../db.php';

$id = $_GET['id'];

// Obtener los detalles de la factura
$sql_detalles = "SELECT producto_id, cantidad FROM detalle_factura WHERE factura_id = $id";
$result_detalles = $conn->query($sql_detalles);

// Actualizar el stock de los productos
while ($row = $result_detalles->fetch_assoc()) {
    $producto_id = $row['producto_id'];
    $cantidad = $row['cantidad'];
    $sql_update_stock = "UPDATE productos SET stock = stock + $cantidad WHERE id = $producto_id";
    $conn->query($sql_update_stock);
}

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