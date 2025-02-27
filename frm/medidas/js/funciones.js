var medidas;

siguienteClick($("#ruc"), $(".buscar"), false);
siguienteCampo($("#espalda"), $("#pecho"), false);
siguienteCampo($("#pecho"), $("#bicep_izq"), false);
siguienteCampo($("#bicep_izq"), $("#bicep_der"), false);
siguienteCampo($("#bicep_der"), $("#cintura"), false);
siguienteCampo($("#cintura"), $("#nalga"), false);
siguienteCampo($("#nalga"), $("#muslo_izq"), false);
siguienteCampo($("#muslo_izq"), $("#muslo_der"), false);
siguienteCampo($("#muslo_der"), $("#panto_izq"), false);
siguienteCampo($("#panto_izq"), $("#panto_der"), false);
siguienteCampo($("#panto_der"), $("#peso"), false);
siguienteCampo($("#peso"), $("#observacion"), false);
siguienteCampo($("#observacion"), $("#fecha"), false);
siguienteCampo($("#fecha"), $("#action"), false);

$(document).on('click', '.inicio', function () {
    location.href = '../../menu.html'
})

function cargarTabla() {
    // Verificamos si la tabla ya cuenta con la configuración del dataTables,
    // si es asi se devuelve a su estado original
    if ($.fn.DataTable.isDataTable('#datos_medidas')) {
        $('#datos_medidas').DataTable().destroy();
    }

    var desde = $("#desde").val();
    var hasta = $("#hasta").val();

    if (desde == "" || hasta == "") {
        Swal.fire({
            position: 'center',
            title: 'DEBE INGRESAR AMBAS FECHAS PARA CARGAR LAS MEDIDAS.!!!',
            icon: 'warning',
            showConfirmButton: false,
            timer: '1500'
        })
    } else {

        medidas = $('#datos_medidas').DataTable({

            "responsive": true,
            "dom": 'Bfrtilp',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    text: '<i class = "fas fa-file-excel"></i> Excel',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class = "fas fa-file-pdf"></i> Pdf',
                    titleAttr: 'Exportar a Pdf',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                },

            ],
            "info": false,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "../../funciones_php/medidas/cargar_medidas.php",
                type: "POST",
                data:
                {
                    desde: $("#desde").val(),
                    hasta: $("#hasta").val()
                }
            },
            "columnDefs": [
                {
                    targets: [2, 3, 4, 5, 6, 7, 8],
                    className: 'dt-body-right'
                },
                {
                    targets: [12, 13],
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

        medidas.on('draw.dt', function () {
            medidas.column(0).visible(false);
        });

    }
}

var clientes;

window.onkeyup = function (event) {
    let code = event.keyCode;
    if (code == 113) {
        $("#modalBuscarCliente").modal('show');
    }
}

function cargarClientes() {
    clientes = $('#buscar_cliente').DataTable({

        "responsive": true,
        "info": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/medidas/cargar_clientes.php",
            type: "POST",
        },
        "columnDefs": [
            {
                targets: [0, 4, 6],
                className: 'dt-body-right'
            },
            {
                targets: [7],
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

}

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

$(document).on('click', '.enviar', function () {
    let ruc = $(this).attr('id');
    $("#ruc").val(ruc);
    buscar_cliente();
    $(".cerrar").click();
});

function buscar_cliente() {
    let ruc = $("#ruc").val();
    $.ajax({
        url: '../../funciones_php/medidas/buscar_cliente.php',
        method: 'POST',
        data: { ruc: ruc },
        dataType: 'json',
        success: function (data) {
            $("#id_cliente").val(data.id_cliente);
            $("#cliente").val(data.razon_social);
            var sexo = data.sexo;
            if (data.encontrado == true) {
                $("#espalda").focus();
                validarSexo(sexo);
            }
        }
    });
}

function guardar_medida() {
    if (verificarCampos()) {
        $.ajax({
            url: '../../funciones_php/medidas/guardar_medida.php',
            method: 'POST',
            data:
            {
                operacion: $("#operacion").val(),
                id_cliente: $("#id_cliente").val(),
                espalda: $("#espalda").val(),
                pecho: $("#pecho").val(),
                bicep_izq: $("#bicep_izq").val(),
                bicep_der: $("#bicep_der").val(),
                cintura: $("#cintura").val(),
                nalga: $("#nalga").val(),
                muslo_izq: $("#muslo_izq").val(),
                muslo_der: $("#muslo_der").val(),
                panto_izq: $("#panto_izq").val(),
                panto_der: $("#panto_der").val(),
                peso: $("#peso").val(),
                observacion: $("#observacion").val().toUpperCase(),
                fecha: $("#fecha").val(),
                id_medida: $("#id_medida").val()
            },
            dataType: 'json',
            success: function (json) {
                showMessage(json.mensaje, json.icono, 1500);
                // medidas.ajax.reload();
                $(".cerrar").click();
            }
        });
    }
}

$(document).on('click', '.editar', function () {
    var id_medida = $(this).attr("id");
    $.ajax({
        url: '../../funciones_php/medidas/obtener_medida.php',
        type: 'POST',
        data: { id_medida: id_medida },
        dataType: 'json',
        success: function (json) {
            $(".modal-title").text("Modificar Medidas");
            $("#action").text("Actualizar");
            $("#operacion").val("Editar");
            $("#modalMedidas").modal('show');
            $("#ruc").prop("disabled", true);
            $(".buscar").prop("disabled", true);
            $("#cliente").val(json.razon_social);
            $("#espalda").val(json.espalda);
            $("#pecho").val(json.pecho);
            $("#bicep_izq").val(json.bicep_izq);
            $("#bicep_der").val(json.bicep_der);
            $("#cintura").val(json.cintura);
            $("#nalga").val(json.nalga);
            $("#muslo_izq").val(json.muslo_izq);
            $("#muslo_der").val(json.muslo_der);
            $("#panto_izq").val(json.panto_izq);
            $("#panto_der").val(json.panto_der);
            $("#peso").val(json.peso);
            $("#observacion").val(json.observacion);
            $("#fecha").val(json.fecha);
            $("#id_medida").val(id_medida);
        }
    });
});

$(document).on('click', '.borrar', function () {
    let cliente = $(this).closest("tr").find("td:nth-child(1)").text();
    var id_medida = $(this).attr("id");
    Swal.fire({
        title: 'Esta seguro de eliminar las medidas de?\n\n' + cliente + '\n\n',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../../funciones_php/medidas/eliminar_medida.php",
                method: "POST",
                data: { id_medida: id_medida },
                dataType: 'json',
                success: function (json) {
                    showMessage(json.mensaje, json.icono, json.timer);
                    medidas.ajax.reload();
                }
            });
        }
    })
});

function verificarCampos() {
    if ($("#cliente").val() == "") {
        $("#ruc").focus();
        showMessage("EL CAMPO CLIENTE NO DEBE QUEDAR VACIO.!!!", "warning", 1500);
        return false;
    } else if ($("#espalda").val() == "") {
        $("#espalda").focus();
        showMessage("INGRESE LA MEDIDA DE LA ESPALDA.!!!", "warning", 1500);
        return false;
    } else if ($("#pecho").val() == "") {
        $("#pecho").focus();
        showMessage("INGRESE LA MEDIDA DEL PECHO.!!!", "warning", 1500);
        return false;
    } else if ($("#bicep_izq").val() == "") {
        $("#bicep_izq").focus();
        showMessage("INGRESE LA MEDIDA DEL BICEP IZQUIERDO.!!!", "warning", 1500);
        return false;
    } else if ($("#bicep_der").val() == "") {
        $("#bicep_der").focus();
        showMessage("INGRESE LA MEDIDA DEL BICEP DERECHO.!!!", "warning", 1500);
        return false;
    } else if ($("#cintura").val() == "") {
        $("#cintura").focus();
        showMessage("INGRESE LA MEDIDA DE LA CINTURA.!!!", "warning", 1500);
        return false;
    } else if ($("#nalga").val() == "") {
        $("#nalga").focus();
        showMessage("INGRESE LA MEDIDA DE LA NALGA.!!!", "warning", 1500);
        return false;
    } else if ($("#muslo_izq").val() == "") {
        $("#muslo_izq").focus();
        showMessage("INGRESE LA MEDIDA DEL MUSLO IZQUIERDO", "warning", 1500);
        return false;
    } else if ($("#muslo_der").val() == "") {
        $("#muslo_der").focus();
        showMessage("INGRESE LA MEDIDA DEL MUSLO DERECHO", "warning", 1500);
        return false;
    } else if ($("#panto_izq").val() == "") {
        $("#panto_izq").focus();
        showMessage("INGRESE LA MEDIDA DE LA PANTORRILLA IZQUIERDA", "warning", 1500);
        return false;
    } else if ($("#panto_der").val() == "") {
        $("#panto_der").focus();
        showMessage("INGRESE LA MEDIDA DE LA PANTORRILLA DERECHA", "warning", 1500);
        return false;
    } else if ($("#peso").val() == "") {
        $("#peso").focus();
        showMessage("INGRESE EL PESO.!!!", "warning", 1500);
        return false;
    } else if ($("#fecha").val() == "") {
        $("#fecha").focus();
        showMessage("Ingrese una fecha.!!!", "warning", 1500);
        return true;
    }
    return true;
}

