/* agregar lo siguiente a un input date para no permitir seleccionar fechas futuras
    max="<?= date("Y-m-d") ?>"
*/
function validarAcceso() {
    if ($("#user").val() === "") {
        $("#user").focus();
        showMessage("INGRESE UN NOMBRE DE USUARIO.!!!", "warning", 1500);
    } else if ($("#pass").val() === "") {
        $("#pass").focus();
        showMessage("INGRESE UNA CONTRASEÑA.!!!", "warning", 1500);
    } else {
        validar_acceso();
    }
}

function validar_acceso() {
    var datosFormulario = $("#form_login").serialize();
    $.ajax({
        url: 'funciones_php/login/confirmar_acceso.php',
        type: 'POST',
        data: datosFormulario,
        dataType: 'json',
        success: function (json) {
            if (json.acceso == true) {
                localStorage.usuariologueado = "1";
                localStorage.usuario = json.usuario;
                location.href = "menu.html";
            } else {
                $("#user").val("");
                $("#pass").val("");
                $("#user").focus();
                showMessage("USUARIOS Y/O CONTRASEÑA INCORRECTOS.!!!", "error", 1500);
            }
        }
    });
}

function usuario_logueado() {
    $.ajax({
        url: 'funciones_php/login/usuario_logeado.php',
        type: 'POST',
        data: { usuario: localStorage.usuario },
        dataType: 'json',
        success: function (json) {
            localStorage.imagen = json.imagen;
            localStorage.nombre = json.entrenador;
            localStorage.ciudad = json.ciudad;
            localStorage.direccion = json.direccion;
            localStorage.telefono = json.telefono;
            localStorage.edad = json.edad;
            localStorage.rol = json.rol;
            localStorage.id_entrenador = json.id_entrenador;
        }
    });
}

function user_logueado() {
    $.ajax({
        url: '../../funciones_php/login/usuario_logeado.php',
        type: 'POST',
        data: { usuario: localStorage.usuario },
        dataType: 'json',
        success: function (json) {
            localStorage.imagen = json.imagen;
            localStorage.nombre = json.entrenador;
            localStorage.ciudad = json.ciudad;
            localStorage.direccion = json.direccion;
            localStorage.telefono = json.telefono;
            localStorage.edad = json.edad;
            localStorage.rol = json.rol;
        }
    });
}

function verificarSesion() {
    if (localStorage.usuariologueado == "0") {
        $("#principal").css("display", "none");
        let timerInterval
        Swal.fire({
            title: 'ATENCIÓN.!\nUsted no ha iniciado Sesión.\nDebe iniciar sesión para acceder al sistema.!!!',
            icon: 'error',
            timer: 5000,
            timerProgressBar: true,
            willClose: () => {
                clearInterval(timerInterval)
                location.href = "index.html";
            }
        })
    }
}

function cerrarSesion() {
    localStorage.usuariologueado = "0";
    location.href = "index.html";
}

function cerrar_sesion() {
    localStorage.usuariologueado = "0";
    location.href = "../../index.html";
}

function siguienteCampo(actual, siguiente, preventDefault) {
    $(actual).keypress(function (event) {
        if (event.which === 13) {
            if (preventDefault) {
                event.preventDefault();
            }
            $(siguiente).focus();
            $(siguiente).select();
        }
    });
}

function siguienteClick(actual, siguiente, preventDefault) {
    $(actual).keypress(function (event) {
        if (event.which === 13) {
            if (preventDefault) {
                event.preventDefault();
            }
            $(siguiente).click();
        }
    });
}

function showMessage(mensaje, icono, tiempo) {
    Swal.fire({
        position: 'center',
        title: mensaje,
        icon: icono,
        showConfirmButton: false,
        timer: tiempo
    })
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

function fechaActual(campo) {
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth() + 1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if (dia < 10)
        dia = '0' + dia; //agrega cero si el menor de 10
    if (mes < 10)
        mes = '0' + mes //agrega cero si el menor de 10

    $("#" + campo).val(ano + "-" + mes + "-" + dia);
}

