<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_ejercicio, ejercicio FROM ejercicios WHERE ejercicio = :ejercicio");
    $stmt->execute(array(':ejercicio'  => $_POST["ejercicio"]));
    $resultado = $stmt->fetchAll();
    if (count($resultado) > 0) {
        $info = array(
            "mensaje" => $_POST["ejercicio"] . " YA EXISTE.\n INGRESE OTRO EJERCICIO.!!!",
            "icono"   => "warning",
            "exito"   => false
        );
    } else {
        $stmt = $conexion->prepare("INSERT INTO ejercicios (ejercicio) VALUES (:ejercicio)");
        $resultado = $stmt->execute(
            array(
                ':ejercicio'   => $_POST["ejercicio"]
            )
        );
        $info = array(
            "mensaje" => "REGISTRO INSERTADO",
            "icono"   => "success",
            "exito"   => true
        );
    }
} else {
    $stmt = $conexion->prepare(
        "SELECT id_ejercicio, ejercicio FROM ejercicios WHERE id_ejercicio = :id_ejercicio");
    $stmt->execute(array(':id_ejercicio'  => $_POST["id_ejercicio"],));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $cod = $fila["id_ejercicio"];
        $ejercicio = $fila["ejercicio"];
    }

    if ($_POST["ejercicio"] == $ejercicio) {
        $stmt = $conexion->prepare("UPDATE ejercicios SET ejercicio = :ejercicio 
        WHERE ejercicio = :ejercicio");
        $resultado = $stmt->execute(
            array(
                ':ejercicio'       => $_POST["ejercicio"],
                ':id_ejercicio'    => $_POST["id_ejercicio"]
            )
        );
        $info = array(
            "mensaje"       => "REGISTRO MODIFICADO.!!!",
            "icono"         => "success",
            "exito"         => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_ejercicio, ejercicio FROM ejercicios WHERE ejercicio = :ejercicio");
        $stmt->execute(
            array(
                ':ejercicio'  => $_POST["ejercicio"]
            )
        );
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"       => $_POST["ejercicio"] . " YA EXISTE.\nINGRESE OTRO EJERCICIO.!!!",
                "icono"         => "warning",
                "exito"         => false
            );
        } else {
            $stmt = $conexion->prepare("UPDATE ejercicios SET ejercicio = :ejercicio WHERE id_ejercicio = :id_ejercicio");
            $resultado = $stmt->execute(
                array(
                    ':ejercicio'       => $_POST["ejercicio"],
                    ':id_ejercicio'    => $_POST["id_ejercicio"]
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
