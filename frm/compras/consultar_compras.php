<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Compras</title>
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
                    <h3 class="text-center text-white">Compras</h3>
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
                            <button type="button" class="btn btn-primary cargar" onclick="cargarCompras()">
                                <i class="fa fa-upload"></i> Consultar</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="compras" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">id</th>
                                    <th>N° FACTURA</th>
                                    <th>PROVEEDOR</th>
                                    <th>TOTAL</th>
                                    <th>FECHA</th>
                                    <th>CONDICIÓN</th>
                                    <th style="width: 2px;">PAGADO</th>
                                    <th style="width: 2px;">ANULADO</th>
                                    <th style="width: 2px;">DETALLE</th>
                                    <th style="width: 2px;">ANULAR</th>
                                    <th style="width: 2px;">PAGAR</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="../../menu.html" class="btn btn-secondary"><i class="bi bi-x-square"></i> Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mostrar Detalle -->

    <div class="modal fade" id="modalDetalle" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Mostrar Detalle</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h3 id="proveedor" class="text-center">proveedor...</h3>
                        <span id="factura" class="fs-5"></span>
                        <span id="fecha" class="fs-5"></span>
                        <span id="total" class="fs-5"></span>
                    </div>
                    <div class="table-responsive">
                        <table id="detalle_compra" class="table table-hover w-100 table-striped">
                            <thead>
                                <tr>
                                    <th class="text-end" style="width: 2%;">CANTIDAD</th>
                                    <th>ARTÍCULO</th>
                                    <th class="text-end" style="width: 2%;">PRECIO</th>
                                    <th class="text-end" style="width: 2%;">EXENTAS</th>
                                    <th class="text-end" style="width: 2%;">IVA 5%</th>
                                    <th class="text-end" style="width: 2%;">IVA 10%</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mostrar Detalle -->

    <!-- Modal Registrar Pago de Compra -->

    <div class="modal fade" id="modalPagoCompra" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Registrar Pago</h3>
                    <button type="button" class="btn-close cerrarModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="prov" class="text-center">Proveedor...</h4>
                    <div class="row">
                        <span id="factura"></span>
                        <span id="fecha"></span>
                        <span id="total"></span>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="efectivo">Efectivo</label>
                            <input type="text" name="efectivo" id="efectivo" class="form-control text-end" value="0" class="form-control text-end" oninput="this.value= solo_numeros_sin_cero(this.value), agregarSeparador(this)">
                        </div>
                        <div class="col-4">
                            <label for="transferencia">Transferencia</label>
                            <input type="text" name="transferencia" id="transferencia" class="form-control text-end" value="0" class="form-control text-end" oninput="this.value= solo_numeros_sin_cero(this.value), agregarSeparador(this)">
                        </div>
                        <div class="col-4">
                            <label for="cheque">Cheque</label>
                            <input type="text" name="cheque" id="cheque" class="form-control text-end" value="0" class="form-control text-end" oninput="this.value= solo_numeros_sin_cero(this.value), agregarSeparador(this)">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <label for="importe">Importe</label>
                            <input type="text" name="importe" id="importe" class="form-control text-end fw-bold" readonly value="0">
                        </div>
                        <div class="col-4">
                            <label for="total_compra">Total a Pagar</label>
                            <input type="text" name="total_compra" id="total_compra" class="form-control text-end fw-bold" readonly>
                        </div>
                        <div class="col-4">
                            <label for="cambio">Vuelto</label>
                            <input type="text" name="vuelto" id="vuelto" class="form-control bg-warning fw-bold" value="0">
                        </div>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-success pay" id="btnPagar"><i class="bi bi-currency-dollar"></i> Pagar</button>
                        <button type="button" class="btn btn-danger cancel" id="btnCancel"><i class="bi bi-x-square"></i> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Registrar Pago de Compra -->

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
            });
            fechaActual("desde");
            fechaActual("hasta");
            cargarCompras();
        });
    </script>

</body>

</html>