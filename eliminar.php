<?php
require_once 'controllers/UsuarioController.php';

// Crear una instancia del controlador de usuarios
$usuarioController = new UsuarioController();

// Obtener todos los usuarios
$usuarios = $usuarioController->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Usuarios</title>
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
                    <div class="sb-sidenav-menu-heading">Inicio</div>
                    <a class="nav-link" href="indexadm.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Panel de administración
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Eventos
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="evento.php">Ver eventos</a>
                            <a class="nav-link" href="xz.php">Agregar Eventos</a>
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
                <h1 class="mt-4">Usuarios</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Lista de Usuarios</li>
                </ol>
                
<?php
require_once 'model/UsuarioModel.php';
require_once 'conexion/Database.php';

// Verificar si se ha recibido el parámetro ID
if (isset($_GET['ID'])) {
    // Obtener el ID del usuario a eliminar
    $idUsuario = $_GET['ID'];

    // Crear una instancia del modelo de Usuario
    $usuarioModel = new UsuarioModel();

    // Eliminar el usuario de la base de datos
    $eliminado = $usuarioModel->eliminarUsuario($idUsuario);

    if ($eliminado) {
        // El usuario se eliminó correctamente
        echo "Usuario eliminado exitosamente";
    } else {
        // No se pudo eliminar el usuario
        echo "Error al eliminar el usuario";
    }
} else {
    // No se proporcionó el parámetro ID, mostrar un mensaje de error
    echo "ID de usuario no proporcionado";
}
?>
<table id="tablaUsuarios" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><?php echo $usuario['NombreUsuarios']; ?></td>
                        <td><?php echo $usuario['Correo']; ?></td>
                        <td><?php echo $usuario['Contraseña']; ?></td>
                        <td>
                            <a href="#" onclick="confirmarEliminacion(<?php echo $usuario['ID']; ?>)">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>



                <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
                <script>
                    new simpleDatatables.DataTable("#tablaUsuarios");
                    function confirmarEliminacion(idUsuario) {
            var confirmacion = confirm('¿Estás seguro de que quieres eliminar este usuario?');
            if (confirmacion) {
                window.location.href = 'eliminar.php?ID=' + idUsuario;
            }
        }
                </script>
            </div>
        </main>
        <footer class="py-4" style="background-color: #0F172B; color: white;">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; Jornada Yucateca 2023</div>
                    <div>
                        <a href="#" style="color: white;">Politicas de seguridad</a>
                        &middot;
                        <a href="#" style="color: white;">Terms &amp; Condiciones</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>



