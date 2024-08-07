<?php
// index.php
session_start();
if(!isset($_SESSION["productos"])){
    header("location:./login.php");
}
    include 'db.php';
    $title = "Sistema De Gestion de Inventario y Facturacion";
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Distribuidora Flash</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container">
        <h1>Bienvenido a la Distribuidora Flash</h1>
        <p>Utilice el menú de navegación para gestionar productos, clientes y facturas.</p>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>
</html>

