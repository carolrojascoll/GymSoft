<?php

include("../conexion.php");

try {
    $stmt = $conexion->prepare("DELETE FROM medidas WHERE id_medida = :id_medida");
    $stmt->execute(array(':id_medida' => $_POST["id_medida"]));
    $info = array(
        "mensaje"   => "REGISTRO ELIMINADO.!!!",
        "icono"     => "success",
        "timer"     => 1500,
        "exito"     => true
    );
} catch (PDOException $e) {
    $code = $e->getCode();
    if ($code == 23000) {
        $info = array(
            "mensaje"   => "LA MEDIDAS QUE INTENTA ELIMINAR ESTAN RELACIONADAS\nCON OTROS REGISTROS\nNO SE PODRA ELIMINAR.!!!",
            "icono"     => "error",
            "timer"     => 3000,
            "exito"     => false
        );
    } else {
        $info = array(
            "mensaje"   => "HA OCURRIDO UN ERROR.\nFAVOR DE INFORMAR A SOPORTE.!!!",
            "icono"     => "error",
            "timer"     => 3000,
            "exito"     => false
        );
    }
}

echo json_encode($info);
