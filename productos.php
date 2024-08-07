<?php
// productos.php
include 'db.php';
require_once "productos/CtrLogin.php"; 
$title = "Sistema De Gestion de Inventario y Facturacion";

$inslog = new ctrLogin();
$result = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container">
        <h1>Gestión de Productos</h1>
        <a href="productos/añadir_producto.php" class="btn btn-primary mb-3">Añadir Producto</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td>
                        <a href="productos/editar_producto.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                        <a href="productos/eliminar_producto.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>
</html>
