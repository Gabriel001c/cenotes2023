<?php
require_once 'model/UsuarioModel.php';

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreUsuarioCorreo = $_POST['nombre_usuario_correo'];
            $contrasena = $_POST['contrasena'];

            $usuario = $this->model->verificarCredenciales($nombreUsuarioCorreo, $contrasena);

            if ($usuario !== null) {
                // Las credenciales son válidas, se ha iniciado sesión correctamente
                // Guardar la información de sesión o establecer cookies, etc.
                // Redireccionar al usuario a la página principal (indexadm.php)
                header("Location: indexadm.php");
                exit();
            } else {
                // Las credenciales son inválidas, mostrar un mensaje de error
                echo "Nombre de Usuario/Correo o contraseña incorrectos";
            }
        }

        // Mostrar el formulario de inicio de sesión
        include 'login.php';
    }
}
