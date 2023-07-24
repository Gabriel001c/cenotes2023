<?php
// Verificar si se ha pasado el parámetro IDEventos en la URL
if (!isset($_GET['IDEventos'])) {
    echo "No se ha proporcionado el ID del evento.";
    exit();
}

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
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
        $IDEstatus = $_POST['IDEstatus'];
        $aceptado = isset($_POST['aceptado']) && $_POST['aceptado'] == '1' ? 1 : 0;
        $ubicacion = $_POST['ubicacion']; // Agregar el campo de ubicación

        // Actualizar el evento en la base de datos
        $eventoModel = new EventoModel();
        $eventoModel->actualizarEvento($idEvento, $titulo, $descripcion, $fecha, $IDEstatus, $aceptado, $ubicacion);
        
        echo "<script>alert('El evento se actualizó con éxito.'); window.close();</script>"; // Cerrar la ventana modal después de guardar los cambios
        exit();
    }
    
    // Mostrar formulario con los campos para editar el evento
    ?>
    <div class="ventana-flotante">
        <div class="contenido">
            <h2 class="titulo">Editar Evento</h2>
            <form action="" method="POST">
                <div class="campo">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $row['Titulo']; ?>">
                </div>
                
                <div class="campo">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="8"><?php echo $row['Descripcion']; ?></textarea>
                </div>
                
                <div class="campo">
                    <label for="fecha">Fecha:</label>
                    <input type="text" name="fecha" id="fecha" value="<?php echo $row['Fecha']; ?>">
                </div>
                
                <div class="campo">
                    <label for="IDEstatus">IDEstatus:</label>
                    <input type="text" name="IDEstatus" id="IDEstatus" value="<?php echo $row['IDEstatus']; ?>">
                </div>
                
                <div class="campo">
                    <label for="aceptado">Aceptado:</label>
                    <input type="checkbox" name="aceptado" id="aceptado" value="1" <?php echo $row['Aceptado'] == 1 ? "checked" : ""; ?>>
                </div>
                
                <div class="campo">
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" name="ubicacion" id="ubicacion" value="<?php echo $row['Ubicacion']; ?>">
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
