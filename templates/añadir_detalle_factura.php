<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Detalle Factura - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Añadir Detalle a Factura</h1>
        <form action="añadir_detalle_factura.php?factura_id=<?php echo $factura_id; ?>" method="post">
            <div class="form-group">
                <label for="producto_id">Producto</label>
                <select id="producto_id" name="producto_id" class="form-control" required>
                    <?php while($row = $productos->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir Detalle</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
