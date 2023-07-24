<?php
session_start();

// Verificar si el usuario ha iniciado sesión y obtener su ID de usuario
$usuarioId = null;
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['ID'])) {
    $usuarioId = $_SESSION['usuario']['ID'];
} else {
    // Redireccionar al inicio de sesión o a otra página apropiada
    header("Location: login.php");
    exit();
}

require_once 'conexion/Database.php';

// Crear una instancia de la clase Database
$db = new Database();

// Obtener la conexión a la base de datos
$conn = $db->getConnection();

// Obtener el ID del usuario actual
$usuarioId = $_SESSION['usuario']['ID'];

// Obtener eventos creados por el usuario
function obtenerEventosPorUsuario($usuarioId, $aceptado)
{
    global $conn;

    // Consultar los eventos con el valor de Aceptado y IDUsuario especificados
    $query = "SELECT * FROM eventos WHERE Aceptado = ? AND IDUsuario = ? ORDER BY Fecha ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $aceptado, $usuarioId);
    $stmt->execute();
    $result = $stmt->get_result();

    $eventos = array();

    // Obtener los resultados y almacenarlos en un array
    while ($row = $result->fetch_assoc()) {
        $eventos[] = $row;
    }

    return $eventos;
}

// Obtener eventos Aceptado=0 creados por el usuario actual
$eventosAceptados0 = obtenerEventosPorUsuario($usuarioId, 0);

// Obtener eventos Aceptado=1 creados por el usuario actual
$eventosAceptados1 = obtenerEventosPorUsuario($usuarioId, 1);


// Obtener el ID del evento a editar
$eventoId = isset($_POST['IDEventos']) ? $_POST['IDEventos'] : '';

// Verificar si se envió el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $editarTitulo = $_POST['editar_titulo'];
    $editarDescripcion = $_POST['editar_descripcion'];
    $editarFecha = $_POST['editar_fecha'];
    $editarHora = $_POST['editar_Hora'];
    $editarFoto = $_FILES['editar_foto']['name'];
    $editarFotoTmp = $_FILES['editar_foto']['tmp_name'];
    $editarUbicacion = $_POST['editar_ubicacion'];
    $editarIDEstatus = $_POST['editar_idestatus'];

    // Guardar la imagen en el servidor
    if (!empty($editarFotoTmp)) {
        // Ruta donde se guardarán las imágenes
        $rutaImagen = 'carpeta/imagenes/' . $editarFoto;

        // Mover la imagen a la ubicación deseada
        move_uploaded_file($editarFotoTmp, $rutaImagen);
    } else {
        // Si no se cargó una nueva imagen, conservar la imagen existente en la base de datos
        $query = "SELECT Fotos FROM eventos WHERE IDEventos = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $eventoId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rutaImagen = $row['Fotos'];
        }
    }

    // Actualizar los datos del evento en la base de datos
    $query = "UPDATE eventos SET Titulo = ?, Descripcion = ?, Fecha = ?, Hora = ?, Fotos = ?, Ubicacion = ?, IDEstatus = ? WHERE IDEventos = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssii", $editarTitulo, $editarDescripcion, $editarFecha, $editarHora, $rutaImagen, $editarUbicacion, $editarIDEstatus, $eventoId);

    if ($stmt->execute()) {
        // Redireccionar a la página original
        header("Location: AgregarEventos.php");
        exit();
    } else {
        // Mostrar mensaje de error en caso de fallo en la actualización
        echo "Error al actualizar el evento.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Jornada Yucateca</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/mayas.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0">Jornada Yucateca</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 pe-4">
                    <a href="index.html" class="nav-item nav-link">CERRAR SESIÓN</a>
                    <a href="AgregarEventos.php" class="nav-item nav-link active">AGREGAR EVENTOS</a>
                </div>
            </div>
        </nav>

        <div class="container-xxl py-5 bg-dark hero-header2 mb-5">
            <div class="container my-5 py-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                    </div>
                </div>

                <center>
                    <div class="card-body text-white">
                        <legend>Datos de Evento</legend>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Obtener los datos del formulario
                            $titulo = $_POST['titulo'];
                            $descripcion = $_POST['descripcion'];
                            $fecha = $_POST['fecha'];
                            $hora = $_POST['Hora'];
                            $IDEstatus = $_POST['IDEstatus'];
                            $ubicacion = $_POST['Ubicacion'];
                            $aceptado = isset($_POST['aceptado']) && $_POST['aceptado'] == '1' ? 1 : 0;
                            $usuarioId = $_POST['usuarioId'];

                            // Guardar el evento en la base de datos
                            // ...

                            // Mostrar un mensaje de éxito
                            echo '<div class="alert alert-success" role="alert">Evento enviado para que el administrador lo revise.</div>';
                        }
                        ?>
                        <form action="procesar.php" method="POST" enctype="multipart/form-data">
                            <table class="table text-white">
                                <tr>
                                    <td><label for="titulo" class="form-label">Nombre del evento:</label></td>
                                    <td><input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="<?php echo isset($evento) ? $evento['Titulo'] : ''; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="descripcion" class="form-label">Descripción:</label></td>
                                    <td><textarea class="form-control form-control-sm" id="descripcion" name="descripcion"><?php echo isset($evento) ? $evento['Descripcion'] : ''; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="fecha" class="form-label">Fecha:</label></td>
                                    <td><input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="<?php echo isset($evento) ? $evento['Fecha'] : ''; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="Hora" class="form-label">Hora:</label></td>
                                    <td><input type="Time" class="form-control form-control-sm" id="Hora" name="Hora" value="<?php echo isset($evento) ? $evento['Hora'] : ''; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="foto" class="form-label">Foto:</label></td>
                                    <td><input type="file" class="form-control form-control-sm" id="foto" name="foto"></td>
                                </tr>
                                <tr>
                                    <td><label for="Ubicacion" class="form-label">Ubicación:</label></td>
                                    <td><input type="text" class="form-control form-control-sm" id="Ubicacion" name="Ubicacion" value="<?php echo isset($evento) ? $evento['Ubicacion'] : ''; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="IDEstatus" class="form-label">Selecciona una categoría:</label></td>
                                    <td>
                                        <select class="form-select form-control-sm" id="IDEstatus" name="IDEstatus">
                                            <option value="">Categoría</option>
                                            <option value="1" <?php echo isset($evento) && $evento['IDEstatus'] == 1 ? 'selected' : ''; ?>>Baile</option>
                                            <option value="2" <?php echo isset($evento) && $evento['IDEstatus'] == 2 ? 'selected' : ''; ?>>Música</option>
                                            <option value="3" <?php echo isset($evento) && $evento['IDEstatus'] == 3 ? 'selected' : ''; ?>>Cine</option>
                                            <option value="4" <?php echo isset($evento) && $evento['IDEstatus'] == 4 ? 'selected' : ''; ?>>Teatro</option>
                                            <option value="5" <?php echo isset($evento) && $evento['IDEstatus'] == 5 ? 'selected' : ''; ?>>Comedia</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="usuarioId" value="<?php echo $usuarioId; ?>">
                            <button type="submit" class="btn btn-primary"><?php echo isset($evento) ? 'Actualizar evento' : 'Enviar evento'; ?></button>
                        </form>

                        
<h1 style="color: white;">Eventos en espera</h1>

<!-- Tabla para eventos Aceptado=1 -->
<table class="table text-white">
    <thead>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Foto</th>
            <th>Ubicación</th>
            <th>Categoría</th>
            <th>Comentario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventosAceptados0 as $evento) : ?>
            <tr>
                <td><?php echo $evento['Titulo']; ?></td>
                <td><?php echo $evento['Descripcion']; ?></td>
                <td><?php echo $evento['Fecha']; ?></td>
                <td><?php echo $evento['Hora']; ?></td>
                <td><img src="<?php echo $evento['Fotos']; ?>" alt="Foto" width="100"></td>
                <td><?php echo $evento['Ubicacion']; ?></td>
                <td><?php echo $evento['IDEstatus']; ?></td>
                <td><?php echo $evento['Comentario']; ?></td>
                <td>    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarEventoModal<?php echo $evento['IDEventos']; ?>">
                                                Editar
                                            </button></td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editarEventoModal<?php echo $evento['IDEventos']; ?>" tabindex="-1" aria-labelledby="editarEventoModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editarEventoModalLabel">Editar Evento</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="IDEventos" value="<?php echo $evento['IDEventos']; ?>">
                                                                <div class="mb-3">
                                                                    <label for="editarTitulo" class="form-label">Título</label>
                                                                    <input type="text" class="form-control" id="editarTitulo" name="editar_titulo" value="<?php echo $evento['Titulo']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editarDescripcion" class="form-label">Descripción</label>
                                                                    <input type="text" class="form-control" id="editarDescripcion" name="editar_descripcion" value="<?php echo $evento['Descripcion']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editarFecha" class="form-label">Fecha</label>
                                                                    <input type="date" class="form-control" id="editarFecha" name="editar_fecha" value="<?php echo $evento['Fecha']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editarHora" class="form-label">Hora</label>
                                                                    <input type="time" class="form-control" id="editarHora" name="editar_Hora" value="<?php echo $evento['Hora']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editarFoto" class="form-label">Foto</label>
                                                                    <input type="file" class="form-control" id="editarFoto" name="editar_foto">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editarUbicacion" class="form-label">Ubicación (Google Maps)</label>
                                                                    <input type="text" class="form-control" id="editarUbicacion" name="editar_ubicacion" value="<?php echo $evento['Ubicacion']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editarIDEstatus" class="form-label">Categoría</label>
                                                                    <select class="form-select" id="editarIDEstatus" name="editar_idestatus">
                                                                        <option value="1" <?php if ($evento['IDEstatus'] == 1) echo 'selected'; ?>>Baile</option>
                                                                        <option value="2" <?php if ($evento['IDEstatus'] == 2) echo 'selected'; ?>>Música</option>
                                                                        <option value="3" <?php if ($evento['IDEstatus'] == 3) echo 'selected'; ?>>Cine</option>
                                                                        <option value="4" <?php if ($evento['IDEstatus'] == 4) echo 'selected'; ?>>Teatro</option>
                                                                        <option value="5" <?php if ($evento['IDEstatus'] == 5) echo 'selected'; ?>>Comedia</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <table class="table text-white">
                        <h1 style="color: white;">Eventos aceptados</h1>
    <thead>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Foto</th>
            <th>Ubicación</th>
            <th>Categoría</th>
            <th>Comentario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventosAceptados1 as $evento) : ?>
            <tr>
                <td><?php echo $evento['Titulo']; ?></td>
                <td><?php echo $evento['Descripcion']; ?></td>
                <td><?php echo $evento['Fecha']; ?></td>
                <td><?php echo $evento['Hora']; ?></td>
                <td><img src="<?php echo $evento['Fotos']; ?>" alt="Foto" width="100"></td>
                <td><?php echo $evento['Ubicacion']; ?></td>
                <td><?php echo $evento['IDEstatus']; ?></td>
                <td><?php echo $evento['Comentario']; ?></td>
                <td>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                    </div>

                    <style>
                        .mensaje-flotante {
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background-color: #0F172B;
                            padding: 40px;
                            border-radius: 5px;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
                            z-index: 9999;
                        }

                        .mensaje-flotante h3 {
                            margin: 0;
                            color: #FEA116;
                            font-size: 24px;
                        }
                    </style>

                    <script>
                        function mostrarMensaje(event) {
                            event.preventDefault(); // Evitar que se envíe el formulario de inmediato

                            var mensajeFlotante = document.createElement("div");
                            mensajeFlotante.classList.add("mensaje-flotante");

                            var mensajeTexto = document.createElement("h3");
                            mensajeTexto.textContent = "Evento enviado para que el administrador lo revise";

                            mensajeFlotante.appendChild(mensajeTexto);
                            document.body.appendChild(mensajeFlotante);

                            setTimeout(function() {
                                mensajeFlotante.remove();
                                // Después de mostrar el mensaje, enviar el formulario
                                event.target.closest('form').submit();
                            }, 3000); // Eliminar el mensaje después de 3 segundos
                        }
                    </script>
                </center>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Service Start -->

        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
