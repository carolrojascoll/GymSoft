<?php

include("../conexion.php");

if (isset($_POST["id_proveedor"])) {

    try {
        $stmt = $conexion->prepare("DELETE FROM proveedores WHERE id_proveedor = :id_proveedor");
        $resultado = $stmt->execute(
            array(
                ':id_proveedor'   => $_POST["id_proveedor"]
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
                "mensaje"       => "EL PROVEEDOR QUE DESEA ELIMINAR ESTA RELACIONADA CON OTROS REGISTROS.\n
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

    echo json_encode($info);
}
