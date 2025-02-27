<?php

include("../conexion.php");
include("../funciones.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_usuario, usuario FROM usuarios WHERE usuario = :usuario");
    $stmt->execute(array(':usuario' => $_POST["usuario"]));
    $resultado = $stmt->fetchAll();

    if (count($resultado) > 0) {
        $info = array(
            "mensaje"   => "EL NOMBRE DE USUARIO INGRESADO YA ESTA SIENDO USADO.!!!",
            "icono"     => "warning",
            "exito"     => false,
        );
    } else {
        $imagen = '';
        if ($_FILES["imagen_usuario"] != "") {
            $imagen = subir_imagen();
        }

        $stmt = $conexion->prepare(
            "INSERT INTO usuarios (id_entrenador, id_rol, email, imagen, usuario, contrasena) 
                VALUES (:id_entrenador, :id_rol, :email, :imagen, :usuario, md5(:contrasena))"
        );

        $resultado = $stmt->execute(
            array(
                ':id_entrenador'        => $_POST["id_entrenador"],
                ':id_rol'               => $_POST["roles"],
                ':email'                => $_POST["correo"],
                ':imagen'               => $imagen,
                ':usuario'              => $_POST["usuario"],
                ':contrasena'           => $_POST["contrasena"]
            )
        );

        $info = array(
            "mensaje"   => "REGISTRO INSERTADO.!!!",
            "icono"     => "success",
            "exito"     => true
        );
    }
} else {
    $stmt = $conexion->prepare("SELECT id_usuario, usuario FROM usuarios WHERE usuario = :id_usuario");
    $stmt->execute(array(':id_usuario' => $_POST["usuario"]));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $codigo = $fila["id_usuario"];
        $usuario = $fila["usuario"];
    }
    if ($usuario == $_POST["usuario"]) {

        $imagen = '';
        if ($_FILES["imagen_usuario"]["name"] != '') {
            $imagen = subir_imagen();
        }

        $stmt = $conexion->prepare(
            "UPDATE usuarios SET id_rol = :id_rol, email = :email, imagen = :imagen, 
                usuario = :usuario, contrasena = md5(:contrasena) WHERE id_usuario = :id_usuario"
        );
        $stmt->execute(
            array(
                ':id_rol'               => $_POST["roles"],
                ':email'                => $_POST["correo"],
                ':imagen'               => $imagen,
                ':usuario'              => $_POST["usuario"],
                ':contrasena'           => $_POST["contrasena"],
                ':id_usuario'           => $_POST["id_usuario"]
            )
        );

        $info = array(
            "mensaje"   => "REGISTRO MODIFICADO.!!!",
            "icono"     => "success",
            "exito"     => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_usuario, usuario FROM usuarios WHERE usuario = :usuario");
        $stmt->execute(array(':usuario' => $_POST["usuario"]));
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"   => "EL NOMBRE DE USUARIO INGRESADO YA ESTA SIENDO USADO.!!!",
                "icono"     => "warning",
                "exito"     => false,
            );
        } else {
            $imagen = '';
            if ($_FILES["imagen_usuario"]["name"] != '') {
                $imagen = subir_imagen();
            }

            $stmt = $conexion->prepare(
                "UPDATE usuarios SET id_rol = :id_rol, email = :email, imagen = :imagen, 
                    usuario = :usuario, contrasena = md5(:contrasena) WHERE id_usuario = :id_usuario"
            );
            $stmt->execute(
                array(
                    ':id_rol'               => $_POST["roles"],
                    ':email'                => $_POST["correo"],
                    ':imagen'               => $imagen,
                    ':usuario'              => $_POST["usuario"],
                    ':contrasena'           => $_POST["contrasena"],
                    ':id_usuario'           => $_POST["id_usuario"]
                )
            );

            $info = array(
                "mensaje"   => "REGISTRO MODIFICADO.!!!",
                "icono"     => "success",
                "exito"     => true
            );
        }
    }
}

echo json_encode($info);
