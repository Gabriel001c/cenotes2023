<?php

require_once 'conexion/Database.php';

class EliminarEventoModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function eliminarEvento($idEvento) {
        // Verificar si se ha enviado el formulario de confirmación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Eliminar las filas relacionadas en la tabla categoria_evento
            $sqlCategoria = "DELETE FROM categoria_evento WHERE IDEvento = $idEvento";
            if ($this->conn->query($sqlCategoria) === TRUE) {
                // Eliminar el evento de la base de datos
                $sqlEventos = "DELETE FROM eventos WHERE IDEventos = $idEvento";
                if ($this->conn->query($sqlEventos) === TRUE) {
                    return true;
                } else {
                    return "Error al eliminar el evento: " . $this->conn->error;
                }
            } else {
                return "Error al eliminar las filas relacionadas: " . $this->conn->error;
            }
        }

        return false;
    }

    public function getEventoTitulo($idEvento) {
        // Obtener los datos del evento para mostrar en el mensaje de confirmación
        $sql = "SELECT * FROM eventos WHERE IDEventos = $idEvento";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['Titulo'];
        }

        return false;
    }
}
