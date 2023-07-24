<?php
require_once 'controllers/EventoController.php';

// Crear una instancia del controlador de eventos
$eventoController = new EventoController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Llamar a la función agregarEvento() para agregar un nuevo evento
    $eventoController->agregarEvento();
} else {
    // Mostrar todos los eventos
    $eventos = $eventoController->mostrarEventos();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Agregar Evento</title>
</head>
<body>
    <h1>Agregar Evento</h1>
    <form action="EventoController.php" method="POST" enctype="multipart/form-data">
        <ul>
            <label for="titulo">Nombre del evento:</label><br>
            <input type="text" id="titulo" name="titulo"><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" id="descripcion" name="descripcion"><br>

            <legend>Indica Fecha del evento:</legend>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"><br>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto"><br><br>

            <label for="IDEstatus">Selecciona una categoría:</label><br>
            <select id="IDEstatus" name="IDEstatus">
                <option value="">Categoría</option>
                <option value="1">Baile</option>
                <option value="2">Música</option>
            </select><br><br>

            <label for="aceptado">Aceptar</label><br>
            <select id="aceptado" name="aceptado">
                <option value="">Categoría</option>
                <option value="1">Aceptado</option>
            </select><br><br>

            <input type="submit" value="Agregar Evento">
        </ul>
    </form>
</body>
</html>
