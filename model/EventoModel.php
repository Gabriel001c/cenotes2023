<?php
require_once 'conexion/Database.php';

class EventoModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function agregarEvento($titulo, $descripcion, $fecha, $hora, $rutaFoto, $IDEstatus, $aceptado, $ubicacion, $comentario) {
        $titulo = $this->db->escape($titulo);
        $descripcion = $this->db->escape($descripcion);
        $fecha = $this->db->escape($fecha);
        $hora = $this->db->escape($hora);
        $rutaFoto = $this->db->escape($rutaFoto);
        $IDEstatus = $this->db->escape($IDEstatus);
        $aceptado = $this->db->escape($aceptado);
        $ubicacion = $this->db->escape($ubicacion);
        $comentario = $this->db->escape($comentario);

        $sql = "INSERT INTO eventos (Titulo, Descripcion, Fecha, Hora, Fotos, IDEstatus, Aceptado, Ubicacion, Comentario)
                VALUES ('$titulo', '$descripcion', '$fecha', '$hora', '$rutaFoto', '$IDEstatus', '$aceptado', '$ubicacion', '$comentario')";

        if ($this->db->query($sql)) {
            $idEvento = $this->db->getLastInsertID();
            return $idEvento;
        } else {
            return false;
        }
    }

    public function obtenerEventoPorId($idEvento) {
        $query = "SELECT * FROM eventos WHERE IDEventos = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $idEvento);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerEventos() {
        $sql = "SELECT * FROM eventos";
        $result = $this->db->query($sql);

        $eventos = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eventos[] = $row;
            }
        }

        return $eventos;
    }

    public function obtenerEventosPorAceptado($aceptado) {
        $aceptado = $this->db->escape($aceptado);
        $sql = "SELECT * FROM eventos WHERE Aceptado = '$aceptado'";
        $result = $this->db->query($sql);

        $eventos = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $eventos[] = $row;
            }
        }

        return $eventos;
    }

    public function filtrarEventosPorAceptado($aceptado) {
        $aceptado = $this->db->escape($aceptado);
        $sql = "SELECT * FROM eventos WHERE Aceptado = '$aceptado'";
        $result = $this->db->query($sql);

        $eventos = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $eventos[] = $row;
            }
        }

        return $eventos;
    }
}
?>
