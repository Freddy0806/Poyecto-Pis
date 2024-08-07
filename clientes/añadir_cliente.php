<?php
// añadir_cliente.php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO clientes (nombre, cedula, email, telefono, direccion) VALUES ('$nombre', $cedula,'$email', '$telefono', '$direccion')";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../clientes.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Cliente - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <div class="container">
        <h1>Añadir Cliente</h1>
        <form action="añadir_cliente.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre">Cedula</label>
                <input type="text" id="cedula" name="cedula" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea id="direccion" name="direccion" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Añadir Cliente</button>
        </form>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>
