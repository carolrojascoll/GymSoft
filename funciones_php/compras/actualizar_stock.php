<?php

include("../conexion.php");

$stmt = $conexion->prepare("UPDATE articulos
SET stock_actual = (stock_actual + :cantidad), precio_compra = :precio_compra, porcent_ganancia = :porcent_ganancia 
WHERE id_articulo = :id_articulo");

$stmt->execute(
    array(
        ':cantidad'             => $_POST["cantidad"],
        ':precio_compra'        => $_POST["precio_compra"],
        ':porcent_ganancia'     => $_POST["porcent_ganancia"],
        ':id_articulo'          => $_POST["id_articulo"]
    )
);

$info = array(
    'mensaje' => "Stock actualizado"
);

echo json_encode($info);
