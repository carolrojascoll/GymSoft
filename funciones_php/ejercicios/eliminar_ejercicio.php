<?php

include("../conexion.php");

if (isset($_POST["id_ejercicio"])) {

    try {

        $stmt = $conexion->prepare("DELETE FROM ejercicios WHERE id_ejercicio = :id_ejercicio");

        $resultado = $stmt->execute(
            array(
                ':id_ejercicio'    => $_POST["id_ejercicio"]
            )
        );

        $info = array(
            "mensaje"       => "REGISTRO ELIMINADO.!!!",
            "icono"         => "success",
            "timer"         => "1500"
        );
    } catch (PDOException $e) {
        $code = $e->getCode();
        if ($code == 23000) {
            $info = array(
                "mensaje"       => "EL EJERCICIO QUE DESEA ELIMINAR ESTA RELACIONADO 
                                    CON OTROS REGISTROS \nNO SE PODRA ELIMINAR.!!!",
                "icono"         => "error",
                "timer"         => "3000"
            );
        } else {
            $info = array(
                "mensaje"       => "HA OCURRIDO UN ERROR AL INTENTAR ELIMINAR\nFAVOR DE INFORMAR A SOPORTE",
                "icono"         => "error",
                "timer"         => "3000"
            );
        }
    }
    echo json_encode($info);
}
