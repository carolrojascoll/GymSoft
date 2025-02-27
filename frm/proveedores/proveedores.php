<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
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
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="card-title">Proveedores</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="datos_proveedores">
                        <thead>
                            <tr>
                                <th class="text-center">id</th>
                                <th class="text-center">RUC</th>
                                <th class="text-center">NOMBRE O RAZÓN SOCIAL</th>
                                <th class="text-center">DIRECCIÓN</th>
                                <th class="text-center">CIUDAD</th>
                                <th class="text-center">TELÉFONO</th>
                                <th class="text-center" style="width: 5px;">MODIFICAR</th>
                                <th class="text-center" style="width: 5px;">ELIMINAR</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProveedores" id="btnNuevo"><i class="bi bi-plus-square"></i>
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

    <!-- Modal Insertar - Modificar - Proveedor  -->
    <div class="modal fade" id="modalProveedores" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable fixed-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form_proveedores" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="ruc">C.I o Ruc</label>
                                        <input type="text" name="ruc" id="ruc" class="form-control" autocomplete="off" onkeypress="return validar_ruc(event)" oninput="this.value= solo_numeros_ruc(this.value)">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="razon">Nombre o Razón Social</label>
                                        <input type="text" name="razon" id="razon" class="form-control" autocomplete="off" oninput="this.value= mayusculas_espacio(this.value)">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="ciudad">Ciudad</label>
                                        <select name="ciudad" id="ciudad" class="form-select">
                                            <option value="">Seleccione una ciudad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control" maxlength="80" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_proveedor" id="id_proveedor">
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

    <!-- Scripts -->
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
            cargarTabla();
            cargarComboCiudades();
            user_logueado();
            $("#sesion").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded-circle" width="60px" height="50" />');
            $("#acerca_de").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded" width="300px" height="280" />');
            $("#-nombre").html(localStorage.nombre);
            $("#-ciudad").html(localStorage.ciudad);
            $("#-direccion").html(localStorage.direccion);
            $("#-telefono").html(localStorage.telefono);
            $("#-edad").html(localStorage.edad);
            $("#-rol").html(localStorage.rol);
            $('#btnNuevo').click(function() {
                $('#form_proveedores')[0].reset();
                $('.modal-title').text("Nuevo Proveedor");
                $('#action').val("Guardar");
                $('#check').val("Guardar");
                $('#operacion').val("Nuevo");
                $("#ruc").prop('disabled', false);
                $('#ruc').focus();
            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })
            // Registrar Proveedor
            $(document).on('submit', '#form_proveedores', function(event) {
                event.preventDefault();
                if ($('#ruc').val() == "") {
                    showMessage(json.mensaje, json.icono, 1500);
                    $('#ruc').focus();
                    return false;
                } else if ($('#razon').val() == "") {
                    $('#razon').focus();
                    showMessage(json.mensaje, json.icono, 1500);
                    return false;
                } else if ($('#ciudad').val() == "") {
                    $('#ciudad').focus();
                    showMessage(json.mensaje, json.icono, 1500);
                    return false;
                } else {

                    $("#razon").val($("#razon").val().toUpperCase());
                    if ($("#direccion").val() == "" || $("#telefono").val() == "") {
                        $("#direccion").val("POR COMPLETAR");
                        $("#telefono").val("POR COMPLETAR");
                    } else {
                        $("#direccion").val($("#direccion").val().toUpperCase());
                    }
                    $.ajax({
                        url: '../../funciones_php/proveedores/guardar_proveedor.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            showMessage(json.mensaje, json.icono, 1500);
                            if (json.exito == false) {
                                $(json.focus).focus();
                                $(json.focus).val("");
                                return false;
                            } else {
                                $('.alta_mod').click();
                                proveedores.ajax.reload();
                            }
                        }
                    });

                }

            });

            // Modificar Proveedor

            $(document).on('click', '.editar', function() {

                var id_proveedor = $(this).attr("id");

                $.ajax({

                    url: "../../funciones_php/proveedores/obtener_proveedor.php",
                    method: 'POST',
                    data: {
                        id_proveedor: id_proveedor
                    },
                    dataType: 'json',
                    success: function(data) {

                        $('#modalProveedores').modal('show');
                        $('.modal-title').text("Modificar Proveedor");
                        $('#action').val("Actualizar");
                        $('#check').val("Actualizar");
                        $('#operacion').val("Editar");
                        $('#id_proveedor').val(id_proveedor);
                        $("#ruc").val(data.ruc);
                        // $("#ruc").prop('disabled', true);
                        $("#razon").val(data.razon_social);
                        $("#ciudad").val(data.id_ciudad);
                        $("#direccion").val(data.direccion);
                        $("#telefono").val(data.telefono);

                    }

                });

            });

            // Eliminar Proveedor
            $(document).on('click', '.borrar', function() {
                var id_proveedor = $(this).attr("id");
                var ciudad = "";
                $.ajax({
                    url: "../../funciones_php/proveedores/obtener_proveedor.php",
                    method: "POST",
                    data: {
                        id_proveedor: id_proveedor
                    },
                    dataType: "json",
                    success: function(data) {
                        razon = data.razon_social;
                        Swal.fire({
                            title: 'Esta seguro de eliminar este proveedor?\n\n' + razon + '\n\n',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/proveedores/eliminar_proveedor.php",
                                    method: "POST",
                                    data: {
                                        id_proveedor: id_proveedor
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: data.icono,
                                            title: data.mensaje,
                                            showConfirmButton: false,
                                            timer: '1000'
                                        })
                                        proveedores.ajax.reload();
                                    }
                                });
                            }
                        })
                    }
                });

            });

        });
    </script>

</body>

</html>