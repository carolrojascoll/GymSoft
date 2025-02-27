<?php

include("../conexion.php");

$stmt = $conexion->prepare("UPDATE articulos 
SET stock_actual = (stock_actual - :cantidad) WHERE id_articulo = :id_articulo");

$stmt->execute(
    array(
        ':cantidad'             => $_POST["cantidad"],
        ':id_articulo'          => $_POST["id_articulo"]
    )
);

$info = array(
    'mensaje' => "Stock actualizado"
);

echo json_encode($info);
