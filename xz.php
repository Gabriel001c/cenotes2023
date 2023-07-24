<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agregar Evento - Admin</title>
        <link href="css/adm.css" rel="stylesheet" />
        <link href="css/adm2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="indexadm.php">Jornada Yucateca</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-in+line ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
        
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.html">Cerrar Sesión</a></li>
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
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">"Agregar Evento"</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="indexadm.php">Volver al panel</a></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <legend>Datos de Evento</legend>
                                <form action="procesar.php" method="POST" enctype="multipart/form-data">
        <ul>
            <label for="Titulo">Nombre del evento:</label><br>
            <input type="text" id="Titulo" name="titulo"><br>

            <label for="Descripcion">Descripción:</label><br>
            <input type="text" id="Descripcion" name="descripcion"><br>

            <legend>Indica Fecha del evento:</legend>
            <label for="Fecha">Fecha:</label>
            <input type="date" id="Fecha" name="fecha"><br>
            <label for="Hora">Hora:</label>
            <input type="time" id="Hora" name="Hora"><br>

            <label for="Foto">Foto:</label>
            <input type="file" id="Foto" name="foto"><br><br>

            <label for="Ubicacion">Ubicación (Google Maps):</label><br>
            <input type="text" id="Ubicacion" name="Ubicacion"><br><br>

            <label for="IDEstatus">Selecciona una categoría:</label><br>
            <select id="IDEstatus" name="IDEstatus">
                <option value="">Categoría</option>
                <option value="1">Baile</option>
                <option value="2">Música</option>
            </select><br><br>

            <label for="Aceptado">Aceptar</label><br>
            <input type="checkbox" id="Aceptado" name="aceptado" value="1"><br><br>

            <input type="submit" value="Agregar Evento">
        </ul>
    </form>
                                
                            </div>
                        </div>
                        

                        
                                
                            </div>
                    
          </div>
                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Jornada Yucateca 2023</div>
                            <div>
                                <a href="#">Politicas de privacidad</a>
                                &middot;
                                <a href="#">Terms &amp; Condiciones</a>
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
