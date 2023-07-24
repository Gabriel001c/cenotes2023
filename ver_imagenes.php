<!-- En esta página, muestra todas las imágenes relacionadas con un evento específico -->
<!DOCTYPE html>
<html>
<head>
    <title>Imágenes del Evento</title>
    <style>
        img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <?php
    // Verificar si se ha pasado el parámetro ID del evento en la URL
    if (!isset($_GET['id'])) {
        echo "No se ha proporcionado el ID del evento.";
        exit();
    }

    // Obtener el ID del evento
    $idEvento = $_GET['id'];

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

    // Obtener las imágenes del evento
    $sql = "SELECT Fotos FROM eventos WHERE IDEventos = $idEvento";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar todas las imágenes
        while ($row = $result->fetch_assoc()) {
            $imagenUrl = $row['Fotos'];
            echo "<a href='$imagenUrl' target='_blank'><img src='$imagenUrl' alt='Imagen del Evento'></a>";
            echo "<br><br>";
        }
    } else {
        echo "No se encontraron imágenes para este evento.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</body>
</html>
