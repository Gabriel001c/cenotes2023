<?php
require_once 'conexion/Database.php';

class UsuarioModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function crearUsuario($nombreUsuario, $correo, $contrasena, $idPer)
    {
        $nombreUsuario = $this->db->escape($nombreUsuario);
        $correo = $this->db->escape($correo);
        $contrasena = $this->db->escape($contrasena);
        $idPer = $this->db->escape($idPer);

        $sql = "INSERT INTO usuarios (NombreUsuarios, Correo, Contraseña, IDPER) VALUES ('$nombreUsuario', '$correo', '$contrasena', '$idPer')";

        return $this->db->query($sql);
    }

    public function verificarCredenciales($nombreUsuarioCorreo, $contrasena) {
        $nombreUsuarioCorreo = $this->db->escape($nombreUsuarioCorreo);
        $contrasena = $this->db->escape($contrasena);

        $sql = "SELECT * FROM usuarios WHERE (NombreUsuarios = '$nombreUsuarioCorreo' OR Correo = '$nombreUsuarioCorreo') AND Contraseña = '$contrasena'";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $usuarios = array();
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            return $usuarios;
        }

        return array();
    }

    public function obtenerUsuario($idUsuario) {
        $idUsuario = $this->db->escape($idUsuario);

        $sql = "SELECT * FROM usuarios WHERE ID = '$idUsuario'";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function eliminarUsuario($idUsuario) {
        $idUsuario = $this->db->escape($idUsuario);

        $sql = "DELETE FROM usuarios WHERE ID = '$idUsuario'";
        return $this->db->query($sql);
    }
}
?>
