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
 
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"></i>Jornada Yucateca</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.html" class="nav-item nav-link">INICIO</a>
                        <a href="menu.php" class="nav-item nav-link active">EVENTOS</a>
                        <a href="login.html" class="nav-item nav-link">INICIAR SESIÓN</a>
                        
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header2 mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                        </div>
                    </div>
               
                    <center><div class="video-container">
                        <!--<video controls>
                          <source src="video/Video de WhatsApp 2023-06-07 a las 18.13.14.mp4" type="video/mp4">
                           Otras fuentes de video en diferentes formatos si lo deseas 
                          Tu navegador no admite la reproducción de video.
                        </video>-->
                    
                      
                    <style>
    .hero-header2 {
        background-image: url(https://fondosmil.com/fondo/28255.jpg);
        background-size: cover;
        background-position: center;
        height: auto;
    }
</style>
<style>
    .image-item {
        float: left;
        margin-right: 20px;
        margin-bottom: 20px;
    }
</style>
<style>
    .image-container h2,
    .image-container p {
        color: #fff;
    }
</style>


<?php
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

    // Verificar si se ha pasado el parámetro 'id' en la URL
    if (isset($_GET['id'])) {
        // Obtener el ID del evento
        $idEvento = $_GET['id'];

        // Obtener la información del evento
        $sql = "SELECT * FROM eventos WHERE IDEventos = $idEvento";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            // Mostrar la información del evento
            $row = $result->fetch_assoc();
            $eventoTitulo = $row['Titulo'];
            $eventoDescripcion = $row['Descripcion'];
            $eventoFecha = $row['Fecha'];
            $eventoUbicacion = $row['Ubicacion'];
            $eventoHora = $row['Hora'];
            $eventoFoto = $row['Fotos'];

            echo "<div class='image-container'>";
            echo "<div class='image-item'>";
            echo "<img src='$eventoFoto' alt='Imagen del evento' width='350' height='250'>";
            echo "<h2>$eventoTitulo</h2>";
            echo "<p>Descripción: $eventoDescripcion</p>";
            echo "<p>Fecha: $eventoFecha</p>";
            echo "<p>Hora: $eventoHora</p>";
            echo "<p>Ubicación: $eventoUbicacion</p>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "No se encontró el evento.";
        }
    } else {
        echo "No se ha proporcionado el ID del evento.";
    }

    // Cerrar la conexión
    $conn->close();
?>
<br><br>






</div></center>

<center><!-- Agrega este código donde quieras mostrar el botón de regresar -->
<a href="javascript:history.back()" class="btn btn-primary">Regresar</a></center>
          
                  </div>
          
                </div>
              </section>
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
