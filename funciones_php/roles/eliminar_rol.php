<?php

include('../conexion.php');

if (isset($_POST["id_rol"])) {

    try {
        $stmt = $conexion->prepare("DELETE FROM roles WHERE id_rol = :id_rol");

        $resultado = $stmt->execute(
            array(
                ':id_rol'    => $_POST["id_rol"]
            )
        );
        $info = array(
            "icono"         => "success",
            "mensaje"       => "REGISTRO ELIMINADO.!!!",
            "boton"         => false,
            "timer"         => "1000"
        );
    } catch (PDOException $e) {
        $code = $e->getCode();
        if ($code == 23000) {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "EL ROL QUE DESEA ELIMINAR ESTA RELACIONADO CON OTROS REGISTROS.\n
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
