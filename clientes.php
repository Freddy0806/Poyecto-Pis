<?php
// clientes.php
include 'db.php';
$title = "Sistema De Gestion de Inventario y Facturacion";

$result = $conn->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <div class="container">
        <h1>Gestión de Clientes</h1>
        <a href="clientes/añadir_cliente.php" class="btn btn-secondary mb-3">Añadir Cliente</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['cedula']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['telefono']; ?></td>
                    <td><?php echo $row['direccion']; ?></td>
                    <td>
                        <a href="clientes/editar_cliente.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Editar</a>
                        <a href="clientes/eliminar_cliente.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>
</html>
