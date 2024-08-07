<?php
session_start();
if(isset($_SESSION["productos"])){
header("location:./productos.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Iniciar sesión</title>
</head>
<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-5">
                    <div class="text-center my-5">
                        <i class="fas fa-user-circle fa-7x color-primary"></i>
                        <!-- <i class="fa-sharp fa-solid fa-circle-user fa-10x color-secondary"></i> -->
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">
                                Hola, iniciar sesión
                            </h1>
                            <form action="./ajax/ajaxLogin.php" class="needs-validation" method="POST">
                                <div class="mb-3">
                                    <label for="email">Ingrese su correo</label>
                                    <input type="email" name="email" id="email" class="form-control" required value="">
                                    <div class="invalid-feedback">
                                        El correo no es válido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Ingrese su contraseña</label>
                                    <input type="password" name="password" id="password" class="form-control" required value="">
                                    <div class="invalid-feedback">
                                        Contraseña es requerida
                                    </div>
                                </div>

                                <div class="d-flex align-items-start">
                                    <button type="submit" class="btn btn-primary">
                                        Iniciar sesión
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        2024 Sistema de usuarios
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>