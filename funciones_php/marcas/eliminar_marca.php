<?php

include('../conexion.php');

if (isset($_POST["id_marca"])) {

    $info = array();

    try {
        $stmt = $conexion->prepare("DELETE FROM marcas WHERE id_marca = :id_marca");

        $resultado = $stmt->execute(
            array(
                'id_marca'    => $_POST["id_marca"]
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
                "mensaje"       => "LA MARCA QUE DESEA ELIMINAR ESTA RELACIONADA CON OTROS REGISTROS.\n
                                    NO SE PODRA ELIMINAR.!!!",
                "timer"         => "3000"
            );
        } else {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "HA OCURRIDO UN ERROR AL INTENTAR ELIMINAR\nFAVOR DE INFORMAR A SOPORTE.!!!",
                "boton"         => true,
                "timer"         => "3000"
            );
        }
    }
}

echo json_encode($info);
