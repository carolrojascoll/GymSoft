<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
                    <h3 class="text-center text-white">Usuarios</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive w-100">
                        <table id="datos_usuarios" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">id e</th>
                                    <th class="text-center">EMPLEADO</th>
                                    <th class="text-center">ROL</th>
                                    <th class="text-center">CORREO</th>
                                    <th class="text-center">IMAGEN</th>
                                    <th class="text-center">USUARIO</th>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUsuarios" name="btnNuevo" id="btnNuevo"><i class="bi bi-plus-square"></i>
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

    <!-- Modal Insertar - Modificar - Usuario -->

    <div class="modal fade" id="modalUsuarios" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog fixed-top modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close alta_mod" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_usuarios" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="ruc">C.I o Ruc</label>
                                        <input type="text" name="ruc" id="ruc" class="form-control" autocomplete="off" onkeypress="return validar_ruc(event)" oninput="this.value= solo_numeros_ruc(this.value)">
                                    </div>
                                    <div class="col-md-4 mt-4 text-center">
                                        <button type="button" class="btn btn-primary buscar" onclick="buscar_entrenador()">
                                            <i class="bi bi-search"></i> Buscar</button>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="entrenador">Empleado</label>
                                        <input type="text" name="entrenador" id="entrenador" class="form-control fw-bold text-uppercase" readonly>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="roles">Rol</label>
                                        <select name="roles" id="roles" class="form-select">
                                            <option value="">Seleccione un rol</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="correo">Correo</label>
                                        <input type="text" name="correo" id="correo" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="imagen_usuario">Seleccione una imagen</label>
                                        <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control" value="">
                                        <span id="imagen_subida"></span>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="usuario">Usuario</label>
                                        <input type="text" name="usuario" id="usuario" class="form-control" oninput="this.value= mayusculas_espacio(this.value)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="contrasena">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="contrasena" id="contrasena">
                                            <button class="btn btn-secondary" type="button" onclick="mostrarPassword('contrasena', 'pass')"><i class="bi bi-eye pass"></i></button>
                                        </div>
                                        <span class="text-danger fw-bold" id="error"></span>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="confirmar">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="confirmar" id="confirmar">
                                            <button class="btn btn-secondary" type="button" onclick="mostrarPassword('confirmar', 'conf')"><i class="bi bi-eye conf"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <input type="hidden" name="id_usuario" id="id_usuario">
                                        <input type="hidden" name="id_entrenador" id="id_entrenador">
                                        <input type="hidden" name="operacion" id="operacion">
                                        <input type="submit" name="action" id="action" class="btn btn-primary" hidden disabled>
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
            cargarGrilla();
            cargarComboRoles();
            siguienteCampo("#ruc", ".buscar", false);
            siguienteCampo("#correo", "#imagen_usuario", false);
            siguienteCampo("#image_usuario", "#usuario", false);
            siguienteCampo("#usuario", "#contrasena", false);
            siguienteCampo("#contrasena", "#confirmar", false);
            siguienteClick("#confirmar", "#check", false);
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
                $("#form_usuarios")[0].reset();
                $(".modal-title").text("Nuevo Usuario");
                $("#action").val("Guardar");
                $("#check").val("Guardar");
                $("#operacion").val("Nuevo");
                $("#imagen_subida").html("");
                $("#ruc").prop('disabled', false);
                $(".buscar").prop('disabled', false);
            });

            $(document).on('click', '.inicio', function() {
                location.href = '../../menu.html'
            })

            $(document).on('submit', '#form_usuarios', function(event) {
                event.preventDefault();
                var extension = $('#imagen_usuario').val().split('.').pop().toLowerCase();
                if ($("#entrenador").val() == "") {
                    $("#ruc").focus();
                    showMessage("EL CAMPO EMPLEADO NO DEBE QUEDAR VACIO.!!!", "warning", 1500);
                    return false;
                } else if ($("#roles").val() == "") {
                    showMessage("SELECCIONE UN ROL.!!!", "warning", 1500);
                    return false;
                } else if ($("#correo").val() == "") {
                    $("#correo").focus();
                    showMessage("INGRESE UN CORREO.!!!", "warning", 1500);
                    return false;
                } else if (validarCorreo($("#correo").val()) == false) {
                    $("#correo").focus();
                    showMessage("INGRESE UN CORREO VALIDO.!!!", "warning", 1500);
                    return false;
                } else if ($("#imagen_usuario").val() == "") {
                    $("#imagen_usuario").focus();
                    $("#imagen_usuario").click();
                    showMessage("SELECCIONE UNA IMAGEN.!!!", "warning", 1500);
                    return false;
                } else if (jQuery.inArray($('#imagen_usuario').val().split('.').pop().toLowerCase(),
                        ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $('#imagen_usuario').focus();
                    showMessage("FORMATO DE IMAGEN INVÁLIDO.!!!", "warning", 1500);
                    $('#imagen_usuario').val('');
                    return false;
                } else if ($("#usuario").val() == "") {
                    showMessage("INGRESE UN USUARIO.!!!", "warning", 1500);
                    return false;
                } else if (validar_contrasenha($("#contrasena").val(), "error") == false) {
                    $("#contrasena").focus();
                    return false;
                } else if ($("#confirmar").val() == "") {
                    $("#confirmar").focus();
                    showMessage("CONFIRME SU CONTRASEÑA.!!!", "warning", 1500);
                    return false
                } else if ($("#confirmar").val() != $("#contrasena").val()) {
                    showMessage("LAS CONTRASEÑAS NO COINCIDEN.!!!", "warning", 1500);
                    return false;
                } else {
                    // activar();
                    $("#entrenador").val($("#entrenador").val().toLowerCase());
                    $.ajax({
                        url: '../../funciones_php/usuarios/guardar_usuario.php',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(json) {
                            if (json.exito == false) {
                                $("#usuario").focus();
                                $("#usuario").val("");
                                showMessage(json.mensaje, json.icono, 1500);
                                return false;
                            } else {
                                showMessage(json.mensaje, json.icono, 1500);
                                $(".alta_mod").click();
                                usuarios.ajax.reload();
                            }
                        }
                    })
                }
            });

            // Modificar Usuario

            $(document).on('click', '.editar', function() {
                var id_usuario = $(this).attr("id");
                $.ajax({
                    url: '../../funciones_php/usuarios/obtener_usuario.php',
                    method: 'POST',
                    data: {
                        id_usuario: id_usuario
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#modalUsuarios").modal('show');
                        $(".modal-title").text("Modificar Usuario");
                        $("#action").val("Actualizar");
                        $("#check").val("Actualizar");
                        $("#operacion").val("Editar");
                        $("#ruc").val(data.ruc_ci);
                        $("#entrenador").val(data.entrenador);
                        $("#roles").val(data.id_rol);
                        $("#correo").val(data.correo);
                        $("#imagen_subida").html(data.imagen_usuario);
                        $("#usuario").val(data.usuario);
                        $("#contrasena").val(data.contrasena);
                        $("#id_usuario").val(id_usuario);
                        $("#id_entrenador").val(data.id_entrenador);
                        $("#ruc").prop('disabled', true);
                        $(".buscar").prop('disabled', true);
                    }
                });
            });

            // Eliminar Usuario

            // Eliminar Cliente
            $(document).on('click', '.borrar', function() {
                var id_usuario = $(this).attr("id");
                $.ajax({
                    url: "../../funciones_php/usuarios/obtener_usuario.php",
                    method: "POST",
                    data: {
                        id_usuario: id_usuario
                    },
                    dataType: "json",
                    success: function(data) {
                        var usuario = data.entrenador;
                        Swal.fire({
                            title: 'Esta seguro de eliminar este usuario?\n\n' + usuario + '\n\n',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../../funciones_php/usuarios/eliminar_usuario.php",
                                    method: "POST",
                                    data: {
                                        id_usuario: id_usuario
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        showMessage(data.mensaje, data.icono, data.timer);
                                        usuarios.ajax.reload();
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