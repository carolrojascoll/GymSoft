<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Asistencias</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body id="main">
    <?php include("../header.php") ?>

    <div class="container" id="principal">
        <div class="fondo bg-transparent">
            <div class="card border-0 rounded">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Rutinas</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="rutinas" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Rutina</th>
                                    <th style="width: 10px;">Eliminar</th>
                                    <th style="width: 10px;">Detalle</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="registrar_rutina.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Nuevo</a>
                        </div>
                        <div class="col-6 text-end">
                            <a href="../../menu.html" class="btn btn-secondary"><i class="bi bi-x-square"></i> Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetalle" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top w-50 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <h3 id="rutina">Rutina de...</h3>
                    </div>
                    <div class="table-responsive">
                        <h3 class="text-center" id="descripcion"></h3>
                        <table id="detalle_rutina" class="table table-hover w-100 table-striped">
                            <thead>
                                <tr>
                                    <th class="text-end" style="width: 10px;">ORDEN</th>
                                    <th class="text-start">EJERCICIO</th>
                                    <th class="text-end" style="width: 10px;">SERIES</th>
                                    <th class="text-end" style="width: 10px;">REPETICIONES</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../datatables/datatables.min.js"></script>
    <script src="../../datatables/jszip.min.js"></script>
    <script src="../../datatables/pdfmake.min.js"></script>
    <script src="../../datatables/vfs_fonts.js"></script>
    <script src="../../datatables/buttons.html5.min.js"></script>
    <script src="../../datatables/buttons.html5.styles.min.js"></script>
    <script src="../../datatables/buttons.html5.styles.templates.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="../../js/funciones.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        $(document).ready(function() {
            user_logueado();
            $("#sesion").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded-circle" width="60px" height="50" />');
            $("#acerca_de").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="img-thumbnail" width="300px" height="280" />');
            $("#-nombre").html(localStorage.nombre);
            $("#-ciudad").html(localStorage.ciudad);
            $("#-direccion").html(localStorage.direccion);
            $("#-telefono").html(localStorage.telefono);
            $("#-edad").html(localStorage.edad);
            $("#-rol").html(localStorage.rol);
            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })
        });
    </script>

</body>

</html>