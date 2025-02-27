<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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
                    <h3 class="text-center text-white">Clientes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datos_clientes" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">C.I O RUC</th>
                                    <th class="text-center">NOMBRE O RAZÓN SOCIAL</th>
                                    <th class="text-center">CIUDAD</th>
                                    <th class="text-center">DIRECCIÓN</th>
                                    <th class="text-center">TELÉFONO</th>
                                    <th class="text-center">SEXO</th>
                                    <th class="text-center">EDAD</th>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalClientes" name="btnNuevo" id="btnNuevo"><i class="bi bi-plus-square"></i>
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

    <!-- Modal Insertar - Modificar - Cliente -->
    <div class="modal fade" id="modalClientes" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered fixed-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form_clientes" enctype="multipart/form-data">
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
                                        <input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="sexo">Sexo</label>
                                        <select name="sexo" id="sexo" class="form-select">
                                            <option value="">Seleccione el sexo</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="f_nacimiento">Fecha de Nacimiento</label>
                                        <input type="date" name="f_nacimiento" id="f_nacimiento" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_cliente" id="id_cliente">
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
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="../../js/funciones.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        verificarSesion();
        $(document).ready(function() {
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
                $('#form_clientes')[0].reset();
                $('.modal-title').text("Nuevo Cliente");
                $('#action').val("Guardar");
                $('#check').val("Guardar");
                $('#operacion').val("Nuevo");
                $("#ruc").prop('disabled', false);
                $('#ruc').focus();
            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            // Registrar Cliente
            $(document).on('submit', '#form_clientes', function(event) {
                event.preventDefault();
                $("#razon").val($("#razon").val().toUpperCase());
                $("#direccion").val($("#direccion").val().toUpperCase());
                if ($('#ruc').val() == "") {
                    $('#ruc').focus();
                    showMessage("INGRESE EL RUC O C.I DEL CLIENTE.!!!", "warning", 1000);
                    return false;
                } else if ($('#razon').val() == "") {
                    $('#razon').focus();
                    showMessage("INGRESE EL NOMBRE O LA RAZON SOCIAL DEL CLIENTE.!!!", "warning", 1000);
                    return false;
                } else if ($('#ciudad').val() == "") {
                    $('#ciudad').focus();
                    showMessage("SELECCIONE UNA CIUDAD.!!!", "warning", 1000);
                    return false;
                } else if ($('#direccion').val() == "") {
                    $('#direccion').focus();
                    showMessage("INGRESE LA DIRECCIÓN DEL CLIENTE.!!!", "warning", 1000);
                    return false;
                } else if ($('#telefono').val() == "") {
                    $('#telefono').focus();
                    showMessage("INGRESE EL NÚMERO DE TELEFONO DEL CLIENTE.!!!", "warning", 1000);
                    return false;
                } else if ($('#sexo').val() === "") {
                    $('#sexo').focus();
                    showMessage("SELECCIONE EL SEXO DEL CLIETE.!!!", "warning", 1000);
                    return false;
                } else if ($('#f_nacimiento').val() == "") {
                    $('#fecha_nac').focus();
                    showMessage("INGRESE LA FECHA DE NACIMIENTO DEL CLIENTE.!!!", "warning", 1000);
                    return false;
                } else {
                    $.ajax({
                        url: '../../funciones_php/clientes/guardar_cliente.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            if (json.exito == false) {
                                $("#ruc").focus();
                                $("#ruc").val("");
                                showMessage(json.mensaje, json.icono, 1500);
                                return false;
                            } else {
                                showMessage(json.mensaje, json.icono, 1500);
                                $('.alta_mod').click();
                                clientes.ajax.reload();
                            }
                        }
                    });
                }
            });
            // Modificar Cliente
            $(document).on('click', '.editar', function() {
                var id_cliente = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/clientes/obtener_cliente.php",
                    method: 'POST',
                    data: {
                        id_cliente: id_cliente
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#modalClientes').modal('show');
                        $('.modal-title').text("Modificar Cliente");
                        $('#action').val("Actualizar");
                        $('#check').val("Actualizar");
                        $('#operacion').val("Editar");
                        $('#id_cliente').val(id_cliente);
                        $("#ruc").val(data.ruc);
                        $("#razon").val(data.razon_social);
                        $("#ciudad").val(data.id_ciudad);
                        $("#direccion").val(data.direccion);
                        $("#telefono").val(data.telefono);
                        $("#sexo").val(data.sexo);
                        $("#f_nacimiento").val(data.f_nacimiento);
                    }
                });
            });
            // Eliminar Cliente
            $(document).on('click', '.borrar', function() {
                var id_cliente = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/clientes/obtener_cliente.php",
                    method: "POST",
                    data: {
                        id_cliente: id_cliente
                    },
                    dataType: "json",
                    success: function(data) {
                        razon = data.razon_social;
                        Swal.fire({
                            title: 'Esta seguro de eliminar este cliente?\n\n' + razon + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/clientes/eliminar_cliente.php",
                                    method: "POST",
                                    data: {
                                        id_cliente: id_cliente
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        showMessage(data.mensaje, data.icono, data.timer);
                                        clientes.ajax.reload();
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