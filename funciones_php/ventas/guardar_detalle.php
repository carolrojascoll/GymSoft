<?php

include("../conexion.php");

$stmt = $conexion->prepare("INSERT INTO detalle_venta 
(id_venta, id_articulo, id_marca, id_iva, cantidad, precio, subtotal_iva0, subtotal_iva5, subtotal_iva10) 
VALUES (:id_venta, :id_articulo, :id_marca, :id_iva, :cantidad, :precio, :subtotal_iva0, :subtotal_iva5, :subtotal_iva10)");
$stmt->execute(array(
    ':id_venta'            => $_POST["id_venta"],
    ':id_articulo'          => $_POST["id_articulo"],
    ':id_marca'             => $_POST["id_marca"],
    ':id_iva'               => $_POST["id_iva"],
    ':cantidad'             => $_POST["cantidad"],
    ':precio'               => $_POST["precio"],
    ':subtotal_iva0'        => $_POST["subtotal_iva0"],
    ':subtotal_iva5'        => $_POST["subtotal_iva5"],
    ':subtotal_iva10'       => $_POST["subtotal_iva10"]
));

$info = array(
    'mensaje' => 'Detalle Guardado',
);

echo json_encode($info);
