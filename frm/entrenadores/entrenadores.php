<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrenadores</title>
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
                    <h3 class="text-center text-white">Entrenadores</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datos_entrenadores" class="table table-bordered table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">C.I O RUC</th>
                                    <th class="text-center">NOMBRE Y APELLIDO</th>
                                    <th class="text-center">CIUDAD</th>
                                    <th class="text-center">DIRECCIÓN</th>
                                    <th class="text-center">TELÉFONO</th>
                                    <th class="text-center">SEXO</th>
                                    <th class="text-center">EDAD</th>
                                    <th class="text-center">SUELDO</th>
                                    <th class="text-center">HT</th>
                                    <th style="width: 7px;" class="text-center">EDITAR</th>
                                    <th style="width: 7px;" class="text-center">BORRAR</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEntrenadores" name="btnNuevo" id="btnNuevo"><i class="bi bi-plus-square"></i>
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

    <!-- Modal Insertar - Modificar - Entrenador -->

    <div class="modal fade" id="modalEntrenadores" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-bottom modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_entrenadores" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="codigo" id="codigo" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="ruc">C.I o Ruc</label>
                                        <input type="text" name="ruc" id="ruc" class="form-control" autocomplete="off" onkeypress="return validar_ruc(event)" oninput="this.value= solo_numeros_ruc(this.value)">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control text-uppercase" oninput="this.value= mayusculas_espacio(this.value)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control text-uppercase" oninput="this.value= mayusculas_espacio(this.value)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="ciudad">Ciudad</label>
                                        <select name="ciudad" id="ciudad" class="form-select">
                                            <option value="">Seleccione una ciudad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control text-uppercase" oninput="this.value= mayusculas_espacio(this.value)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="sexo">Sexo</label>
                                        <select name="sexo" id="sexo" class="form-select">
                                            <option value="">Seleccione el sexo</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="fecha_nac">Fecha de Nacimiento</label>
                                        <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="sueldo_bruto">Suedo Bruto</label>
                                        <input type="text" name="sueldo_bruto" id="sueldo_bruto" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="horas_trabajo">Horas de Trabajo</label>
                                        <input type="text" name="horas_trabajo" id="horas_trabajo" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-end">
                                        <input type="hidden" name="id_entrenador" id="id_entrenador">
                                        <input type="hidden" name="operacion" id="operacion">
                                        <input type="submit" id="action" class="btn btn-primary" value="" hidden disabled>
                                        <input type="button" name="check" id="check" class="btn btn-primary" onclick="activar()">
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
    <script src="../../js/funciones.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        $(document).ready(function() {
            verificarSesion();
            cargarComboCiudades();
            cargarTabla();
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
                $('#form_entrenadores')[0].reset();
                $('.modal-title').text("Nuevo Entrenador");
                $('#action').val("Guardar");
                $('#check').val("Guardar");
                $('#operacion').val("Nuevo");
                $("#ruc").prop('disabled', false);
                $('#ruc').focus();
            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            // Registrar Entrenador
            $(document).on('submit', '#form_entrenadores', function(event) {
                event.preventDefault();
                if ($('#ruc').val() == "") {
                    $('#ruc').focus();
                    showMessage("INGRESE EL RUC O C.I.!!!", "warning", 1000);
                    return false;
                } else if ($('#nombre').val() == "") {
                    $('#nombre').focus();
                    showMessage("INGRESE EL NOMBRE.!!!", "warning", 1000);
                    return false;
                } else if ($('#apellido').val() == "") {
                    $('#apellido').focus();
                    showMessage("INGRESE EL APELLIDO.!!!", "warning", 1000);
                    return false;
                } else if ($('#ciudad').val() == "") {
                    $('#ciudad').focus();
                    showMessage("SELECCIONE UNA CIUDAD.!!!", "warning", 1000);
                    return false;
                } else if ($('#direccion').val() == "") {
                    $('#direccion').focus();
                    showMessage("INGRESE DIRECCIÓN.!!!", "warning", 1000);
                    return false;
                } else if ($('#telefono').val() == "") {
                    $('#telefono').focus();
                    showMessage("INGRESE EL NÚMERO DE TELEFONO.!!!", "warning", 1000);
                    return false;
                } else if ($('#sexo').val() === "") {
                    $('#sexo').focus();
                    showMessage("SELECCIONE EL SEXO.!!!", "warning", 1000);
                    return false;
                } else if ($('#fecha_nac').val() == "") {
                    $('#fecha_nac').focus();
                    showMessage("INGRESE LA FECHA DE NACIMIENTO.!!!", "warning", 1000);
                    return false;
                } else if ($("#sueldo_bruto").val() == "") {
                    $("#sueldo_bruto").focus();
                    showMessage("INGRESE EL SUELDO BRUTO DEL ENTRENADOR.!!!", "warning", 1000);
                    return false;
                } else if ($("#horas_trabajo").val() == "") {
                    $("#sueldo_bruto").focus();
                    showMessage("INGRESE LA CANTIDAD DE HORAS DE TRABAJO.!!!", "warning", 1000);
                    return false;
                } else {
                    $('#nombre').val($('#nombre').val().toUpperCase());
                    $('#apellido').val($('#apellido').val().toUpperCase());
                    $('#direccion').val($('#direccion').val().toUpperCase());
                    $.ajax({
                        url: '../../funciones_php/entrenadores/guardar_entrenador.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            if (json.exito == false) {
                                $(json.focus).focus();
                                $(json.focus).val("");
                                showMessage(json.mensaje, json.icono, 1500);
                                return false;
                            } else {
                                showMessage(json.mensaje, json.icono, 1500);
                                $('.alta_mod').click();
                                entrenadores.ajax.reload();
                            }
                        }
                    });
                }

            });

            // Modificar Entrenador
            $(document).on('click', '.editar', function() {
                var id_entrenador = $(this).attr('id');
                $.ajax({
                    url: '../../funciones_php/entrenadores/obtener_entrenador.php',
                    method: 'POST',
                    data: {
                        id_entrenador: id_entrenador
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#modalEntrenadores").modal('show');
                        $(".modal-title").text('Modificar Entrenador');
                        $("#action").val("Actualizar");
                        $('#check').val("Actualizar");
                        $("#operacion").val("Modificar");
                        $("#id_entrenador").val(id_entrenador);
                        $("#ruc").val(data.ruc_ci);
                        $("#nombre").val(data.nombre);
                        $("#apellido").val(data.apellido);
                        $("#ciudad").val(data.id_ciudad);
                        $("#direccion").val(data.direccion);
                        $("#telefono").val(data.telefono);
                        $("#sexo").val(data.sexo);
                        $("#fecha_nac").val(data.fecha_nac);
                        $("#sueldo_bruto").val(data.sueldo_bruto);
                        $("#horas_trabajo").val(data.horas_trabajo);
                    }
                });
            });

            // Eliminar Entrenador
            $(document).on('click', '.borrar', function() {
                var id_entrenador = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/entrenadores/obtener_entrenador.php",
                    method: "POST",
                    data: {
                        id_entrenador: id_entrenador
                    },
                    dataType: "json",
                    success: function(data) {
                        nombre = data.nombre + " " + data.apellido;
                        $("#id_entrenador").val(id_entrenador);
                        Swal.fire({
                            title: 'Esta seguro de eliminar este entrenador?\n\n' + nombre + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/entrenadores/eliminar_entrenador.php",
                                    method: "POST",
                                    data: {
                                        id_entrenador: id_entrenador
                                    },
                                    dataType: 'json',
                                    success: function(json) {
                                        showMessage(json.mensaje, json.icono, json.timer);
                                        entrenadores.ajax.reload();
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