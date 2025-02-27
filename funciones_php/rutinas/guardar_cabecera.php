<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT descripcion FROM rutina_cabecera WHERE descripcion = :descripcion");
$stmt->execute(array(':descripcion' => $_POST["descripcion"]));
$resultado = $stmt->fetchAll();
if (empty($resultado)) {
    $stmt = $conexion->prepare("INSERT INTO rutina_cabecera (id_rutina, descripcion) VALUES (:id_rutina, :descripcion)");
    $stmt->execute(
        array(
            ':id_rutina' => $_POST["id_rutina"],
            ':descripcion' => $_POST["descripcion"]
        )
    );
    $info = array(
        'mensaje'   => "RUTINA REGISTRADA.!!!",
        'icono'     => "success",
        'exito'     => true
    );
} else {
    $info = array(
        'mensaje'   => "LA DESCRIPCIÓN INGRESADA YA EXISTE.\nINGRESE OTRA DESCRIPCIÓN.!!!",
        'icono'     => "warning",
        'exito'     => false
    );
}

echo json_encode($info);
