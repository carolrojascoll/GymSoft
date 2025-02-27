<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Contraseña</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body id="main">
    <div class="container w-50" id="principal">
        <div class="fondo bg-transparent border-0">
            <div class="card border-0">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Modificar Contraseña</h3>
                </div>
                <div class="card-body">
                    <form method="POST" id="form_modPassword" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="anterior">Contraseña Anterior</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="anterior" id="anterior"
                                                autofocus>
                                            <button class="btn btn-secondary" type="button"
                                                onclick="mostrarPassword('anterior', 'ant')"><i
                                                    class="bi bi-eye ant"></i></button>
                                        </div>
                                        <span class="text-danger fw-bold" id="errorAnterior"></span>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="contrasena">Nueva Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="contrasena"
                                                id="contrasena">
                                            <button class="btn btn-secondary" type="button"
                                                onclick="mostrarPassword('contrasena', 'pass')"><i
                                                    class="bi bi-eye pass"></i></button>
                                        </div>
                                        <span class="text-danger fw-bold" id="errorContrasena"></span>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="confirmar">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="confirmar" id="confirmar">
                                            <button class="btn btn-secondary" type="button"
                                                onclick="mostrarPassword('confirmar', 'con')"><i
                                                    class="bi bi-eye con"></i></button>
                                        </div>
                                        <span class="text-danger fw-bold" id="errorConfirmar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary guardar" onclick="modificar_password()"><i
                                    class="bi bi-save"></i> Guardar</button>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="../../menu.html" type="button" class="btn btn-secondary fs-6" id="btnCerrar"><i
                                    class="bi bi-x-square"></i> Cerrar</a>
                        </div>
                    </div>
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
    <script src="../../js/funciones.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        siguienteCampo("#anterior", "#contrasena", false);
        siguienteCampo("#contrasena", "#confirmar", false);
        siguienteClick("#confirmar", ".guardar", false);
    </script>

</body>