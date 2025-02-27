<?php

include("../conexion.php");

$stmt = $conexion->prepare(
    "UPDATE asistencia SET salida = NOW() 
        WHERE id_cliente = :id_cliente 
        AND entrada BETWEEN CONCAT(CURDATE(), ' 00:00:00') 
        AND CONCAT(CURDATE(), ' 23:59:59')"
);
$stmt->execute(
    array(
        ':id_cliente'   => $_POST["id_cliente"]
    )
);

$info = array(
    "mensaje"       => "SALIDA REGISTRADA",
    "icono"         => "success"
);

echo json_encode($info);
