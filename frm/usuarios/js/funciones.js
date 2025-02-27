var usuarios;

function cargarGrilla() {

    usuarios = $('#datos_usuarios').DataTable({

        "responsive": true,
        "dom": 'Bfrtilp',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: '<i class = "fas fa-file-excel"></i> Excel',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                },
            },
            {
                extend: 'pdfHtml5',
                text: '<i class = "fas fa-file-pdf"></i> Pdf',
                titleAttr: 'Exportar a Pdf',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                },
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Imprimir',
                titleAttr: 'Imprimir',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                },
            },

        ],
        "info": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../../funciones_php/usuarios/cargar_usuarios.php",
            type: "POST"
        },
        "columnDefs": [
            {
                className: "dt-body-left", targets: [1, 2, 3, 4]
            },
            {
                className: "dt-body-center", targets: [5, 7, 8]
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

    usuarios.on('draw.dt', function () {
        usuarios.column(0).visible(false);
        usuarios.column(1).visible(false);
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
        })
    }
}

function cargarComboRoles() {

    $.ajax({
        type: 'POST',
        url: '../../funciones_php/usuarios/combo_roles.php',
        dataType: 'json',
        success: function (json) {

            $.each(json, function (i, obj) {
                $('#roles').append($('<option>').text(obj.rol).attr('value', obj.id_rol));
            });

        }
    });
}

function mostrarPassword(campo, icono) {
    var cambio = document.getElementById(campo);
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.' + icono).removeClass('bi bi-eye').addClass('bi bi-eye-slash');
    } else {
        cambio.type = "password";
        $('.' + icono).removeClass('bi bi-eye-slash').addClass('bi bi-eye');
    }
}

function buscar_entrenador() {
    ruc = $("#ruc").val();
    if (ruc == "") {
        ruc = $("#ruc").focus();
    } else {
        $.ajax({
            url: '../../funciones_php/usuarios/buscar_entrenador.php',
            type: 'POST',
            data: { ruc: ruc },
            dataType: 'json',
            success: function (data) {
                if (data.tiene == true) {
                    $("#ruc").val("")
                    $("#ruc").focus();
                    showMessage(data.mensaje, 'warning', 1500);
                } else {
                    $("#entrenador").val(data.entrenador);
                    $("#id_entrenador").val(data.id_entrenador);
                    $("#roles").focus();
                }
            }
        });
    }
}


function modificar_password() {
    let id_usuario = localStorage.id_usuario;
    if ($("#anterior").val() == "") {
        $("#anterior").focus();
        showMessage("INGRESE SU CONTRASEÑA ANTERIOR.!!!", "warning", 1500);
    } else if (validar_contrasenha($("#contrasena").val(), "errorContrasena") == false) {
    } else if ($("#contrasena").val() != $("#confirmar").val()) {
        showMessage("LAS CONTRASEÑAS NO COINCIDEN", "warning", 1500);
    } else {
        $.ajax({
            url: '../../funciones_php/usuarios/modificar_password.php',
            method: 'POST',
            data:
            {
                id_usuario: id_usuario,
                anterior: $("#anterior").val(),
                contrasena: $("#contrasena").val()
            },
            dataType: 'json',
            success: function (json) {
                if (json.exito == false) {
                    $("#errorAnterior").text("Contraseña incorrecta");
                    $("#anterior").focus();
                } else {
                    let timerInterval
                    Swal.fire({
                        title: json.mensaje,
                        icon: json.icono,
                        timer: 2500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                            location.href = "../../index.html";
                        }
                    })
                }
            }
        });
    }
}