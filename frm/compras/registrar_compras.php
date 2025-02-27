<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Compras</title>
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
    <div class="container-fluid" id="principal">
        <div class="fondo bg-transparent">
            <div class="card border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Registrar Compras</h3>
                </div>
                <div class="card-body">
                    <!-- Datos Factura y Proveedor -->
                    <div class="row border rounded m-0">
                        <legend>Datos del Proveedor</legend>
                        <div class="col-2">
                            <label for="ruc">Ruc o C.I</label>
                            <input type="text" name="ruc" id="ruc" class="form-control text-end" autocomplete="off" onkeypress="return validar_ruc(event)" oninput="this.value= solo_numeros_ruc(this.value)">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary buscarProv" onclick="buscarProveedor()" hidden><i class="bi bi-search"></i></button>
                            <label for="proveedor">Proveedor</label>
                            <input type="text" name="proveedor" id="proveedor" class="form-control fw-bold" readonly>
                        </div>
                        <div class="col-2 mb-2">
                            <label for="num_fac">Num. Factura</label>
                            <input type="text" name="num_fac" id="num_fac" class="form-control text-end" maxlength="15" onkeyup="factura()">
                        </div>
                        <div class="col-2">
                            <label for="timbrado">Timbrado</label>
                            <input type="text" name="timbrado" id="timbrado" class="form-control text-end">
                        </div>
                        <div class="col-2">
                            <label for="condicion">Condición</label>
                            <select name="condicion" id="condicion" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="CONTADO">CONTADO</option>
                                <option value="CRÉDITO">CRÉDITO</option>
                            </select>
                        </div>
                        <div class="col-2 mb-2">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" max="<?= date("Y-m-d") ?>">
                        </div>
                    </div>
                    <!-- Datos Artículo -->
                    <div class="row mt-2 border rounded m-0">
                        <legend>Datos del Artículo</legend>
                        <div class="col-2">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" id="codigo" class="form-control text-end">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary buscarArt" onclick="buscarArticulo()" hidden><i class="bi bi-search"></i></button>
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control fw-bold" readonly>
                        </div>
                        <div class="col-1">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" name="cantidad" id="cantidad" class="form-control text-end" value="1" oninput="this.value = solo_numeros_sin_cero(this.value)" onkeyup="calcularSubTotal()">
                        </div>
                        <div class="col-1">
                            <label for="precio">Precio</label>
                            <input type="text" name="precio" id="precio" class="form-control text-end" oninput="this.value= solo_numeros_sin_cero(this.value), agregarSeparador(this)" onkeyup="calcularSubTotal()">
                        </div>
                        <div class="col-2">
                            <label for="subTotal">SubTotal</label>
                            <input type="text" name="subTotal" id="subTotal" class="form-control bg-warning fw-bold text-end" readonly>
                        </div>
                        <div class="col-2 text-end mb-2 d-grid">
                            <button type="button" class="btn btn-success agregar mb-1" onclick="agregarArticulo()"><i class="bi bi-plus-square"></i> Agregar</button>
                            <button type="button" class="btn btn-danger cancelar"><i class="bi bi-x-square"></i> Cancelar</button>
                        </div>
                    </div>
                    <!-- Tabla de Artículos -->
                    <div class="row mt-2 border rounded m-0">
                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="text-center">
                                    <th style="width: 10px;">#</th>
                                    <th>ARTÍCULO</th>
                                    <th style="width: 10px;">CANTIDAD</th>
                                    <th style="width: 150px;">PRECIO</th>
                                    <th style="width: 80px;">IVA</th>
                                    <th style="width: 180px;">SUBTOTAL</th>
                                    <th style="width: 10px;">QUITAR</th>
                                </thead>
                                <tbody id="detalle_factura">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Totales y Operaciones -->
                    <div class="row mt-2 border rounded m-0">
                        <div class="col-3 mt-2 mb-2">
                            <label for="iva0">Excentas</label>
                            <input type="text" name="iva0" id="iva0" class="form-control bg-warning fw-bold text-end" value="0" readonly>
                        </div>
                        <div class="col-3 mt-2 mb-2">
                            <label for="iva5">Iva 5%</label>
                            <input type="text" name="iva5" id="iva5" class="form-control bg-warning fw-bold text-end" value="0" readonly>
                        </div>
                        <div class="col-3 mt-2 mb-2">
                            <label for="iva10">Iva 10%</label>
                            <input type="text" name="iva10" id="iva10" class="form-control bg-warning fw-bold text-end" value="0" readonly>
                        </div>
                        <div class="col-3 mb-2 mt-2 mb-2">
                            <label for="total">Total</label>
                            <input type="text" name="total" id="total" class="form-control bg-warning fw-bold text-end" value="0" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-2">
                            <button type="button" class="btn btn-primary guardar" onclick="guardarCompra()"><i class="bi bi-sd-card"></i> Guardar</button>
                        </div>
                        <div class="col-8 fs-5 mt-2 text-center">
                            F2: Buscador de proveedores | F4: Buscador de artículos
                        </div>
                        <div class="col-2 text-end">
                            <a href="#" type="button" class="btn btn-secondary cerrar"><i class="bi bi-x-square"></i> Cerrar</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <input type="hidden" name="id_art" id="id_art" class="form-control">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="id_marca" id="id_marca" class="form-control">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="id_prov" id="id_prov" class="form-control">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="id_iva" id="id_iva" class="form-control">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="iva" id="iva" class="form-control">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="id_compra" id="id_compra">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="precio_compra" id="precio_compra">
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="precio_venta" id="precio_venta">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buscador de Proveedores -->
    <div class="modal fade" id="buscadorProveedores" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_modal">Buscador de Proveedores</h5>
                    <button type="button" class="btn-close closeProv" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="datos_proveedores" class="table table-bordered table-hover w-100">
                                <thead>
                                    <th class="text-center">RUC</th>
                                    <th class="text-center">RAZÓN SOCIAL</th>
                                    <th class="text-center">CIUDAD</th>
                                    <th class="text-center">DIRECCIÓN</th>
                                    <th class="text-center">TELÉFONO</th>
                                    <th class="text-center" style="width: 5px;">ENVIAR</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buscador de Articulos -->
    <div class="modal fade" id="buscadorArticulos" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_modal">Buscador de Artículos</h5>
                    <button type="button" class="btn-close closeArt" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="datos_articulos" class="table table-bordered table-hover w-100">
                                <thead>
                                    <th class="text-center">CODIGO</th>
                                    <th class="text-center">DESCRIPCIÓN</th>
                                    <th class="text-center">MARCA</th>
                                    <th class="text-center">IVA</th>
                                    <th class="text-center">PRECIO</th>
                                    <th class="text-center" style="width: 1px;">ENVIAR</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

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
    cargarProveedores();
    cargarArticulos();
    generarIdCompra();
    $(document).on('click', '.inicio', function() {
        location.href = '../../menu.html'
    })
</script>

</html>