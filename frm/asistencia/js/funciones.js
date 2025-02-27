function verificarSesion() {
    if (localStorage.usuariologueado != "1") {
        $("#principal").css("display", "none");
        $("#header").css("display", "none");
        let timerInterval
        Swal.fire({
            title: 'ATENCIÓN.!\nUsted no ha iniciado Sesión.\nDebe iniciar sesión para acceder al sistema.!!!',
            icon: 'error',
            timer: 3500,
            timerProgressBar: true,
            showConfirmButton: false,
            willClose: () => {
                clearInterval(timerInterval)
                location.href = "../../index.html";
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
    }
}

$(document).on('click', '.inicio', function() {
    location.href = '../../menu.html'
})

var asistencias;

function cargar_asistencias() {
    // Verificamos si la tabla ya cuenta con la configuración del dataTables,
    // si es asi se devuelve a su estado original
    if ($.fn.DataTable.isDataTable('#reg_asistencia')) {
        $('#reg_asistencia').DataTable().destroy();
    }

    var desde = $("#desde").val();
    var hasta = $("#hasta").val();

    if (desde == "" || hasta == "") {
        Swal.fire({
            position: 'center',
            title: 'DEBE INGRESAR AMBAS FECHAS PARA CARGAR LAS ASISTENCIAS.!!!',
            icon: 'warning',
            showConfirmButton: false,
            timer: '1500'
        })
    } else {

        asistencias = $('#reg_asistencia').DataTable({

            "responsive": true,
            "dom": 'Bfrtilp',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    text: '<i class = "fas fa-file-excel"></i> Excel',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class = "fas fa-file-pdf"></i> Pdf',
                    titleAttr: 'Exportar a Pdf',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },

            ],
            "info": false,
            "processing": true,
            "serverSide": true,
            "order": true,
            "ajax": {
                url: "../../funciones_php/asistencia/cargar_asistencias.php",
                type: "POST",
                data:
                {
                    desde: $("#desde").val(),
                    hasta: $("#hasta").val()
                }
            },
            "columnsDefs": [
                {
                    "targets": [0, 3, 4],
                    "orderable": false,
                },
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
    }
}

var reg = false;

function buscar_cliente() {
    var ruc = $("#ruc").val();
    $.ajax({
        url: '../../funciones_php/asistencia/buscar_cliente.php',
        type: 'POST',
        data: { ruc: ruc },
        dataType: 'json',
        success: function (data) {
            if (data.reg == true) {
                $("#id_cliente").val(data.id_cliente);
                $("#cliente").val(data.razon_social);
                $("#entrada").val(data.entrada);
                $("#salida").val(data.salida);
                reg = data.reg;
                if (data.count == 1) {
                    $(".registrar").focus();
                }
            } else {
                $("#id_cliente").val(data.id_cliente);
                $("#cliente").val(data.razon_social);
                $("#entrada").val(data.entrada);
                $("#salida").val("");
                reg = data.reg;
                if (data.count == 1) {
                    $(".registrar").focus();
                }
            }

        }
    });
}

function guardar_asistencia() {
    var id_cliente = $("#id_cliente").val();
    if (reg == false) {
        $.ajax({
            url: '../../funciones_php/asistencia/guardar_entrada.php',
            type: 'POST',
            data: { id_cliente: id_cliente },
            dataType: 'json',
            success: function (json) {
                limpiarCampos();
                showMessage(json.mensaje, json.icono, 1500);
                $(".cerrar").click();
            }
        });
    } else {
        $.ajax({
            url: '../../funciones_php/asistencia/guardar_salida.php',
            type: 'POST',
            data: { id_cliente: id_cliente },
            dataType: 'json',
            success: function (json) {
                limpiarCampos();
                showMessage(json.mensaje, json.icono, 1500);
                $(".cerrar").click();
            }
        });
    }
}

function limpiarCampos() {
    $("#ruc").focus();
    $("#ruc").val("");
    $("#cliente").val("");
    $("#entrada").val("");
    $("#salida").val("");
}

function mostrar_asistencias() {
    if (cargado = true) {
        asistencias.destroy();
        $("#reg_asistencia").removeClass('dataTable');
        cargar_asistencias();
    }

}

