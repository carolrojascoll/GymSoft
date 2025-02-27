<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutina de Ejercicios</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../css/toastr.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body id="main">
    <?php include("../header.php") ?>
    <div class="container">
        <div class="fondo bg-transparent">
            <div class="card border-0">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Registrar Rutina de Ejercicios</h3>
                </div>
                <div class="card-body">
                    <form id="form_rutinas">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="descripcion">Descripción</label>
                                <input name="descripcion" id="descripcion" class="form-control" placeholder="Rutina de..." oninput="this.value = mayusculas_espacio(this.value)" maxlength="80">
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="id_rutina" id="id_rutina" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="ejercicios">Ejercicio</label>
                                <select name="ejercicios" id="ejercicios" class="form-select">
                                    <option value="" id="selec">Seleccione un ejercicio</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="series">Series</label>
                                <input type="text" name="series" id="series" class="form-control text-end" oninput="this.value = solo_numeros(this.value)" maxlength="2">
                            </div>
                            <div class="col-md-2">
                                <label for="repeticiones">Repeticiones</label>
                                <input type="text" name="repeticiones" id="repeticiones" class="form-control text-end" oninput="this.value = solo_numeros(this.value)" maxlength="2">
                            </div>
                            <div class="col-3 mt-4 text-center">
                                <button type="button" class="btn btn-success" id="btnAdd" onclick="agregarEjercicio()">
                                    <i class="bi bi-plus-square"></i> Agregar</button>
                                <button type="button" class="btn btn-danger" id="btnCancelar" onclick="cancelar()">
                                    <i class="bi bi-x-square"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="fondo bg-transparent">
            <div class="card border-0">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Ejercicios</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datos_rutinas" class="table table-bordered table-striped">
                            <thead>
                                <th hidden class="text-center">id Ejercicio</th>
                                <th class="text-center" style="width: 25px;">#</th>
                                <th class="text-center">EJERCICIO</th>
                                <th style="width: 5px;" class="text-center">SERIES</th>
                                <th style="width: 5px;" class="text-center">REPETICIONES</th>
                                <th style="width: 7px;" class="text-center">QUITAR</th>
                            </thead>
                            <tbody id="datos_ejercicios">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" id="btnGuardar" onclick="guardar_rutina()"><i class="bi bi-plus-square"></i>
                                Guardar</button>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="#" class="btn btn-secondary" onclick = "salir()">
                                <i class="bi bi-x-square"></i> Salir</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../datatables/datatables.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="../../js/funciones.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        $(document).ready(function() {
            user_logueado();
            $("#sesion").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded-circle" width="60px" height="50" />');
            $("#acerca_de").html('<img src="../../img/usuarios/' + localStorage.imagen + '"  class="rounded" width="300px" height="280" />');
            $("#-nombre").html(localStorage.nombre);
            $("#-ciudad").html(localStorage.ciudad);
            $("#-direccion").html(localStorage.direccion);
            $("#-telefono").html(localStorage.telefono);
            $("#-edad").html(localStorage.edad);
            $("#-rol").html(localStorage.rol);
        });
    </script>