<!-- facturas.php -->
<?php
include 'db.php';
$title = "Sistema De Gestion de Inventario y Facturacion";
$result = $conn->query("SELECT f.id, c.nombre, f.fecha, f.total FROM facturas f JOIN clientes c ON f.cliente_id = c.id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Facturas - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container">
        <h1>Gestión de Facturas</h1>
        <a href="facturas/añadir_factura.php" class="btn btn-primary mb-3">Añadir Factura</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td>
                        <a href="facturas/ver_factura.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Ver</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $row['id']; ?>">Eliminar</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar Acción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea anular o eliminar esta factura?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="anularBtn" class="btn btn-warning">Anular</button>
                    <button id="eliminarBtn" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#confirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); 
            var id = button.data('id'); 

            $('#anularBtn').off('click').on('click', function () {
                window.location.href = 'facturas/anular_factura.php?id=' + id;
            });

            $('#eliminarBtn').off('click').on('click', function () {
                window.location.href = 'facturas/eliminar_factura.php?id=' + id;
            });
        });
    </script>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
