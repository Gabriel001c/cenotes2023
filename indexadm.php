<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel de administración</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/adm.css" rel="stylesheet" />
        <link href="css/adm2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="indexadm.php">Jornada Yucateca</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="index.html">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading" >Inicio</div>
                            <a  class="nav-link" href="indexadm.php">
                                <div class="sb-nav-link-icon" style="background-color: #0F172B; color: white;"><i class="fas fa-tachometer-alt" style="background-color: #0F172B; color: white;"></i></div>
                                Panel de adminitracion
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon" style="background-color: #0F172B; color: white;"><i class="fas fa-columns"style="background-color: #0F172B; color: white;"></i></div>
                                Eventos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="evento.php">Ver eventos</a>
                                    <a class="nav-link" href="usuario.php">Usuarios</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style="background-color: #0F172B; color: white;">Panel de adminitracion principal</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active" style="background-color: #0F172B; color: white;">Bienvenido al sistema</li>
                        </ol>
                        <?php
require_once 'controllers/EventoController.php';

// Crear una instancia del controlador de eventos
$eventoController = new EventoController();

// Verificar si se proporciona el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    // Mostrar todos los eventos
    $eventos = $eventoController->mostrarEventos();
} else {
    // Agregar un nuevo evento

    // Mostrar todos los eventos
    $eventos = $eventoController->mostrarEventos();
}
?>

<?php if (!empty($eventos)) { ?>
    <table id="tablaEventos" class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estatus</th>
                <th>Comentario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventos as $evento) { ?>
                <tr>
                    <td><?php echo $evento['titulo']; ?></td>
                    <td><?php echo $evento['descripcion']; ?></td>
                    <td><?php echo $evento['fecha']; ?></td>
                    <td><?php echo $evento['Hora']; ?></td>
                    <td><?php echo $evento['estatus']; ?></td>
                    <td><?php echo $evento['Comentario']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
<?php } ?>

<div id="ventanaFlotante" class="ventana-flotante" style="display: none;">
    <button class="cerrar-ventana" onclick="cerrarVentanaFlotante()">Cerrar</button>
</div>

<script>
    function abrirVentanaFlotante(idEvento) {
        var ventanaFlotante = document.getElementById('ventanaFlotante');
        ventanaFlotante.innerHTML = 'Cargando...';

        // Obtener los datos del evento mediante AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Insertar la respuesta en la ventana flotante
                ventanaFlotante.innerHTML = this.responseText;
                ventanaFlotante.style.display = 'block';
            }
        };
        xhttp.open("GET", "editar_evento.php?IDEventos=" + idEste es el código corregido para `indexadm.php`:

        <?php
require_once 'controllers/EventoController.php';

// Crear una instancia del controlador de eventos
$eventoController = new EventoController();

// Verificar si se proporciona el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    // Mostrar todos los eventos
    $eventos = $eventoController->mostrarEventos();
} else {
    // Agregar un nuevo evento

    // Mostrar todos los eventos
    $eventos = $eventoController->mostrarEventos();
}
?>

<?php if (!empty($eventos)) { ?>
    <table id="tablaEventos" class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estatus</th>
                <th>Comentario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventos as $evento) { ?>
                <tr>
                    <td><?php echo $evento['titulo']; ?></td>
                    <td><?php echo $evento['descripcion']; ?></td>
                    <td><?php echo $evento['fecha']; ?></td>
                    <td><?php echo $evento['Hora']; ?></td>
                    <td><?php echo $evento['estatus']; ?></td>
                    <td><?php echo $evento['Comentario']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p></p>
<?php } ?>

<script>
    function actualizarEventos() {
        var tablaEventos = document.getElementById('tablaEventos');
        tablaEventos.innerHTML = 'Cargando...';

        // Obtener los eventos actualizados mediante AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Insertar la respuesta en la tabla de eventos
                tablaEventos.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "controllers/EventoController.php?id", true);
        xhttp.send();
    }
</script>




                    </div>
                </main>
                <footer class="py-4" style="background-color: #0F172B; color: white;">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">&copy; Jornada Yucateca 2023</div>
           
        </div>
    </div>
</footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>