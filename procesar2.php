<?php
// Obtener los datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$IDEstatus = $_POST['IDEstatus'];
$aceptado = isset($_POST['aceptado']) && $_POST['aceptado'] == '1' ? 1 : 0;
$ubicacion = $_POST['ubicacion'];

// Verificar que el valor de 'IDEstatus' sea válido
if ($IDEstatus !== "1" && $IDEstatus !== "2") {
    echo "El valor de 'IDEstatus' no es válido.";
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "integrador5";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

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
$sql = "INSERT INTO eventos (Titulo, Descripcion, Fecha, Fotos, IDEstatus, Aceptado, Ubicacion)
        VALUES ('$titulo', '$descripcion', '$fecha', '$destino_foto', '$IDEstatus', '$aceptado', '$ubicacion')";
if ($conn->query($sql) === TRUE) {
    // Obtener el ID del evento recién insertado
    $idEvento = $conn->insert_id;

    // Redireccionar al usuario a menu.php con el ID del evento como parámetro
    header("Location: AgregarEventos.php?id=$idEvento");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
