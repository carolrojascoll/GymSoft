<?php

include("../conexion.php");

if (isset($_POST["id_usuario"])) {
    try {
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
        $resultado = $stmt->execute(
            array(
                ':id_usuario'   => $_POST["id_usuario"]
            )
        );
        $info = array(
            'mensaje'   => "REGISTRO ELIMINADO",
            'icono'     => "success",
            'timer'     => 1500
        );
    } catch (PDOException $e) {
        $code = $e->getCode();
        if ($code == 23000) {
            $info = array(
                'mensaje'   => "EL USUARIO QUE DESEA ELIMINAR ESTA RELACIONADO CON OTROS REGISTROS.!!!\n
                NO SE PODRA ELIMINAR",
                'icono'     => "error",
                'timer'     => 3000
            );
        } else {
            $info = array(
                'mensaje'   => "HA OCURRIDO UN ERROR.\nFAVOR DE INFORMAR A SOPORTE.!!!",
                'icono'     => "error",
                'timer'     => 3000
            );
        }
    }
    echo json_encode($info);
}
