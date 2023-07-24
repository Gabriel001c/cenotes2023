<?php
require_once 'controllers/UsuarioController.php';
require_once 'model/UsuarioModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuarioCorreo = $_POST['nombre_usuario_correo'];
    $contrasena = $_POST['contrasena'];

    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->verificarCredenciales($nombreUsuarioCorreo, $contrasena);

    if ($usuario) {
        session_start();
        $_SESSION['usuario'] = $usuario;

        echo "<script>
                window.onload = function() {
                    showMessage('Inicio de sesión exitoso.');
                };
                setTimeout(function() {
                    window.location.href = 'indexadm.php';
                }, 1000);
            </script>";
        exit();
    } else {
        echo "<p class='text-center text-danger'>Credenciales inválidas. Inténtalo nuevamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio de sesión</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/adm2.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('img/chichen.jpg');"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="text-primary m-0">Bienvenido</h1>
                                    </div>
                                    <form class="user" method="POST" action="login.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nombre_usuario_correo" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingrese su Nombre de Usuario o Correo">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="contrasena" id="exampleInputPassword" placeholder="Contraseña">
                                        </div>
                                       
                                        <button type="submit" class="btn btn-user btn-block" name="submit" style="background-color: #0F172B; color: white;">Iniciar sesión</button>
                                        <hr>
                                    
                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <button class="btn btn-primary btn-user btn-block" style="background-color: #0F172B; color: white;" onclick="openCrearCuenta()">Crear una cuenta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        function openCrearCuenta() {
            window.open("crear_cuenta.php", "Crear cuenta", "width=600,height=400");
        }

        function showMessage(message) {
            alert(message);
        }
    </script>

</body>

</html>
