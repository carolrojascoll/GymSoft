<?php

include("../conexion.php");

if (isset($_POST["id_cliente"])) {

    try {
        $stmt = $conexion->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");

        $resultado = $stmt->execute(
            array(
                ':id_cliente'   => $_POST["id_cliente"]
            )
        );
        $info = array(
            "icono"         => "succes",
            "mensaje"       => "REGISTRO ELIMINADO.!!!",
            "timer"         => "1500"
        );
    } catch (PDOException $e) {
        $code = $e->getCode();
        if ($code == 23000) {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "EL CLIENTE QUE DESEA ELIMINAR ESTA RELACIONADO CON OTROS REGISTROS.\n
                                    NO SE PODRA ELIMINAR.!!!",
                "timer"         => "3000"
            );
        } else {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "HA OCURRIDO UN ERROR AL INTENTAR ELIMINAR\nFAVOR DE INFORMAR A SOPORTE.!!!",
                "timer"         => "3000"
            );
        }
    }
    echo json_encode($info);
}
