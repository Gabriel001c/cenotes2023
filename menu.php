<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "integrador5";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los eventos filtrados por IDEstatus y Aceptado
if (isset($_GET['estatus'])) {
    $filtroEstatus = $_GET['estatus'];

    $sql = "SELECT * FROM eventos WHERE IDEstatus = $filtroEstatus AND Aceptado = 1";
} else {
    $sql = "SELECT * FROM eventos WHERE Aceptado = 1";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MayanQuest</title>
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
                    <a href="index.html" class="nav-item nav-link">INICIO</a>
                    <a href="menu.php" class="nav-item nav-link active">EVENTOS</a>
                    <a href="login.php" class="nav-item nav-link">INICIAR SESIÓN</a>
                </div>
            </div>
        </nav>

        <div class="container-xxl py-5 bg-dark hero-header2 mb-5">
            <div class="container my-5 py-5">
                <div class="row align-items-center g-5">
                <form action="menu.php" method="GET" class="d-flex justify-content-center">
                            <div class="input-group">
                                <select name="estatus" class="form-select">
                                    <option value="">Seleccione Alguna Categoria</option>
                                    <option value="1">Baile</option>
                                    <option value="2">Musica</option>
                                    <option value="3">Cine</option>
                                    <option value="4">Teatro</option>
                                    <option value="5">Comedia</option>
                                </select>
                                <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
                            </div>
                        </form> <br>
                        
                    <?php
// Verificar si hay eventos con Aceptado = 1 y la fecha y hora haya pasado
$sql = "UPDATE eventos SET Aceptado = 2 WHERE Aceptado = 1 AND (Fecha < CURDATE() OR (Fecha = CURDATE() AND Hora < CURTIME()))";
$conn->query($sql);


                    $counter = 0;
                    while ($row = $result->fetch_assoc()) {
                        $eventoId = $row['IDEventos'];
                        $eventoTitulo = $row['Titulo'];
                        $eventoFoto = $row['Fotos'];

                        if ($counter % 3 == 0) {
                            echo "<div class='row'>";
                        }

                        echo "<div class='col-md-4'>";
                        echo "<div class='image-item'>";
                        echo "<img src='$eventoFoto' alt='Imagen del evento' width='350' height='250'>";
                        echo "<h2><a href='ver_informacion.php?id=$eventoId'>$eventoTitulo</a></h2>";
                        echo "</div>";
                        echo "</div>";

                        if ($counter % 3 == 2) {
                            echo "</div>";
                        }

                        $counter++;
                    }

                    // Cerrar la fila si quedan elementos en la última fila incompleta
                    if ($counter % 3 != 0) {
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
