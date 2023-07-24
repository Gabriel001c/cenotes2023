<?php

require_once 'model/EventoModel.php';

class EventoController {
    private $model;

    public function __construct() {
        $this->model = new EventoModel();
    }
    

    public function agregarEvento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['Hora'];
            $IDEstatus = $_POST['IDEstatus'];
            $aceptado = isset($_POST['aceptado']) && $_POST['aceptado'] == '1' ? 1 : 0;
            $ubicacion = $_POST['Ubicacion'];
            $comentario = $_POST['Comentario'];

            if ($IDEstatus !== "1" && $IDEstatus !== "2" && $IDEstatus !== "3" && $IDEstatus !== "4" && $IDEstatus !== "5") {
                echo "El valor de 'IDEstatus' no es válido.";
                exit();
            }

            if ($_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
                $ruta_foto = "fotos/";
                $foto_nombre = $_FILES["foto"]["name"];
                $ruta_temporal = $_FILES["foto"]["tmp_name"];

                if (!is_dir($ruta_foto)) {
                    mkdir($ruta_foto, 0755, true);
                }

                $destino_foto = $ruta_foto . $foto_nombre;
                if (!move_uploaded_file($ruta_temporal, $destino_foto)) {
                    echo "Error al subir la foto.";
                    exit();
                }
            } else {
                echo "Error al subir la foto: " . $_FILES["foto"]["error"];
                exit();
            }

            $idEvento = $this->model->agregarEvento($titulo, $descripcion, $fecha, $hora, $destino_foto, $IDEstatus, $aceptado, $ubicacion, $comentario);

            if ($idEvento !== false) {
                $this->mostrarEventos();
                exit();
            } else {
                echo "Error al agregar el evento.";
                exit();
            }
        } else {
            include 'agregare.php';
        }
    }

    public function mostrarFormulario() {
        include 'agregare.php';
    }

    public function mostrarEventos() {
        // Obtener los eventos filtrados por Aceptado=0
        $eventos = $this->model->filtrarEventosPorAceptado(0);
        include 'views/eventos.php';
    }
    

    public function obtenerEventosPorAceptado($aceptado) {
        $eventos = $this->model->obtenerEventosPorAceptado($aceptado);
        return $eventos;
    }

    public function mostrarEventosConAceptado($aceptado) {
        $eventos = $this->model->obtenerEventosPorAceptado($aceptado);
        return $eventos;
    }
    public function filtrarEventosPorAceptado($aceptado) {
        $eventos = $this->model->filtrarEventosPorAceptado($aceptado);
        return $eventos;
    }
    public function obtenerEventoPorId($idEvento) {
        return $this->model->obtenerEventoPorId($idEvento);
    }
}
?>
