<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body id="main">
    <?php include("../header.php") ?>
    <div class="container" id="principal">
        <div class="fondo bg-transparent">
            <div class="card border-0">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Ejercicios</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <table id="datos_ejercicios" class="table table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;" class="text-center">id</th>
                                        <th class="text-center">EJERCICIOS</th>
                                        <th style="width: 7px;" class="text-center">MODIFICAR</th>
                                        <th style="width: 7px;" class="text-center">BORRAR</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEjercicios" id="btnNuevo"><i class="bi bi-plus-square"></i>
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

    <!-- Modal Insertar - Modificar Ejercicio -->

    <div class="modal fade" id="modalEjercicios" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ciudades">Crear Ejercicio</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="form_ejercicios" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="ejercicio">Ejercicio</label>
                                    <input type="text" name="ejercicio" id="ejercicio" class="form-control text-uppercase" autofocus oninput="this.value = mayusculas_espacio(this.value);" autocomplete="off">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <input type="hidden" name="id_ejercicio" id="id_ejercicio">
                            <input type="hidden" name="operacion" id="operacion">
                            <input type="submit" name="action" id="action" class="btn btn-primary" value="Crear">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
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
    verificarSesion();
    $(document).ready(function() {
        cargarGrilla();
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
            $('#form_ejercicios')[0].reset();
            $('.modal-title').text("Nuevo Ejercicio");
            $('#action').val("Guardar");
            $('#operacion').val("Nuevo");
        });

        $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

        //Insertar Ejercicio

        $(document).on('submit', '#form_ejercicios', function(event) {
            event.preventDefault();
            var ejercicio = $('#ejercicio').val().toUpperCase();
            $('#ejercicio').val(ejercicio);
            if (ejercicio != "") {

                $.ajax({
                    url: "../../funciones_php/ejercicios/guardar_ejercicio.php",
                    type: 'POST',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(json) {
                        if (json.exito == false) {
                            $("#ejercicio").val("");
                            $("#ejercicio").focus();
                            showMessage(json.mensaje, json.icono, 1500);
                            return false;
                        } else {
                            showMessage(json.mensaje, json.icono, 1500);
                            $('.alta_mod').click();
                            ejercicios.ajax.reload();
                        }
                    }
                });

            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'INGRESE EL NOMBRE DEL EJERCICIO.!!!',
                    showConfirmButton: false,
                    timer: '1000'
                })
            }

        });

        // Funcionalidad de Modificar

        $(document).on('click', '.editar', function() {
            var id_ejercicio = $(this).attr("id");
            $.ajax({
                url: "../../funciones_php/ejercicios/obtener_ejercicio.php",
                method: "POST",
                data: {
                    id_ejercicio: id_ejercicio
                },
                dataType: "json",
                success: function(data) {
                    $("#modalEjercicios").modal('show');
                    $(".modal-title").text("Modificar Ejercicio");
                    $("#ejercicio").val(data.ejercicio);
                    $("#id_ejercicio").val(id_ejercicio);
                    $("#action").val("Actualizar");
                    $("#operacion").val("Editar");
                }
            });
        });

        // Funcionalidad de Eliminar
        $(document).on('click', '.borrar', function() {
            var id_ejercicio = $(this).attr("id");
            var ejercicio = "";
            $.ajax({
                url: "../../funciones_php/ejercicios/obtener_ejercicio.php",
                method: "POST",
                data: {
                    id_ejercicio: id_ejercicio
                },
                dataType: "json",
                success: function(data) {
                    ejercicio = data.ejercicio;
                    Swal.fire({
                        title: 'Esta seguro de eliminar este ejercicio?\n\n' + ejercicio + '\n\n',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "../../funciones_php/ejercicios/eliminar_ejercicio.php",
                                method: "POST",
                                data: {
                                    id_ejercicio: id_ejercicio
                                },
                                dataType: 'json',
                                success: function(data) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: data.icono,
                                        title: data.mensaje,
                                        showConfirmButton: false,
                                        timer: data.timer
                                    })
                                    ejercicios.ajax.reload();
                                }
                            });
                        }
                    })
                }
            });

        });

    });
</script>