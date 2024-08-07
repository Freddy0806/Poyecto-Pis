<?php
include '../db.php';

$productos = $conn->query("SELECT * FROM productos");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $num_productos = $_POST['num_productos'] + 1;
    } elseif (isset($_POST['cedula'])) {
        // Proceso de búsqueda de cliente
        $cedula = $_POST['cedula'];
        $cliente_query = $conn->query("SELECT * FROM clientes WHERE cedula = '$cedula'");
        $selected_cliente = $cliente_query->fetch_assoc();
        $num_productos = $_POST['num_productos']; // Mantiene el número de productos
    } else {
        // Proceso de añadir factura
        $cliente_id = $_POST['cliente_id']; 
        $fecha = $_POST['fecha'];
        $total_factura = 0;

        $productos = $_POST['productos'];
        $cantidades = $_POST['cantidades'];
        $errores = [];

        // Verificar stock disponible
        foreach ($productos as $index => $producto_id) {
            $cantidad = $cantidades[$index];
            $result = $conn->query("SELECT stock FROM productos WHERE id = $producto_id");
            $result1 = $conn->query("SELECT nombre FROM productos WHERE id = $producto_id");
            $producto = $result->fetch_assoc();
            $producto1 = $result1->fetch_assoc();
            if ($producto['stock'] < $cantidad) {
                $errores[] = "No hay suficiente stock para el producto {$producto1['nombre']} con ID $producto_id. Solo quedan {$producto['stock']} unidades.";
            }
        }

        if (empty($errores)) {
            $sql = "INSERT INTO facturas (cliente_id, fecha) VALUES ('$cliente_id', '$fecha')";
            if ($conn->query($sql) === TRUE) {
                $factura_id = $conn->insert_id;

                foreach ($productos as $index => $producto_id) {
                    $cantidad = $cantidades[$index];
                    $result = $conn->query("SELECT precio, stock FROM productos WHERE id = $producto_id");
                    $producto = $result->fetch_assoc();
                    $precio = $producto['precio'];
                    $total_producto = $cantidad * $precio;
                    $total_factura += $total_producto;

                    $sql = "INSERT INTO detalle_factura (factura_id, producto_id, cantidad, precio, total) VALUES ('$factura_id', '$producto_id', '$cantidad', '$precio', '$total_producto')";
                    $conn->query($sql);

                    // Actualizar stock
                    $nuevo_stock = $producto['stock'] - $cantidad;
                    $conn->query("UPDATE productos SET stock = $nuevo_stock WHERE id = $producto_id");
                }

                $conn->query("UPDATE facturas SET total = '$total_factura' WHERE id = '$factura_id'");

                header('Location: ../facturas.php');
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            foreach ($errores as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
            $num_productos = count($productos); // Mantiene el número de productos en caso de error
        }
    }
} else {
    $num_productos = 1;
}

$fecha_actual = date('Y-m-d');
$clientes = $conn->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Factura - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <div class="container">
        <h1>Añadir Factura</h1>
        <form action="añadir_factura.php" method="post">
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input list="cedulas" id="cedula" name="cedula" class="form-control" placeholder="Buscar Cédula" value="<?php echo isset($selected_cliente['cedula']) ? $selected_cliente['cedula'] : ''; ?>" onchange="this.form.submit()">
                <datalist id="cedulas">
                    <?php while($row = $clientes->fetch_assoc()): ?>
                    <option value="<?php echo $row['cedula']; ?>"><?php echo $row['cedula']; ?></option>
                    <?php endwhile; ?>
                </datalist>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo isset($selected_cliente['nombre']) ? $selected_cliente['nombre'] : ''; ?>" readonly>
            </div>
            <input type="hidden" id="cliente_id" name="cliente_id" value="<?php echo isset($selected_cliente['id']) ? $selected_cliente['id'] : ''; ?>">
            <input type="hidden" name="num_productos" value="<?php echo $num_productos; ?>">

        </form>

        <form action="añadir_factura.php" method="post">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $fecha_actual; ?>" required>
            </div>

            <h3>Productos</h3>
            <div id="productos-container">
                <?php for ($i = 0; $i < $num_productos; $i++): ?>
                <div class="form-group">
                    <label for="producto_<?php echo $i + 1; ?>">Producto</label>
                    <select id="producto_<?php echo $i + 1; ?>" name="productos[]" class="form-control">
                        <option value="">Seleccionar Producto</option>
                        <?php
                        $productos = $conn->query("SELECT * FROM productos");
                        while($row = $productos->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="cantidad_<?php echo $i + 1; ?>">Cantidad</label>
                    <input type="number" id="cantidad_<?php echo $i + 1; ?>" name="cantidades[]" class="form-control">
                </div>
                <?php endfor; ?>
            </div>
            <input type="hidden" name="num_productos" value="<?php echo $num_productos; ?>">
            <input type="hidden" name="cliente_id" value="<?php echo isset($selected_cliente['id']) ? $selected_cliente['id'] : ''; ?>">
            <button type="submit" name="add_product" class="btn btn-secondary">Añadir Producto</button>
            <button type="submit" class="btn btn-primary">Añadir Factura</button>
        </form>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>
