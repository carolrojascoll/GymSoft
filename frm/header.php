    <nav class="navbar navbar-expand-lg navbar-dark bg" id="header">
        <div class="container-fluid">
            <a class="navbar-brand inicio" href="#"><img src="../../img/mundoGym.jpg" width="70px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-4 text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimientos
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded" href="../ciudad/ciudad.php">Ciudades</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../clientes/clientes.php" id="viewClientes">Clientes</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../ejercicios/ejercicios.php" id="viewEjercicios">Ejercicios</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../rutina/registrar_rutina.php" id="viewRutinas">Rutinas de
                                    Ejercicios</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../entrenadores/entrenadores.php" id="viewEntrenadores">Entrenadores</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../asistencia/registrar_asistencia.php" id="viewRegAsistencia">Registrar Asistencia</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold rounded mt-1" href="../medidas/registrar_medida.php" id="viewRegMedidas">Medidas</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../marcas/marcas.php" id="viewMarcas">Marcas</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../articulos/articulos.php" id="viewArticulos">Articulos</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../proveedores/proveedores.php" id="viewProveedores">Proveedores</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../roles/roles.php" id="viewRoles">Roles</a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../usuarios/usuarios.php" id="viewUsuarios">Usuarios</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-4 text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Compras
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../compras/registrar_compras.php" id="viewRegCompras">Registrar
                                    Compras</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#" id="viewRegPagos">Registrar pagos
                                    por compras</a>
                            </li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#" id="viewAnular">Anular Compras</a>
                            </li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#" id="viewAjuste">Ajuste de
                                    Stock</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-4 text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Facturación
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#">Registrar Pagos</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../ventas/registrar_ventas.php">Registrar Ventas</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#">Gestión de Membresias</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-4 text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Consultas
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../asistencia/consultar_asistencia.php" id="consulAsist">Consultar Asistencias</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../rutina/consultar_rutinas.php" id="consulMedidas">Consultar
                                    Rutinas</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../medidas/consultar_medidas.php" id="consulMedidas">Consultar
                                    Medidas</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../compras/consultar_compras.php" id="consulCompras">Consultar
                                    Compras</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="../ventas/consultar_ventas.php" id="consulVentas">Consultar
                                    Ventas</a></li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#" id="consulPagoEntrenadores">Consultar Pago a
                                    Entrenadores</a>
                            </li>
                            <li><a class="dropdown-item fw-bold bg-gradient rounded mt-1" href="#" id="consulPagoClientes">Consultar Pago de
                                    Membresias</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        <span id="sesion"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Modificar Contraseña</a></li>
                        <li onclick="cerrarSesion()"><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end rounded-3 bg border-0" data-bs-scroll="false" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title border-2" id="offcanvasWithBothOptionsLabel"></h5>
            <button type="button" class="btn text-white fs-4 bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
        </div>
        <div class="offcanvas-body">
            <div class="center bg-transparent border-0">
                <span id="acerca_de"></span><br><br>
            </div>
            <div class="text-white">
                <span id="-nombre"></span><br>
                <span id="-ciudad"></span><br>
                <span id="-direccion"></span><br>
                <span id="-telefono"></span><br>
                <span id="-edad"></span><br>
                <span id="-rol"></span><br>
            </div>

            <div class="row mt-3">
                <div class="col-7">
                    <a href="../usuarios/modificar_contraseña.php" class="btn text-white bg-gradient border-0">Modificar Contraseña</a>
                </div>
                <div class="col-5">
                    <button type="button" class="btn text-white bg-gradient border-0" onclick="cerrar_sesion()">Cerrar
                        Sesión</button>
                </div>
            </div>
        </div>
    </div>
    </div>