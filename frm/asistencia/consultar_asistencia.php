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
                    <h3 class="text-center text-white">Consultar Asistencias</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="desde">Desde</label>
                            <input type="date" name="desde" id="desde" class="form-control" max="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="desde">Hasta</label>
                            <input type="date" name="hasta" id="hasta" class="form-control" max="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="col-md-3 mt-4">
                            <button type="button" class="btn btn-primary cargar" onclick="cargar_asistencias()">
                                <i class="fa fa-upload"></i> Consultar</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="reg_asistencia" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>CLIENTE</th>
                                    <th>ENTRADA</th>
                                    <th>SALIDA</th>
                                    <th>TIEMPO</th>
                                    <th>FECHA</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <a href="../../menu.html" type="button" class="btn btn-secondary fs-6" id="btnCerrar"><i class="bi bi-x-square"></i> Cerrar</a>
                        </div>
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
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="js/funciones.js"></script>
    <script src="../../js/funciones.js"></script>

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
            siguienteCampo("#ruc", ".buscar", false);
            fechaActual("desde");
            fechaActual("hasta");
            cargar_asistencias();
        });
    </script>

</body>

</html>