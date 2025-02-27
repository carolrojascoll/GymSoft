<?php

include('../conexion.php');

if (isset($_POST["id_ciudad"])) {

    try {
        $stmt = $conexion->prepare("DELETE FROM ciudades WHERE id_ciudad = :id_ciudad");

        $resultado = $stmt->execute(
            array(
                ':id_ciudad'    => $_POST["id_ciudad"]
            )
        );
        $info = array(
            "icono"         => "success",
            "mensaje"       => "REGISTRO ELIMINADO.!!!",
            "timer"         => "1500"
        );
    } catch (PDOException $e) {
        $code = $e->getCode();
        if ($code == 23000) {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "LA CIUDAD QUE DESEA ELIMINAR ESTA RELACIONADA CON OTROS REGISTROS.\n
                                    NO SE PODRA BORRAR LO.!!!",
                "timer"         => "3000"
            );
        } else {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "HA OCURRIDO UN ERROR AL INTENTAR ELIMINAR EL REGISTRO.!!!",
                "boton"         => true,
                "timer"         => "3000"
            );
        }
    }
}

echo json_encode($info);
