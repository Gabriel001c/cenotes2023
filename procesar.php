<?php
require_once 'conexion/Database.php';

// Obtener los datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$hora = $_POST['Hora'];
$ubicacion = $_POST['Ubicacion'];
$IDEstatus = $_POST['IDEstatus'];
$aceptado = isset($_POST['aceptado']) && $_POST['aceptado'] == '1' ? 1 : 0;
$usuarioId = $_POST['usuarioId'];
// Verificar que el valor de 'IDEstatus' sea válido
if ($IDEstatus !== "1" && $IDEstatus !== "2" && $IDEstatus !== "3" && $IDEstatus !== "4" && $IDEstatus !== "5") {    echo "El valor de 'IDEstatus' no es válido.";
    exit();
}

// Crear una instancia de la clase Database
$db = new Database();

// Obtener la conexión a la base de datos
$conn = $db->getConnection();

// Verificar si se ha subido una imagen
if ($_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
    // Directorio donde se almacenará la foto
    $ruta_foto = "fotos/";

    // Nombre del archivo de la foto
    $foto_nombre = $_FILES["foto"]["name"];

    // Ruta temporal del archivo de la foto
    $ruta_temporal = $_FILES["foto"]["tmp_name"];

    // Verificar si el directorio de destino existe, de lo contrario, crearlo
    if (!is_dir($ruta_foto)) {
        mkdir($ruta_foto, 0755, true);
    }

    // Mover la foto desde la ruta temporal a la carpeta de destino
    $destino_foto = $ruta_foto . $foto_nombre;
    if (!move_uploaded_file($ruta_temporal, $destino_foto)) {
        echo "Error al subir la foto.";
        exit();
    }
} else {
    echo "Error al subir la foto: " . $_FILES["foto"]["error"];
    exit();
}

// Insertar el evento en la tabla eventos
$query = "INSERT INTO eventos (Titulo, Descripcion, Fecha, Hora, Ubicacion, Fotos, IDEstatus, Aceptado, IDUsuario)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssii", $titulo, $descripcion, $fecha, $hora, $ubicacion, $destino_foto, $IDEstatus, $aceptado, $usuarioId);

if ($stmt->execute()) {
    // Redireccionar al usuario a AgregarEventos.php
    header("Location: AgregarEventos.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
    exit();
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>
