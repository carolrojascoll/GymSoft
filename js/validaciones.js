function mayusculas_espacio(input) {
    return input.replace(/[^a-z A-Z\s]/g, "");
}

function solo_numeros(input) {
    return input.replace(/[^0-9]/g, "");
}

function solo_numeros_ruc(input) {
    return input.replace(/[^0-9 -]/g, "");
}

function formatear(num) {
    n = new Intl.NumberFormat("de-DE").format(num);
    return (n);
}

function quitarSeparador(num) {
    var n = num.replace(/\./g, "");
    return n;
}

function solo_numeros_sin_cero(input) {
    // Verificamos si el primer carácter es un guión o un cero
    if (input.charAt(0) === "-" || input.charAt(0) === "0") {
        // Eliminar el primer carácter con substring
        input = input.substring(1);
        // Verificar si el segundo carácter es un guión
        if (input.charAt(0) === "-") {
            // Eliminar el segundo carácter
            input = input.substring(1);
        }
    }
    return input.replace(/[^0-9]/g, "");
}

function agregarSeparador(elemento) {
    // Obtener el valor actual del campo de entrada
    var valor = elemento.value;
    // Remover cualquier separador de miles previo
    valor = valor.replace(/,/g, "");
    // Agregar separadores de miles
    valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    // Establecer el valor modificado en el campo de entrada
    elemento.value = valor;
}

function validar_ruc(event) {
    const rucInput = document.getElementById('ruc');
    const rucValue = rucInput.value;

    // Permitir solo números y guión
    const charCode = (event.which) ? event.which : event.keyCode;
    if (charCode !== 45 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }

    // Permitir solo un número después del guión
    const guionIndex = rucValue.indexOf('-');
    if (guionIndex !== -1 && rucInput.selectionStart > guionIndex) {
        const afterGuion = rucValue.substring(guionIndex + 1);
        if (afterGuion.length >= 1) {
            return false;
        }
    }

    return true;
}

function validarCorreo(correo) {
    // Expresión regular para validar el formato de correo electrónico
    var expresionRegular = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validar el correo utilizando la expresión regular
    if (expresionRegular.test(correo) && correo.includes("@")) {
        return true; // El correo es válido
    } else {
        return false; // El correo es inválido
    }
}

function validar_contrasenha(password, campo) {

    let contMay = 0; // Contador para las mayusculas
    let contMin = 0; // Contador para las minusculas
    let contNum = 0; // Contador para los numeros
    let contCar = 0; // Contador para los cartacteres especiales

    for (let i = 0; i < password.length; i++) {

        let c = password.charAt(i);

        if (c >= "A" && c <= "Z") {
            contMay += 1;
        }

        if (c >= "a" && c <= "z") {
            contMin += 1;
        }

        if (c >= "0" && c <= "9") {
            contNum += 1;
        }

        if (
            (c >= "!" && c <= "/") ||
            (c >= ":" && c <= "@") ||
            (c >= "[" && c <= "`") ||
            (c >= "{" && c <= "~")
        ) {
            contCar += 1;
        }

    }

    if (contMay < 2) {
        $('#' + campo).text("Ingrese al menos 2 letras mayusculas");
        return false;
    } else if (contMin < 2) {
        $('#' + campo).text("Ingrese al menos 2 letras minusculas");
        return false;
    } else if (contNum < 2) {
        $('#' + campo).text("Ingrese al menos 2 numeros");
        return false;
    } else if (contCar < 2) {
        $('#' + campo).text("Ingrese al menos 2 caracteres especiales");
        return false;
    } else {
        $('#' + campo).text("");
    }

    return true;

}