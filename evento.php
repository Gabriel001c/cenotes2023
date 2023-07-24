
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
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <a class="nav-link" href="indexadm.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel de adminitracion
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
                        <h1 class="mt-4">Panel de adminitracion principal</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Bienvenido al sistema</li>
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
                            // Obtener el valor de aceptado para el filtrado
                            $aceptado = isset($_GET['aceptado']) ? $_GET['aceptado'] : '';

                            // Mostrar los eventos filtrados por el valor de aceptado
                            $eventos = $eventoController->filtrarEventosPorAceptado($aceptado);
                        }
                        ?>

                        <!-- Formulario de filtro -->
                        <form method="GET" action="evento.php">
                            <label for="aceptado">Filtrar por Aceptado:</label>
                            <select name="aceptado" id="aceptado">
                                <option value="">Eventos</option>
                                <option value="0">No aceptado</option>
                                <option value="1">Aceptado</option>
                                <option value="2">Concluidos</option>

                            </select>
                            <button type="submit">Filtrar</button>
                        </form>

                        <?php if (!empty($eventos)) { ?>
                            <table id="tablaEventos" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Fotos</th>
                                        <th>Estatus</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($eventos as $evento) { ?>
                                        <tr>
                                            <td><?php echo $evento['Titulo']; ?></td>
                                            <td><?php echo $evento['Descripcion']; ?></td>
                                            <td><?php echo $evento['Fecha']; ?></td>
                                            <td><?php echo $evento['Hora']; ?></td>
                                            <td><img src="<?php echo $evento['Fotos']; ?>" alt="Imagen" width="100" height="100"></td>                                            <td><?php echo $evento['IDEstatus']; ?></td>
                                            <td><?php echo $evento['Comentario']; ?></td>
                                            <td>
                                            <a href="#" onclick="abrirModal(<?php echo $evento['IDEventos']; ?>, '<?php echo $evento['Ubicacion']; ?>')">Editar</a>
                </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p>No se encontraron eventos.</p>
                        <?php } ?>

                        <div id="ventanaFlotante" class="ventana-flotante" style="display: none;">
                            <button class="cerrar-ventana" onclick="cerrarVentanaFlotante()">Cerrar</button>
                        </div>
                        <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <iframe id="editarEventoFrame" src="" style="width: 100%; height: 100%; border: none;"></iframe>
        </div>
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
                                xhttp.open("GET", "model/editar_evento.php?IDEventos=" + idEvento, true);
                                xhttp.send();
                            }

                            function cerrarVentanaFlotante() {
                                var ventanaFlotante = document.getElementById('ventanaFlotante');
                                ventanaFlotante.style.display = 'none';
                            }
                            function abrirModal(idEvento, ubicacion) {
            var modal = document.getElementById('modal');
            var iframe = document.getElementById('editarEventoFrame');
            iframe.src = "model/editar_evento.php?IDEventos=" + idEvento + "&ubicacion=" + encodeURIComponent(ubicacion);
            modal.style.display = 'block';
        }

        function cerrarModal() {
            var modal = document.getElementById('modal');
            var iframe = document.getElementById('editarEventoFrame');
            iframe.src = "";
            modal.style.display = 'none';
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
