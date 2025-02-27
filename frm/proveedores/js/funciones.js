var proveedores;

siguienteCampo($("#ruc"), $("#razon"), false);
siguienteCampo($("#razon"), $("#ciudad"), false);

function cargarTabla() {

    proveedores = $('#datos_proveedores').DataTable({

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
            url: "../../funciones_php/proveedores/cargar_proveedores.php",
            type: "POST"
        },
        "columnDefs": [
            {
                targets: [1],
                className: 'dt-body-right'
            },
            {
                targets: [6, 7],
                className: 'dt-body-center'
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

    proveedores.on('draw.dt', function () {
        proveedores.column(0).visible(false);
    });

}

function cargarComboCiudades() {
    $.ajax({
        type: 'POST',
        url: '../../funciones_php/proveedores/combo_ciudades.php',
        dataType: 'json',
        success: function (json) {

            $.each(json, function (i, obj) {
                $('#ciudad').append($('<option>').text(obj.ciudad).attr('value', obj.id_ciudad));
            });

        }
    });
}

function activar() {
    $("#action").prop('disabled', false);
    $("#action").click();
    $("#action").prop('disabled', true);
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
