<?php
// ver_factura.php<?php
include '../db.php';

$id = $_GET['id'];
$factura = $conn->query("SELECT f.id, f.fecha, c.nombre AS cliente_nombre, f.total AS total_factura FROM facturas f JOIN clientes c ON f.cliente_id = c.id WHERE f.id = $id")->fetch_assoc();
$detalles = $conn->query("SELECT df.cantidad, df.precio, df.total, p.nombre AS producto_nombre FROM detalle_factura df JOIN productos p ON df.producto_id = p.id WHERE df.factura_id = $id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Factura - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <div class="container">
        <h1>Factura #<?php echo $factura['id']; ?></h1>
        <p><strong>Cliente:</strong> <?php echo $factura['cliente_nombre']; ?></p>
        <p><strong>Fecha:</strong> <?php echo $factura['fecha']; ?></p>
        <p><strong>Total Factura:</strong> <?php echo number_format($factura['total_factura'], 2); ?></p>

        <h3>Detalles</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $detalles->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['producto_nombre']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td><?php echo number_format($row['precio'], 2); ?></td>
                    <td><?php echo number_format($row['total'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>
