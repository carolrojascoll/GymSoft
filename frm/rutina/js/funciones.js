function cargarCombo() {
    $.ajax({
        type: 'POST',
        url: '../../funciones_php/rutinas/combo_ejercicios.php',
        dataType: 'json',
        success: function (json) {
            $.each(json, function (i, obj) {
                $('#ejercicios').append($('<option>').text(obj.ejercicio).attr('value', obj.id_ejercicio));
            });
        }
    });
}

siguienteCampo($("#series"), $("#repeticiones"), false);
siguienteClick($("#repeticiones"), $("#btnAdd"), false);
$("#descripcion").focus();

function mostrarIdRutina() {
    $.ajax({
        url: '../../funciones_php/rutinas/obtener_id_rutina.php',
        type: 'POST',
        data: {},
        dataType: 'json',
        success: function (json) {
            $("#id_rutina").val(json.result);
        }
    });
}

cargarCombo();
mostrarIdRutina();

function modelEjericios(id_ejercicio, ejercicio, series, repeticiones) {
    return {
        id_ejercicio: id_ejercicio,
        ejercicio: ejercicio,
        cant_serie: series,
        cant_repeticiones: repeticiones,
    };
}

let datos = [];

function agregarEjercicio() {
    var id_ejercicio = $("#ejercicios").val();
    var series = $("#series").val();
    var repeticiones = $("#repeticiones").val();
    if (id_ejercicio == "") {
        $('#ejercicios').focus();
        showMessage("SELECCIONE UN EJERCICIO.!!!", "warning", 1500);
        return false;
    } else if (series == "") {
        $('#series').focus();
        showMessage("INGRESE LA CANTIDAD DE SERIES.!!!", "warning", 1500);
        return false;
    } else if (repeticiones == "") {
        $('#repeticiones').focus();
        showMessage("INGRESE LA CANTIDAD DE REPETICIONES.!!!", "warning", 1500);
        return false;
    } else {
        $.ajax({
            url: "../../funciones_php/rutinas/obtener_ejercicio.php",
            method: 'POST',
            data: { id_ejercicio: id_ejercicio },
            dataType: 'json',
            success: function (json) {
                $("#id_ejercicio").val(json.id_ejercicio);
                let nuevo = modelEjericios(id_ejercicio, json.ejercicio, series, repeticiones);
                datos.push(nuevo);
                cargarEjercicios();
                $("#series").val("");
                $("#repeticiones").val("");
                $("#ejercicios").focus();
            }
        });
    }
    console.log(datos);
}

function cargarEjercicios() {
    let plantilla = ``;
    datos.forEach((e, index) => {
        plantilla += `
          <tr>
          <td hidden>${e.id_ejercicio}</td>
            <td>${index + 1}</td>
            <td>${e.ejercicio}</td>
            <td class = "text-end">${e.cant_serie}</td>
            <td class = "text-end">${e.cant_repeticiones}</td>
            <td class = "text-center">
                <button type="button" class="btn btn-danger quitar" id = "${index}"><i class="bi bi-trash3"></i> </button>
            </td>
          </tr>
        `;
    });
    $('#datos_ejercicios').html(plantilla);
}

function limpiar() {
    $('#datos_ejercicios').html("");
    datos = [];
    mostrarIdRutina();
    $("#descripcion").val("");
    $("#descripcion").focus();
    $("#series").val("");
    $("#repeticiones").val("");
}

// Quitar fila

$(document).on('click', '.quitar', function () {
    let fila = this.parentNode.parentNode; // Obtener la fila a eliminar
    let tabla = fila.parentNode; // Obtener la referencia a la tabla
    let id = $(this).attr('id');
    Swal.fire({
        title: 'Esta seguro de quitar este ejercicio?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, quitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            tabla.removeChild(fila); // Eliminar la fila de la tabla
            datos.splice(id, 1);
            cargarEjercicios();
        }
    })
});

function guardar_rutina() {
    if ($("#descripcion").val() == "") {
        $("#descripcion").focus();
        showMessage("INGRESE UNA DESCRIPCIÓN.!!!", "warning", 1500);
    } else if (datos.length < 1) {
        showMessage("NO HAY EJERCICIOS CARGADOS.!!!", "warning", 1500);
    } else {
        $.ajax({
            url: '../../funciones_php/rutinas/guardar_cabecera.php',
            type: 'POST',
            data:
            {
                id_rutina: $("#id_rutina").val(),
                descripcion: $("#descripcion").val().toUpperCase()
            },
            dataType: 'json',
            success: function (json) {
                if (json.exito == true) {
                    showMessage(json.mensaje, json.icono, 1500);
                    datos.forEach((d, index) => {
                        $.ajax({
                            url: '../../funciones_php/rutinas/guardar_detalle.php',
                            type: 'POST',
                            data:
                            {
                                id_rutina: $("#id_rutina").val(),
                                orden: index + 1,
                                id_ejercicio: d.id_ejercicio,
                                cant_serie: d.cant_serie,
                                cant_repeticiones: d.cant_repeticiones
                            }
                        })
                    });
                    limpiar();
                } else {
                    showMessage(json.mensaje, json.icono, 2500);
                }
            }
        });
    }
}

var rutinas;

function cargarGrilla() {

    rutinas = $('#rutinas').DataTable({

        "responsive": true,
        "dom": 'Bfrtilp',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: '<i class = "fas fa-file-excel"></i> Excel',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [1],
                },
            },
            {
                extend: 'pdfHtml5',
                text: '<i class = "fas fa-file-pdf"></i> Pdf',
                titleAttr: 'Exportar a Pdf',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: [1],
                },
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Imprimir',
                titleAttr: 'Imprimir',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: [1]
                },
            },

        ],
        "info": false,
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/rutinas/cargar_rutinas.php",
            type: "POST"
        },
        "columnDefs": [
            {
                targets: [2, 3],
                className: 'dt-body-center'
            }
        ],
        "language": {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    rutinas.on('draw.dt', function () {
        rutinas.column(0).visible(false);
    });

}

cargarGrilla();

$(document).on('click', '.detalle', function () {
    var id_rutina = $(this).attr("id");
    cargarDetalle(id_rutina);
    var fila = $(this).closest('tr');
    var descripcion = fila.find('td:eq(0)').text();
    $("#rutina").text(descripcion);
    $("#modalDetalle").modal('show');
});

var detalle;

function cargarDetalle(id) {
    if ($.fn.DataTable.isDataTable('#detalle_rutina')) {
        $('#detalle_rutina').DataTable().destroy();
    }

    detalle = $('#detalle_rutina').DataTable({

        "responsive": true,
        "info": false,
        "processing": false,
        "serverSide": true,
        "order": [],
        "search": false,
        "lengthMenu": false,
        "ajax": {
            url: "../../funciones_php/rutinas/mostrar_detalle.php",
            type: "POST",
            data: { id_rutina: id }
        },
        "columnDefs": [
            {
                targets: [0, 2, 3],
                className: 'dt-body-right'
            }
        ],
        "language": {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        searching: false,

        // Deshabilita la paginación
        paging: false,

        // Deshabilita el número de elementos a mostrar por página
        lengthChange: false,
        // Oculta el select de elementos a mostrar por página
        lengthMenu: [],
        // Oculta los botones de paginación
        oLanguage: {
            oPaginate: {
                sNext: '', // Oculta el botón "Siguiente"
                sPrevious: '', // Oculta el botón "Anterior"
            },
        },
        ordering: false,

    });

}

function salir() {
    if (datos.length > 0) {
        Swal.fire({
            title: 'Hay datos cargados, esta seguro de salir?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '../../menu.html';
            }
        })
    } else {
        location.href = '../../menu.html';
    }
}

function cancelar() {
    if (datos.length > 0) {
        Swal.fire({
            title: 'Hay datos cargados, esta seguro de cancelar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                limpiar();
            }
        })
    } else {
        limpiar();
    }
}

$(document).on("click", '.inicio', function () {
    if (datos.length > 0) {
        Swal.fire({
            title: 'Hay datos cargados, esta seguro de cerrar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '../../menu.html'
            }
        })
    } else {
        location.href = '../../menu.html'
    }
});