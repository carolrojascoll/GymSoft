<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body id="main">
    <?php include("../header.php") ?>
    <div class="container-fluid w-25" id="principal">
        <div class="fondo bg-transparent border-0">
            <div class="card border-0">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Registrar Asistencia</h3>
                </div>
                <div class="card-body">
                    <form method="POST" id="form_regAsistencia" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ruc">Ci o Ruc</label>
                                        <input type="text" name="ruc" id="ruc" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-md-6 mt-4 text-end">
                                        <button type="button" class="btn btn-primary buscar" onclick="buscar_cliente()">
                                            <i class="bi bi-search"></i> Buscar</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="cliente">Cliente</label>
                                        <input type="text" name="cliente" id="cliente" class="form-control fw-bold" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="id_cliente" id="id_cliente" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="entrada">Entrada</label>
                                        <input type="text" name="entrada" id="entrada" class="form-control fw-bold" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="salida">Salida</label>
                                        <input type="text" name="salida" id="salida" class="form-control fw-bold" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary registrar" onclick="guardar_asistencia()"><i class="bi bi-save"></i> Registrar</button>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="../../menu.html" type="button" class="btn btn-secondary cerrar fs-6" id="btnCerrar"><i class="bi bi-x-square"></i> Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Registrar Asistencia -->

    <div class="modal fade" id="modalRegAsistencia" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-bottom">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Registrar Asistencia</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form_regAsistencia" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="codigo" id="codigo" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <input type="hidden" name="id_entrenador" id="id_entrenador">
                                        <input type="hidden" name="operacion" id="operacion">
                                        <input type="submit" name="action" id="action" class="btn btn-primary" value="Crear">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="js/funciones.js"></script>
    <script src="../../js/funciones.js"></script>

    <script>
        $(document).ready(function() {
            siguienteClick("#ruc", ".buscar", false);
            user_logueado();
            $("#ruc").focus();
            $("#sesion").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded-circle" width="60px" height="50" />');
            $("#acerca_de").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded" width="300px" height="280" />');
            $("#-nombre").html(localStorage.nombre);
            $("#-ciudad").html(localStorage.ciudad);
            $("#-direccion").html(localStorage.direccion);
            $("#-telefono").html(localStorage.telefono);
            $("#-edad").html(localStorage.edad);
            $("#-rol").html(localStorage.rol);
        });
    </script>

</body>