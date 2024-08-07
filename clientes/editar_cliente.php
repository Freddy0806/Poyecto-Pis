<?php
// editar_cliente.php
include '../db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM clientes WHERE id = $id");
$cliente = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE clientes SET nombre='$nombre', cedula='$cedula', email='$email', telefono='$telefono', direccion='$direccion' WHERE id=$id";
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
    <title>Editar Cliente - Distribuidora Flash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <div class="container">
        <h1>Editar Cliente</h1>
        <form action="editar_cliente.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $cliente['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nombre">Cedula</label>
                <input type="text" id="cedula" name="cedula" class="form-control" value="<?php echo $cliente['cedula']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $cliente['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $cliente['telefono']; ?>">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea id="direccion" name="direccion" class="form-control"><?php echo $cliente['direccion']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        </form>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>
