<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos</title>
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
            <div class="card border-0 rounded">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Artículos</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datos_articulos" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">CÓDIGO</th>
                                    <th class="text-center">DESCRIPCIÓN</th>
                                    <th class="text-center">MARCA</th>
                                    <th class="text-center">IVA</th>
                                    <th class="text-center">STOCK ACT.</th>
                                    <th class="text-center">P. COMPRA</th>
                                    <th class="text-center">% GANANCIA</th>
                                    <th class="text-center">P. VENTA</th>
                                    <th style="width: 5px;" class="text-center">MODIFICAR</th>
                                    <th style="width: 5px;" class="text-center">BORRAR</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArticulos" name="btnNuevo" id="btnNuevo"><i class="bi bi-plus-square"></i>
                                Nuevo</button>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="../../menu.html" type="button" class="btn btn-secondary fs-6" id="btnCerrar"><i class="bi bi-x-square"></i> Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Insertar - Modificar - Articulo -->
    <div class="modal fade" id="modalArticulos" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-bottom modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form_Articulos" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="codigo">Código</label>
                                        <input type="text" name="codigo" id="codigo" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="marcas">Marca</label>
                                        <select name="marcas" id="marcas" class="form-select">
                                            <option value="">Seleccione una marca</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" name="descripcion" id="descripcion" class="form-control text-uppercase" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="iva">Iva</label>
                                        <select name="iva" id="iva" class="form-select">
                                            <option value="">Selecione el iva</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="stock">Stock Actual</label>
                                        <input type="text" name="stock" id="stock" class="form-control" oninput="this.value= solo_numeros(this.value)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="p_compra">Precio de Compra</label>
                                        <input type="text" name="p_compra" id="p_compra" class="form-control" autocomplete="off" onkeyup="calcular_porcentaje();">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="p_venta">Precio de Venta</label>
                                        <input type="text" name="p_venta" id="p_venta" class="form-control" autocomplete="off" onkeyup="calcular_porcentaje();">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="porcent">% de Ganancia</label>
                                        <input type="text" name="porcent" id="porcent" class="form-control" autocomplete="off" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_articulo" id="id_articulo">
                                <input type="hidden" name="operacion" id="operacion">
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Crear" hidden disabled>
                                <input type="button" name="check" id="check" class="btn btn-primary" onclick="activar()">
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
            verificarSesion();
            cargarGrilla();
            cargar_marcas();
            cargar_iva();
            user_logueado();
            $("#sesion").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded-circle" width="60px" height="50" />');
            $("#acerca_de").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="img-thumbnail" width="300px" height="280" />');
            $("#-nombre").html(localStorage.nombre);
            $("#-ciudad").html(localStorage.ciudad);
            $("#-direccion").html(localStorage.direccion);
            $("#-telefono").html(localStorage.telefono);
            $("#-edad").html(localStorage.edad);
            $("#-rol").html(localStorage.rol);
            $("#btnNuevo").click(function() {
                $(".modal-title").text("Nuevo Articulo");
                $("#form_Articulos")[0].reset();
                $("#action").val("Guardar");
                $("#check").val("Guardar");
                $("#operacion").val("Nuevo");
            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            $(document).on('submit', '#form_Articulos', function(event) {
                event.preventDefault();
                if ($("#codigo").val() == "") {
                    $("#codigo").focus();
                    showMessage("INGRESE UN CÓDIGO.!!!", "warning", 1000);
                    return false;
                } else if ($("#marcas").val() == "") {
                    $("#marcas").focus();
                    showMessage("SELECCIONE UNA MARCA.!!!", "warning", 1000);
                    return false;
                } else if ($("#descripcion").val() == "") {
                    $("#descripcion").focus();
                    showMessage("INGRESE UNA DESCRIPCIÓN.!!!", "warning", 1000);
                    return false;
                } else if ($("#iva").val() == "") {
                    $("#iva").focus();
                    showMessage("SELECCIONE EL IVA.!!!", "warning", 1000);
                    return false;
                } else if ($("#stock").val() == "") {
                    $("#stock").focus();
                    showMessage("INGRESE EL STOCK ACTUAL.!!!", "warning", 1000);
                    return false;
                } else if ($("#p_compra").val() == "") {
                    $("#p_compra").focus();
                    showMessage("INGRESE EL PRECIO DE COMPRA.!!!", "warning", 1000);
                    return false;
                } else if ($("#porcent").val() == "") {
                    $("#porcent").focus();
                    showMessage("INGRESE EL PORCENTAJE DE GANANCIA.!!!", "warning", 1000);
                    return false;
                } else {

                    $("#descripcion").val($("#descripcion").val().toUpperCase());
                    $("#p_compra").val($("#p_compra").val().replace(/\./g, ""));
                    $("#p_venta").val($("#p_venta").val().replace(/\./g, ""));

                    $.ajax({
                        url: '../../funciones_php/articulos/guardar_articulo.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {

                            if (json.exito == false) {
                                $(json.focus).focus();
                                $(json.focus).val("");
                                showMessage(json.mensaje, json.icono, json.timer);
                                return false;
                            } else {
                                showMessage(json.mensaje, json.icono, json.timer);
                                $('.alta_mod').click();
                                articulos.ajax.reload();
                            }
                        }
                    });
                }
            });

            // Modificar Artículo

            $(document).on('click', '.editar', function() {
                var id_articulo = $(this).attr("id");
                $.ajax({
                    url: '../../funciones_php/articulos/obtener_articulos.php',
                    method: 'POST',
                    data: {
                        id_articulo: id_articulo
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#modalArticulos').modal('show');
                        $('.modal-title').text("Modificar Artículo");
                        $('#action').val("Actualizar");
                        $('#check').val("Actualizar");
                        $('#operacion').val("Editar");
                        $('#codigo').val(data.codigo);
                        $('#marcas').val(data.marca);
                        $('#descripcion').val(data.descripcion);
                        $('#iva').val(data.iva);
                        $('#stock').val(data.stock);
                        $('#p_compra').val(data.p_compra);
                        $('#porcent').val(data.porcent);
                        $('#p_venta').val(data.p_venta);
                        $('#id_articulo').val(id_articulo);
                        $("#descripcion").val($("#descripcion").val().toUpperCase());
                        $("#codigo").val($("#codigo").val());
                    }
                });
            });


            // Eliminar Articulo
            $(document).on('click', '.borrar', function() {
                var id_articulo = $(this).attr('id');
                var articulo = "";
                $.ajax({
                    url: '../../funciones_php/articulos/obtener_descripcion.php',
                    method: 'POST',
                    data: {
                        id_articulo: id_articulo
                    },
                    dataType: 'json',
                    success: function(data) {
                        articulo = data.descripcion;
                        Swal.fire({
                            title: 'Esta seguro de eliminar este artículo?\n\n' + articulo + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/articulos/eliminar_articulo.php",
                                    type: "POST",
                                    data: {
                                        id_articulo: id_articulo
                                    },
                                    dataType: 'json',
                                    success: function(json) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: json.icono,
                                            title: json.mensaje,
                                            showConfirmButton: false,
                                            timer: json.timer
                                        });
                                    }
                                });
                                articulos.ajax.reload();
                            }
                        })
                    }
                });
            });

        });
    </script>
</body>

</html>