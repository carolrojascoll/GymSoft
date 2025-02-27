$(".buscarProv").hide();
$(".buscarArt").hide();
siguienteClick($("#ruc"), $(".buscarProv"), false);
siguienteClick($("#codigo"), $(".buscarArt"), false);
siguienteCampo($("#num_fac"), $("#timbrado"), false);
siguienteCampo($("#timbrado"), $("#codigo"), false);
siguienteCampo($("#fecha"), $("#codigo"), false);
siguienteCampo($("#cantidad"), $("#precio"), false);
siguienteClick($("#precio"), $(".agregar"), false);
var fecha = new Date().toISOString().split('T')[0];
$("#fecha").val(fecha);
$("#ruc").focus();
document.addEventListener('keyup', ventanas);

function ventanas(event) {
    let code = event.keyCode;
    switch (code) {
        case 113:
            $("#buscadorProveedores").modal('show');
            break;
        case 115:
            $("#buscadorArticulos").modal('show');
            break;
    }
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
        })
    }
}

var proveedores;

function cargarProveedores() {
    proveedores = $('#datos_proveedores').DataTable({
        "responsive": true,
        "info": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/compras/cargar_proveedores.php",
            type: "POST"
        },
        "columnDefs": [
            {
                targets: [0, 4],
                className: 'dt-body-right'
            },
            {
                targets: [5],
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
}

var articulos;

function cargarArticulos() {
    articulos = $('#datos_articulos').DataTable({

        "responsive": true,
        "info": false,
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/compras/cargar_articulos.php",
            type: "POST"
        },
        "columnDefs": [
            {
                targets: [0, 4],
                className: 'dt-body-right'
            },
            {
                targets: [5],
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

// Enviar datos del articulo
$(document).on('click', '.enviarArt', function () {
    $("#codigo").val($(this).attr("id"));
    $(".closeArt").click();
    $("#cantidad").focus();
    buscarArticulo();
});

// Enviar datos del proveedor
$(document).on('click', '.enviarProv', function () {
    $("#ruc").val($(this).attr("id"));
    $(".closeProv").click();
    $("#num_fac").focus();
    buscarProveedor();
});

function buscarArticulo() {
    let codigo = $("#codigo").val();
    $.ajax({
        url: '../../funciones_php/compras/buscar_articulo.php',
        type: 'POST',
        data: { codigo: codigo },
        dataType: 'json',
        success: function (json) {
            if (json.exito == true) {
                $("#id_art").val(json.id_articulo);
                $("#id_marca").val(json.id_marca);
                $("#descripcion").val(json.descripcion);
                $("#iva").val(json.iva);
                $("#id_marca").val(json.id_marca);
                $("#id_iva").val(json.id_iva);
                $("#precio_compra").val(json.precio_compra);
                $("#precio_venta").val(json.precio_venta);
                $("#cantidad").focus();
            }
        }
    });
}

function buscarProveedor() {
    let ruc = $("#ruc").val();
    $.ajax({
        url: '../../funciones_php/compras/buscar_proveedor.php',
        type: 'POST',
        data: { ruc: ruc },
        dataType: 'json',
        success: function (json) {
            if (json.exito == true) {
                $("#proveedor").val(json.razon);
                $("#id_prov").val(json.id_proveedor);
                $("#num_fac").focus();
            }
        }
    });
}

function calcularSubTotal() {
    let cantidad = $("#cantidad").val();
    let precio = quitarSeparador($("#precio").val());
    if (cantidad > 0 && precio > 0) {
        let sub = precio * cantidad;
        $("#subTotal").val(formatear(sub));
    } else {
        $("#subTotal").val("");
    }
}

function detalle(descripcion, cantidad, precio, iva, subtotal, id_articulo, id_marca, id_iva, subtotal_iva0, subtotal_iva5, subtotal_iva10, precio_compra, precio_venta) {
    return {
        descripcion: descripcion,
        cantidad: cantidad,
        precio: precio,
        iva: iva,
        subtotal: subtotal,
        id_articulo: id_articulo,
        id_marca: id_marca,
        id_iva: id_iva,
        subtotal_iva0: subtotal_iva0,
        subtotal_iva5: subtotal_iva5,
        subtotal_iva10: subtotal_iva10,
        precio_compra: precio_compra,
        precio_venta: precio_venta
    };
}

let datos = [];

function agregarArticulo() {
    let descripcion = $("#descripcion").val();
    let cantidad = $("#cantidad").val();
    let precio = $("#precio").val();
    let iva = $("#iva").val();
    let subtotal = $("#subTotal").val();
    let id_articulo = $("#id_art").val();
    let id_marca = $("#id_marca").val();
    let id_iva = $("#id_iva").val();
    let precio_compra = $("#precio_compra").val();
    let precio_venta = $("#precio_venta").val();
    let subtotal_iva0 = 0, subtotal_iva5 = 0, subtotal_iva10 = 0;

    if (iva == "5 %") {
        subtotal_iva5 += Number(quitarSeparador(subtotal));
    } else if (iva == "10 %") {
        subtotal_iva10 += Number(quitarSeparador(subtotal));
    }

    if (descripcion == "") {
        $("#codigo").focus();
        showMessage("Descripcion del articulo vacia.", 'warning', 1500);
    } else if (cantidad == "") {
        $("#cantidad").focus();
        showMessage("Ingrese la cantidad comprada.", 'warning', 1500);
    } else if (precio == "") {
        $("#precio").focus();
        showMessage("Ingrese el precio de la compra.", 'warning', 1500);
    } else {
        let fila = detalle(descripcion, cantidad, precio, iva, subtotal, id_articulo, id_marca, id_iva, subtotal_iva0, subtotal_iva5, subtotal_iva10, precio_compra, precio_venta);
        datos.push(fila);
        mostrarDetalle();
        console.log(datos);
        $("#cantidad").val("1");
        $("#precio").val("");
        $("#codigo").val("");
        $("#subTotal").val("");
        $("#descripcion").val("");
        $("#codigo").focus();
    }
}


// Quitar articulo

$(document).on('click', '.quitar', function () {
    let fila = this.parentNode.parentNode;
    let table = fila.parentNode;
    Swal.fire({
        title: 'Esta seguro de quitar este artículo?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, quitar'
    }).then((result) => {
        if (result.isConfirmed) {
            table.removeChild(fila);
            let id = $(this).attr('id');
            datos.splice(id, 1);
            mostrarDetalle();
            calcular();
        }
    })
});

function mostrarDetalle() {
    let filas = ``;
    datos.forEach((d, index) => {
        filas +=
            `<tr>
            <td>${index + 1}</td>
            <td>${d.descripcion}</td>
            <td class="text-end">${d.cantidad}</td>
            <td class="text-end">${d.precio}</td>
            <td class= "text-center">${d.iva}</td>
            <td class="text-end">${d.subtotal}</td>
            <td class="text-center"><button type="button" id= "${index}" class="btn btn-danger quitar"><i class="bi bi-trash3"></i> </button></td>
            </tr>`
    });
    calcular();
    $("#detalle_factura").html(filas);
}

function factura() {
    let nro = $("#num_fac").val();
    if (nro.length == 3) {
        $("#num_fac").val(nro + '-');
    }
    if (nro.length == 7) {
        $("#num_fac").val(nro + '-');
    }
}

function calcular() {
    let iva0 = 0;
    let iva5 = 0;
    let iva10 = 0;
    let total = 0;
    if (datos.length > 0) {

        datos.forEach(d => {
            let subtotal = Number(quitarSeparador(d.subtotal));
            total = total + subtotal;
            if (d.iva == '5') {
                iva5 = subtotal;
                $("#iva5").val(formatear(iva5));
            } else {
                iva10 = subtotal;
                $("#iva10").val(formatear(iva10));
            }
            $("#iva0").val(iva0);
            $("#total").val(formatear(total));
        });
    } else {
        $("#iva0").val("0");
        $("#iva5").val("0");
        $("#iva10").val("0");
        $("#total").val("0");
    }
}

function generarIdCompra() {
    $.ajax({
        url: '../../funciones_php/compras/generar_idCompra.php',
        type: 'POST',
        data: {},
        dataType: 'json',
        success: function (json) {
            $("#id_compra").val(json.result);
        }
    });
}

function guardarCompra() {
    let iva0 = quitarSeparador($("#iva0").val());
    let iva5 = quitarSeparador($("#iva5").val());
    let iva10 = quitarSeparador($("#iva10").val());
    let total = quitarSeparador($("#total").val());
    if ($("#proveedor").val() == "") {
        $("#ruc").focus();
        showMessage("El campo proveedor de no debe estar vacio.", 'warning', 1500);
    } else if ($("#num_fac").val() == "") {
        $("#num_fac").focus();
        showMessage("Ingrese el número de la factura.", 'warning', 1500);
    } else if ($("#timbrado").val() == "") {
        $("#timbrado").focus();
        showMessage("Ingese el número de timbrado de la factura.", 'warning', 1500);
    } else if ($("#condicion").val() == "") {
        $("#condicion").focus();
        $("#condicion").select();
        showMessage("Seleccione la condición de la compra.", 'warning', 1500);
    } else if ($("#fecha").val() == "") {
        $("#fecha").focus();
        showMessage("Ingrese la fecha de la compra.", 'warning', 1500);
    } else if (datos.length == 0) {
        $("#codigo").focus();
        showMessage("No hay artículos cargados", 'warning', 1500);
    } else {
        $.ajax({
            url: '../../funciones_php/compras/guardar_cabecera.php',
            type: 'POST',
            data:
            {
                id_compra: $("#id_compra").val(),
                id_proveedor: $("#id_prov").val(),
                num_fac: $("#num_fac").val(),
                timbrado: $("#timbrado").val(),
                condicion: $("#condicion").val(),
                fecha: $("#fecha").val(),
                total_iva0: iva0,
                total_iva5: iva5,
                total_iva10: iva10,
                total_compra: total,
            },
            dataType: 'json',
            success: function (json) {
                if (json.exito == true) {
                    showMessage(json.mensaje, json.icono, 1500);
                    datos.forEach(d => {
                        $.ajax({
                            url: '../../funciones_php/compras/guardar_detalle.php',
                            type: 'POST',
                            data:
                            {
                                id_compra: $("#id_compra").val(),
                                id_articulo: d.id_articulo,
                                id_marca: d.id_marca,
                                id_iva: d.id_iva,
                                cantidad: d.cantidad,
                                precio: quitarSeparador(d.precio),
                                subtotal_iva0: d.subtotal_iva0,
                                subtotal_iva5: d.subtotal_iva5,
                                subtotal_iva10: d.subtotal_iva10,
                            },
                            success: function () {
                                let dif = d.precio_venta - Number((quitarSeparador(d.precio)));
                                let porcent_ganancia = (dif / Number((quitarSeparador(d.precio)))) * 100;
                                console.log(porcent_ganancia);
                                $.ajax({
                                    url: '../../funciones_php/compras/actualizar_stock.php',
                                    type: 'POST',
                                    data:
                                    {
                                        cantidad: d.cantidad,
                                        precio_compra: quitarSeparador(d.precio),
                                        porcent_ganancia: porcent_ganancia,
                                        id_articulo: d.id_articulo
                                    }
                                })
                            }
                        })
                    });
                    limpiar();
                } else {
                    showMessage("Ocurrio un error", 'error', 1500);
                }
            }
        })
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

$(document).on("click", '.cerrar', function () {
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

function limpiar() {
    $("#ruc").val("");
    $("#proveedor").val("");
    $("#num_fac").val("");
    $("#timbrado").val("");
    $("#condicion").val("");
    $("#iva0").val("");
    $("#iva5").val("");
    $("#iva10").val("");
    $("#total").val("");
    $("#subTotal").val("");
    $("#descripcion").val("");
    $("#cantidad").val("1");
    $("#precio").val("");
    $("#fecha").val(fecha);
    datos = [];
    $("#detalle_factura").html("");
    $("#ruc").focus();
}

$(document).on('click', '.cancelar', function () {
    if (datos.length > 0) {
        Swal.fire({
            title: 'Hay datos cargados, esta seguro de cancelar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'Cancelar',
        }).then((result => {
            if (result.isConfirmed) {
                limpiar();
            }
        }))
    } else {
        limpiar();
    }
})

$(document).on("click", '.cerrar', function () {
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

// ------------------------------- Consultar Compras ------------------------------- //

var compras;

function cargarCompras() {

    if ($.fn.DataTable.isDataTable('#compras')) {
        $('#compras').DataTable().destroy();
    }

    compras = $('#compras').DataTable({

        "responsive": true,
        "dom": 'Bfrtilp',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: '<i class = "fas fa-file-excel"></i> Excel',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [1]
                },
            },
            {
                extend: 'pdfHtml5',
                text: '<i class = "fas fa-file-pdf"></i> Pdf',
                titleAttr: 'Exportar a Pdf',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: [1]
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
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/compras/cargar_compras.php",
            type: "POST",
            data:
            {
                desde: $("#desde").val(),
                hasta: $("#hasta").val(),
            }
        },
        "columnDefs": [
            {
                targets: [1, 3],
                className: "dt-body-right"
            },
            {
                targets: [8, 9, 10],
                className: "dt-body-center"
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

    compras.on('draw.dt', function () {
        compras.column(0).visible(false);
    });

}

var compra_list;

function cargarDetalle(id) {
    if ($.fn.DataTable.isDataTable('#detalle_compra')) {
        $('#detalle_compra').DataTable().destroy();
    }

    compra_list = $('#detalle_compra').DataTable({

        "responsive": true,
        "info": false,
        "processing": false,
        "serverSide": true,
        "order": [],
        "search": false,
        "lengthMenu": false,
        "ajax": {
            url: "../../funciones_php/compras/mostrar_detalle.php",
            type: "POST",
            data: { id_compra: id }
        },
        "columnDefs": [
            {
                targets: [0, 2, 3, 4, 5],
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

// -------------------- Mostrar Detalle -------------------- \\

$(document).on('click', '.detalle', function () {
    var id_compra = $(this).attr("id");
    cargarDetalle(id_compra);
    var fila = $(this).closest('tr');
    var num_fac = 'Factura N° ' + fila.find('td:eq(0)').text();
    var proveedor = fila.find('td:eq(1)').text();
    var total = 'Total: ' + fila.find('td:eq(2)').text() + ' Gs.';
    var fecha = 'Fecha: ' + fila.find('td:eq(3)').text();
    $("#proveedor").html(proveedor);
    $("#factura").html(num_fac);
    $("#fecha").html(fecha);
    $("#total").html(total);
    $("#modalDetalle").modal('show');
})

// -------------------- Anular Compra -------------------- \\

$(document).on('click', '.anular', function () {
    Swal.fire({
        title: 'Esta seguro de anular esta compra?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, anular',
        cancelButtonText: 'Cancelar'
    }).then((result => {
        if (result.isConfirmed) {
            var id_compra = $(this).attr('id');
            $.ajax({
                url: '../../funciones_php/compras/anular_compra.php',
                method: 'POST',
                data: { id_compra: id_compra },
                dataType: 'json',
                success: function (json) {
                    if (json.exito == true) {
                        showMessage(json.mensaje, json.icono, 1500);
                        compras.ajax.reload();
                    } else {
                        showMessage(json.mensaje, json.icono, 1500);
                    }
                }
            })
        }
    }))
});

// -------------------- Procesar Pago -------------------- \\

siguienteCampo($("#efectivo"), $("#transferencia"), false);
siguienteCampo($("#transferencia"), $("#cheque"), false);
siguienteCampo($("#cheque"), $("#btnPagar"), false);

let id_venta;

$(document).on('click', '.pagar', function () {
    id_compra = $(this).attr('id');
    var fila = $(this).closest('tr');
    var proveedor = fila.find('td:eq(1)').text();
    var total = fila.find('td:eq(2)').text();
    $("#prov").text(proveedor);
    $("#total_compra").val(total);
    $("#modalPagoCompra").modal('show');
})

puede = false;

function pago() {
    let efectivo = Number(quitarSeparador($("#efectivo").val()));
    let transferecia = Number(quitarSeparador($("#transferencia").val()));
    let cheque = Number(quitarSeparador($("#cheque").val()));
    let importe = 0;
    let vuelto = 0;
    let total = Number(quitarSeparador($("#total_compra").val()));
    importe = efectivo + transferecia + cheque;
    vuelto = importe - total;
    $("#importe").val(formatear(importe));
    if (importe >= total) {
        $("#vuelto").val(formatear(vuelto));
        puede = true;
    } else {
        puede = false;
        $("#vuelto").val("0");
    }
}

$(document).on('keyup', '#efectivo', pago);
$(document).on('keyup', '#transferencia', pago);
$(document).on('keyup', '#cheque', pago);

$(document).on('click', '#btnPagar', function () {
    if (puede == true) {
        let efectivo = Number(quitarSeparador($("#efectivo").val()));
        let transferencia = Number(quitarSeparador($("#transferencia").val()));
        let cheque = Number(quitarSeparador($("#cheque").val()));
        let importe = Number(quitarSeparador($("#importe").val()));
        let vuelto = Number(quitarSeparador($("#vuelto").val()));
        Swal.fire({
            title: 'Esta seguro de realizar el pago?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, pagar',
            cancelButtonText: 'Cancelar'
        }).then((result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../funciones_php/compras/pagar_compra.php',
                    method: 'POST',
                    data:
                    {
                        efectivo: efectivo,
                        transferencia: transferencia,
                        cheque: cheque,
                        importe: importe,
                        vuelto: vuelto,
                        id_compra: id_compra
                    },
                    dataType: 'json',
                    success: function (json) {
                        if (json.exito == true) {
                            showMessage(json.mensaje, json.icono, 1500);
                            $(".cerrarModal").click();
                            compras.ajax.reload();
                        } else {
                            showMessage(json.mensaje, json.icono, 1500);
                        }
                    }
                })
            }
        }))
    } else {
        showMessage('El importe debe ser igual o mayor al total a pagar para realizar el pago.', 'info', 3500);
    }
})
