<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_ciudad, ciudad FROM ciudades WHERE ciudad = :ciudad");
    $stmt->execute(array(':ciudad'  => $_POST["ciudad"]));
    $resultado = $stmt->fetchAll();
    if (count($resultado) > 0) {
        $info = array(
            "mensaje" => $_POST["ciudad"] . " YA EXISTE.\n INGRESE OTRA CIUDAD.!!!",
            "icono"   => "warning",
            "exito"   => false
        );
    } else {
        $stmt = $conexion->prepare("INSERT INTO ciudades (ciudad) VALUES (:ciudad)");
        $resultado = $stmt->execute(
            array(
                ':ciudad'   => $_POST["ciudad"]
            )
        );
        $info = array(
            "mensaje" => "REGISTRO INSERTADO",
            "icono"   => "success",
            "exito"   => true
        );
    }
} else {
    $stmt = $conexion->prepare("SELECT id_ciudad, ciudad FROM ciudades WHERE id_ciudad = :id_ciudad AND ciudad = :ciudad");
    $stmt->execute(
        array(
            ':id_ciudad'  => $_POST["id_ciudad"],
            ':ciudad'    => $_POST["ciudad"]
        )
    );
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $cod = $fila["id_ciudad"];
        $ciudad = $fila["ciudad"];
    }

    if ($_POST["ciudad"] == $ciudad) {
        $stmt = $conexion->prepare("UPDATE ciudades SET ciudad = :ciudad WHERE id_ciudad = :id_ciudad");
        $resultado = $stmt->execute(
            array(
                ':ciudad'       => $_POST["ciudad"],
                ':id_ciudad'    => $_POST["id_ciudad"]
            )
        );
        $info = array(
            "mensaje"       => "REGISTRO MODIFICADO.!!!",
            "icono"         => "success",
            "exito"         => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_ciudad, ciudad FROM ciudades WHERE ciudad = :ciudad");
        $stmt->execute(
            array(
                ':ciudad'  => $_POST["ciudad"]
            )
        );
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"       => $_POST["ciudad"] . " YA EXISTE.\nINGRESE OTRA CIUDAD.!!!",
                "icono"         => "warning",
                "exito"         => false
            );
        } else {
            $stmt = $conexion->prepare("UPDATE ciudades SET ciudad = :ciudad WHERE id_ciudad = :id_ciudad");
            $resultado = $stmt->execute(
                array(
                    ':ciudad'       => $_POST["ciudad"],
                    ':id_ciudad'    => $_POST["id_ciudad"]
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
