var articulos;
siguienteCampo($("#codigo"), $("#marcas"), false);
siguienteCampo($("#descripcion"), $("#iva"), false);
siguienteCampo($("#stock"), $("#p_compra"), false);
siguienteCampo($("#p_compra"), $("#p_venta"), false);
siguienteClick($("#p_venta"), $("#check"), false);

function cargarGrilla() {

    articulos = $('#datos_articulos').DataTable({

        "responsive": true,
        "dom": 'Bfrtilp',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: '<i class = "fas fa-file-excel"></i> Excel',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8],
                },
            },
            {
                extend: 'pdfHtml5',
                text: '<i class = "fas fa-file-pdf"></i> Pdf',
                titleAttr: 'Exportar a Pdf',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8],
                },
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Imprimir',
                titleAttr: 'Imprimir',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8]
                },
            },

        ],
        "info": false,
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/articulos/cargar_articulos.php",
            type: "POST"
        },
        "columnDefs": [
            {
                targets: [1, 4, 5, 6, 7, 8],
                className: 'dt-body-right'
            },
            {
                targets: [9, 10],
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

    articulos.on('draw.dt', function () {
        articulos.column(0).visible(false);
    });

}

function cargar_marcas() {

    $.ajax({
        type: 'POST',
        url: '../../funciones_php/articulos/combo_marcas.php',
        dataType: 'json',
        success: function (json) {

            $.each(json, function (i, obj) {
                $('#marcas').append($('<option>').text(obj.marca).attr('value', obj.id_marca));
            });

        }
    });

}

function cargar_iva() {

    $.ajax({
        type: 'POST',
        url: '../../funciones_php/articulos/combo_iva.php',
        dataType: 'json',
        success: function (json) {

            $.each(json, function (i, obj) {
                $('#iva').append($('<option>').text(obj.tipo_iva).attr('value', obj.id_iva));
            });

        }
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

function activar() {
    $("#action").prop('disabled', false);
    $("#action").click();
    $("#action").prop('disabled', true);
}

function calcular_precioVenta() {
    let p_compra = Number($("#p_compra").val());
    let porcentaje = $("#porcent").val() / 100;
    if (p_compra != "" && porcentaje != "") {
        let ganancia = Number(p_compra * porcentaje);
        let precio = (p_compra + ganancia);
        $("#p_venta").val(formatear(precio));
    } else {
        $("#p_venta").val("");
    }

}

function calcular_porcentaje() {
    let compra = Number($("#p_compra").val());
    let venta = Number($("#p_venta").val());
    if (compra != "" && venta != "") {
        let dif = venta - compra;
        let porcentaje = (dif / compra) * 100;
        $("#porcent").val(formatear(porcentaje));
    }
}

