<?php
require_once 'model/UsuarioModel.php';
require_once 'conexion/Database.php';

class UsuarioController {
    private $model;
    private $db;

    public function __construct() {
        $this->model = new UsuarioModel();
        $this->db = new Database();
    }
    
    
    public function verificarCredenciales($nombreUsuarioCorreo, $contrasena) {
        $usuario = $this->model->verificarCredenciales($nombreUsuarioCorreo, $contrasena);
    
        if ($usuario !== null) {
            // Las credenciales son válidas
            // Iniciar sesión o establecer cookies, etc.
            session_start();
            $_SESSION['usuario'] = $usuario;
    
            if ($usuario['IDPER'] == 1) {
                // Redireccionar al indexadm.php
                header("Location: indexadm.php");
                exit();
            } else {
                // Redireccionar a AgregarEventos.php para usuarios normales
                header("Location: AgregarEventos.php");
                exit();
            }
        }
    
        // Las credenciales son inválidas, mostrar una notificación de error
        echo "<script>alert('Nombre de Usuario/Correo o contraseña incorrectos');</script>";
    }
    
    
    public function obtenerUsuarios() {
        $query = "SELECT ID, NombreUsuarios, Correo, Contraseña FROM usuarios";
        $result = $this->db->query($query);
        $usuarios = [];

        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    public function obtenerUsuario($idUsuario) {
        $usuario = $this->model->obtenerUsuario($idUsuario);

        if ($usuario !== null) {
            // Mostrar la información del usuario
            echo "Nombre de Usuario: " . $usuario['NombreUsuarios'];
            echo "Correo: " . $usuario['Correo'];
            echo "IDPER: " . $usuario['IDPER'];
        } else {
            // No se encontró el usuario
            echo "El usuario no existe";
        }
    }
}
?>
