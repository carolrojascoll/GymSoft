<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
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
            <div class="card border-0 rounded">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Marcas</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <table id="datos_marcas" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;" class="text-center">id</th>
                                        <th class="text-center">MARCA</th>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMarcas" id="btnNuevo"><i class="bi bi-plus-square"></i>
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
    <div class="modal fade" id="modalMarcas" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog w-50 fixed-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_marcas">Crear Marca</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="form_marcas" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="marca">Marca</label>
                                    <input type="text" name="marca" id="marca" class="form-control text-uppercase" autofocus oninput="this.value = mayusculas_espacio(this.value);" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" name="id_marca" id="id_marca">
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
        $(document).ready(function() {
            verificarSesion();
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
                $("#marca").focus();
                $("#form_marcas")[0].reset();
                $("#titulo_marcas").text("Nueva Marca");
                $("#action").val("Guardar");
                $("#operacion").val("Nuevo");
                $("#ciudad").focus();

            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            //Funcionalidad de Insercción

            $(document).on('submit', '#form_marcas', function(event) {
                event.preventDefault();
                var marca = $('#marca').val().toUpperCase();
                $('#marca').val(marca);
                if (marca == "") {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'INGRESE EL NOMBRE DE LA MARCA.!!!',
                        showConfirmButton: false,
                        timer: '1000'
                    })
                } else {
                    $.ajax({
                        url: '../../funciones_php/marcas/guardar_marca.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            if (json.exito == false) {
                                $("#marca").val("");
                                $("#marca").focus();
                                showMessage(json.mensaje, json.icono, 1500);
                                return false;
                            } else {
                                showMessage(json.mensaje, json.icono, 1500);
                                $('.alta_mod').click();
                                marcas.ajax.reload();
                            }
                        }
                    });

                }
            });

            // Funcionalidad de Modificar
            $(document).on('click', '.editar', function() {
                var id_marca = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/marcas/obtener_marca.php",
                    method: "POST",
                    data: {
                        id_marca: id_marca
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#modalMarcas").modal('show');
                        $("#titulo_marcas").text("Modificar Marca");
                        $("#marca").val(data.marca);
                        $("#id_marca").val(id_marca);
                        $("#action").val("Actualizar");
                        $("#operacion").val("Editar");
                    }
                });
            });

            // Funcionalidad de Eliminar
            $(document).on('click', '.borrar', function() {
                var id_marca = $(this).attr("id");
                var marca = "";
                $.ajax({
                    url: "../../funciones_php/marcas/obtener_marca.php",
                    method: "POST",
                    data: {
                        id_marca: id_marca
                    },
                    dataType: "json",
                    success: function(data) {
                        marca = data.marca;
                        Swal.fire({
                            title: 'Esta seguro de eliminar esta marca?\n\n' + marca + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/marcas/eliminar_marca.php",
                                    type: "POST",
                                    data: {
                                        id_marca: id_marca
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
                                        marcas.ajax.reload();
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