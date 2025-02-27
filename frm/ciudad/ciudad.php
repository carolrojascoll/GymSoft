<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/location.png" type="image/x-icon">
    <title>Ciudades</title>
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
            <div class="card border-0">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Ciudades</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datos_ciudades" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th style="width: 5px;" class="text-center">id</th>
                                    <th class="text-center">CIUDAD</th>
                                    <th style="width: 7px;" class="text-center">MODIFICAR</th>
                                    <th style="width: 7px;" class="text-center">BORRAR</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCiudades" id="btnNuevo"><i class="bi bi-plus-square"></i>
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

    <!-- Modal Insertar Ciudad -->
    <div class="modal fade" id="modalCiudades" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_ciudades">Crear Ciudad</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="form_ciudades" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" name="ciudad" id="ciudad" class="form-control text-uppercase" autofocus oninput="this.value = mayusculas_espacio(this.value);" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_ciudad" id="id_ciudad">
                            <input type="hidden" name="operacion" id="operacion">
                            <input type="submit" name="action" id="action" class="btn btn-primary" value="Crear">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Insertar Ciudad -->

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
            $("#btnNuevo").click(function() {
                $("#ciudad").focus();
                $("#form_ciudades")[0].reset();
                $("#titulo_ciudades").text("Nueva Ciudad");
                $("#action").val("Guardar");
                $("#operacion").val("Nuevo");
                $("#ciudad").focus();
            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            //Funcionalidad de Insercción

            $(document).on('submit', '#form_ciudades', function(event) {
                event.preventDefault();
                var ciudad = $('#ciudad').val().toUpperCase();
                $('#ciudad').val(ciudad);
                if (ciudad == "") {
                    $("#ciudad").focus();
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'INGRESE EL NOMBRE DE LA CIUDAD.!!!',
                        showConfirmButton: false,
                        timer: '1000'
                    })
                } else {
                    $.ajax({
                        url: '../../funciones_php/ciudades/guardar_ciudad.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            if (json.exito == false) {
                                $("#ciudad").val("");
                                $("#ciudad").focus();
                                showMessage(json.mensaje, json.icono, 1500);
                                return false;
                            } else {
                                showMessage(json.mensaje, json.icono, 1500);
                                $('.alta_mod').click();
                                ciudades.ajax.reload();
                            }
                        }
                    });
                }
            });

            // Funcionalidad de Modificar
            $(document).on('click', '.editar', function() {
                var id_ciudad = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/ciudades/obtenerCiudad.php",
                    method: "POST",
                    data: {
                        id_ciudad: id_ciudad
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#modalCiudades").modal('show');
                        $("#titulo_ciudades").text("Modificar Ciudad");
                        $("#ciudad").val(data.ciudad);
                        $("#id_ciudad").val(id_ciudad);
                        $("#action").val("Actualizar");
                        $("#operacion").val("Editar");
                    }
                });
            });

            // Funcionalidad de Eliminar
            $(document).on('click', '.borrar', function() {
                var id_ciudad = $(this).attr("id");
                var ciudad = "";
                $.ajax({
                    url: "../../funciones_php/ciudades/obtenerCiudad.php",
                    method: "POST",
                    data: {
                        id_ciudad: id_ciudad
                    },
                    dataType: "json",
                    success: function(data) {
                        ciudad = data.ciudad;
                        Swal.fire({
                            title: 'Esta seguro de eliminar esta ciudad?\n\n' + ciudad + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/ciudades/eliminarCiudad.php",
                                    type: "POST",
                                    data: {
                                        id_ciudad: id_ciudad
                                    },
                                    dataType: 'json',
                                    success: function(json) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: json.icono,
                                            title: json.mensaje,
                                            showConfirmButton: false,
                                            timer: json.timer

                                        })
                                        ciudades.ajax.reload();
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