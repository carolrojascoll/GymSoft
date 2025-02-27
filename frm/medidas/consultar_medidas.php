<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Medidas</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body id="main">
    <?php include("../header.php") ?>
    <div class="container-fluid" id="principal">
        <div class="fondo bg-transparent">
            <div class="card rounded border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Medidas</h3>
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
                            <button type="button" class="btn btn-primary cargar" onclick="cargarTabla()">
                                <i class="fa fa-upload"></i> Consultar</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datos_medidas" class="table table-hover table-bordered table-striped w-100">
                            <thead>
                                <th style="width: 1px;">id</th>
                                <th>CLIENTE</th>
                                <th style="width: 1px;">ESPALDA</th>
                                <th style="width: 1px;">PECHO</th>
                                <th style="width: 1px;">BICEPS</th>
                                <th style="width: 1px;">CINTURA</th>
                                <th style="width: 1px;">NALGA</th>
                                <th style="width: 1px;">MUSLOS</th>
                                <th style="width: 1px;">PANTORRILLAS</th>
                                <th style="width: 1px;">PESO</th>
                                <th>OBSERVACIÓN</th>
                                <th style="width: 1px;">FECHA</th>
                                <th style="width: 1px;">MODIFICAR</th>
                                <th style="width: 1px;">ELIMINAR</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-primary" href="registrar_medida.php"><i class="bi bi-plus-square"></i>
                                Registrar</a>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn btn-secondary" href="../../menu.html"><i class="bi bi-x-square"></i>
                                Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMedidas" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top modal-dialog-scrollable ancho">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_medidas" enctype="multipart/form-data">
                        <div class="modal-content alto">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="ruc">C.I o Ruc</label>
                                        <input type="text" name="ruc" id="ruc" class="form-control" autocomplete="off" onkeypress="return validar_ruc(event)" oninput="this.value= solo_numeros_ruc(this.value)">
                                    </div>
                                    <div class="col-md-4 mt-4 text-center">
                                        <button type="button" class="btn btn-primary buscar" onclick="buscar_cliente()"><i class="bi bi-search"></i>
                                            Buscar</button>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12">
                                        <label for="cliente">Cliente</label>
                                        <input type="text" name="cliente" id="cliente" class="form-control fw-bold" readonly>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <label for="espalda">Espalda</label>
                                        <input type="text" name="espalda" id="espalda" class="form-control" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pecho">Pecho</label>
                                        <input type="text" name="pecho" id="pecho" class="form-control" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bicep_izq">Bicep Izquierdo</label>
                                        <input type="text" name="bicep_izq" id="bicep_izq" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bicep_der">Bicep Derecho</label>
                                        <input type="text" name="bicep_der" id="bicep_der" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <label for="cintura">Cintura</label>
                                        <input type="text" name="cintura" id="cintura" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nalga">Nalga</label>
                                        <input type="text" name="nalga" id="nalga" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="muslo_izq">Muslo Izquierdo</label>
                                        <input type="text" name="muslo_izq" id="muslo_izq" class="form-control" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="muslo_der">Muslo Derecho</label>
                                        <input type="text" name="muslo_der" id="muslo_der" class="form-control" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <label for="panto_izq">Pantorrilla Izquierda</label>
                                        <input type="text" name="panto_izq" id="panto_izq" class="form-control" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="panto_der">Pantorrilla Derecha</label>
                                        <input type="text" name="panto_der" id="panto_der" class="form-control" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="peso">Peso</label>
                                        <input type="text" name="peso" id="peso" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="observacion">Observación</label>
                                        <input type="text" name="observacion" id="observacion" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_medida" id="id_medida">
                                <input type="hidden" name="id_cliente" id="id_cliente">
                                <input type="hidden" name="operacion" id="operacion">
                                <button type="button" name="action" id="action" class="btn btn-primary" onclick="guardar_medida()"></button>
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
    <script src="../../js/funciones.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        $(document).ready(function() {
            verificarSesion();
            user_logueado();
            $("#sesion").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded-circle" width="60px" height="50" />');
            $("#acerca_de").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded" width="300px" height="280" />');
            $("#-nombre").html(localStorage.nombre);
            $("#-ciudad").html(localStorage.ciudad);
            $("#-direccion").html(localStorage.direccion);
            $("#-telefono").html(localStorage.telefono);
            $("#-edad").html(localStorage.edad);
            $("#-rol").html(localStorage.rol);
            fechaActual("desde");
            fechaActual("hasta");
            cargarTabla();
        });
    </script>

</body>

</html>