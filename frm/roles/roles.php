<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
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
                    <h3 class="text-center text-white">Roles</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <table id="datos_roles" class="table table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;" class="text-center">id</th>
                                        <th class="text-center">ROL</th>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRoles" id="btnNuevo"><i class="bi bi-plus-square"></i>
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
    <div class="modal fade" id="modalRoles" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog w-50">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="form_roles" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="rol">Rol</label>
                                    <input type="text" name="rol" id="rol" class="form-control text-uppercase" autofocus oninput="this.value = mayusculas_espacio(this.value);" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" name="id_rol" id="id_rol">
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
                $("#rol").focus();
                $("#form_roles")[0].reset();
                $(".modal-title").text("Nuevo Rol");
                $("#action").val("Guardar");
                $("#operacion").val("Nuevo");
                $("#rol").focus();

            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            //Funcionalidad de Insercción
            $(document).on('submit', '#form_roles', function(event) {
                event.preventDefault();
                var rol = $('#rol').val().toUpperCase();
                $('#rol').val(rol);
                if (rol == "") {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'INGRESE EL NOMBRE DEL ROL.!!!',
                        showConfirmButton: false,
                        timer: '1000'
                    })
                } else {

                    $.ajax({
                        url: '../../funciones_php/roles/guardar_rol.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            Swal.fire({
                                position: 'center',
                                icon: json.icono,
                                title: json.mensaje,
                                showConfirmButton: false,
                                timer: '1500'
                            })
                            if (json.registrado == false) {
                                $("#rol").val("");
                                $("#rol").focus();
                                return false;
                            } else {
                                $('.alta_mod').click();
                                roles.ajax.reload();
                            }
                        }
                    });

                }

            });

            // Funcionalidad de Modificar
            $(document).on('click', '.editar', function() {
                var id_rol = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/roles/obtener_rol.php",
                    method: "POST",
                    data: {
                        id_rol: id_rol
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#modalRoles").modal('show');
                        $(".modal-title").text("Modificar Rol");
                        $("#rol").val(data.rol);
                        $("#id_rol").val(id_rol);
                        $("#action").val("Actualizar");
                        $("#operacion").val("Editar");
                    }
                });
            });

            // Funcionalidad de Eliminar
            $(document).on('click', '.borrar', function() {
                var id_rol = $(this).attr("id");
                var rol = "";
                $.ajax({
                    url: "../../funciones_php/roles/obtener_rol.php",
                    method: "POST",
                    data: {
                        id_rol: id_rol
                    },
                    dataType: "json",
                    success: function(data) {
                        rol = data.rol;
                        Swal.fire({
                            title: 'Esta seguro de eliminar este rol?\n\n' + rol + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/roles/eliminar_rol.php",
                                    type: "POST",
                                    data: {
                                        id_rol: id_rol
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
                                        roles.ajax.reload();
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