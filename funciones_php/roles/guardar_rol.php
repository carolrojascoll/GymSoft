<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_rol, rol FROM roles WHERE rol = :rol");
    $stmt->execute(array(':rol'    => $_POST["rol"]));
    $resultado = $stmt->fetchAll();
    if (count($resultado) > 0) {
        $info = array(
            "mensaje"        => $_POST["rol"] . " YA EXSTE.!!!\nINGRESE OTRO ROL.!!!",
            "icono"          => "warning",
            "exito"          => false
        );
    } else {
        $stmt = $conexion->prepare("INSERT INTO roles (rol) VALUES (:rol)");
        $resultado = $stmt->execute(
            array(
                ':rol'   => $_POST["rol"]
            )
        );
        $info = array(
            "mensaje"   => "REGISTRO INSERTADO",
            "icono"     => "success",
            "exito"     => true
        );
    }
} else {
    $cod = "";
    $rol = "";
    $stmt = $conexion->prepare("SELECT id_rol, rol FROM roles WHERE id_rol = :id_rol AND rol = :rol");
    $stmt->execute(
        array(
            ':id_rol'  => $_POST["id_rol"],
            ':rol'    => $_POST["rol"]
        )
    );
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $cod = $fila["id_rol"];
        $rol = $fila["rol"];
    }

    if ($_POST["rol"] == $rol) {
        $stmt = $conexion->prepare("UPDATE roles SET rol = :rol WHERE id_rol = :id_rol");
        $resultado = $stmt->execute(
            array(
                ':rol'       => $_POST["rol"],
                ':id_rol'    => $_POST["id_rol"]
            )
        );
        $info = array(
            "mensaje"       => "REGISTRO MODIFICADO.!!!",
            "icono"         => "success",
            "exito"         => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_rol, rol FROM roles WHERE rol = :rol");
        $stmt->execute(
            array(
                ':rol'  => $_POST["rol"]
            )
        );
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"       => $_POST["rol"] . " YA EXISTE.\nINGRESE OTRO ROL.!!!",
                "icono"         => "warning",
                "exito"         => false
            );
        } else {
            $stmt = $conexion->prepare("UPDATE roles SET rol = :rol WHERE id_rol = :id_rol");
            $resultado = $stmt->execute(
                array(
                    ':rol'       => $_POST["rol"],
                    ':id_rol'    => $_POST["id_rol"]
                )
            );
            $info = array(
                "mensaje"       => "REGISTRO MODIFICADO.!!!",
                "icono"         => "success",
                "exito"         => true
            );
        }
    }
}
echo json_encode($info);
