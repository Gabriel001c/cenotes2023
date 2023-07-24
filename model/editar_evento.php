<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .ventana-flotante {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .ventana-flotante .contenido {
        background-color: #0F172B;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow: auto;
        color: white;
        text-align: center;
    }

    .ventana-flotante .titulo {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .ventana-flotante .descripcion {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .ventana-flotante .campo {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 10px;
        text-align: left;
    }

    .ventana-flotante .campo label {
        flex: 0 0 30%;
        font-weight: bold;
    }

    .ventana-flotante .campo input,
    .ventana-flotante .campo textarea {
        flex: 1;
        padding: 5px;
        border-radius: 5px;
        border: none;
        resize: vertical;
    }

    .ventana-flotante .cerrar-ventana {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: white;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }
    </style>
</head>
<body>
<?php
// Verificar si se ha pasado el parámetro IDEventos en la URL
if (!isset($_GET['IDEventos'])) {
    echo "No se ha proporcionado el ID del evento.";
    exit();
}

require_once '../conexion/Database.php';

// Obtener el ID del evento a editar
$idEvento = $_GET['IDEventos'];

// Conectar a la base de datos
$database = new Database();
$conn = $database->getConnection();

// Obtener los datos del evento
$sql = "SELECT * FROM eventos WHERE IDEventos = $idEvento";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $aceptado = isset($_POST['aceptado']) && $_POST['aceptado'] == '1' ? 1 : 0;
        $comentario = $_POST['Comentario']; // Agregar el campo de ubicación


        // Actualizar el evento en la base de datos
        $sql = "UPDATE eventos SET Aceptado = $aceptado, Comentario = '$comentario' WHERE IDEventos = $idEvento";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('El evento se actualizó con éxito.'); window.close();</script>"; // Cerrar la ventana modal después de guardar los cambios
            exit();
        } else {
            echo "Error al actualizar el evento: " . $conn->error;
        }
    }
    
    // Mostrar formulario con los campos para editar el evento
    ?>
    <div class="ventana-flotante">
        <div class="contenido">
            <h2 class="titulo">Editar Evento</h2>
            <form action="" method="POST">
                
                <div class="campo">
                    <label for="Comentario">Comentario:</label>
                    <input type="text" name="Comentario" id="Comentario" value="<?php echo $row['Comentario']; ?>">
                </div>
                
                <div class="campo">
                    <label for="aceptado">Aceptado:</label>
                    <input type="checkbox" name="aceptado" id="aceptado" value="1" <?php echo $row['Aceptado'] == 1 ? "checked" : ""; ?>>
                </div>
                
                <input type="submit" value="Guardar">
            </form>
            <button class="cerrar-ventana" onclick="window.close()">Cerrar</button>
        </div>
    </div>
    <?php
} else {
    echo "No se encontró el evento.";
}

// Cerrar la conexión
$conn->close();
?>
</body>
</html>
