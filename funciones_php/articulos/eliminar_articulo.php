<?php

include('../conexion.php');

if (isset($_POST["id_articulo"])) {

    $info = array();

    try {
        $stmt = $conexion->prepare("DELETE FROM articulos WHERE id_articulo = :id_articulo");

        $resultado = $stmt->execute(
            array(
                'id_articulo'    => $_POST["id_articulo"]
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
                "mensaje"       => "EL ARTÍCULO QUE DESEA ELIMINAR ESTA RELACIONADO CON OTROS REGISTROS.\n
                                    NO SE PODRA ELIMINAR.!!!",
                "boton"         => true,
                "timer"         => "3000"
            );
        } else {
            $info = array(
                "icono"         => "error",
                "mensaje"       => "HA OCURRIDO UN ERROR AL INTENTAR ELIMINAR\nFAVOR INFORMAR A SOPORTEz.!!!",
                "boton"         => true,
                "timer"         => "3000"
            );
        }
    }
}

echo json_encode($info);
