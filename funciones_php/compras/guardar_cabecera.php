<?php

include("../conexion.php");

$stmt = $conexion->prepare("INSERT INTO cabecera_compra 
(id_compra,id_proveedor, num_factura, timbrado, condicion, fecha, total_iva0, total_iva5, total_iva10, total_compra) 
VALUES (:id_compra, :id_proveedor, :num_factura, :timbrado, :condicion, :fecha, :total_iva0, :total_iva5, :total_iva10, :total_compra)");
$stmt->execute(array(
    ':id_compra' => $_POST["id_compra"],
    ':id_proveedor' => $_POST["id_proveedor"],
    ':num_factura' => $_POST["num_fac"],
    ':timbrado' => $_POST["timbrado"],
    ':condicion' => $_POST["condicion"],
    ':fecha' => $_POST["fecha"],
    ':total_iva0' => $_POST["total_iva0"],
    ':total_iva5' => $_POST["total_iva5"],
    ':total_iva10' => $_POST["total_iva10"],
    ':total_compra' => $_POST["total_compra"]
));

$info = array(
    'mensaje' => 'COMPRA REGISTRADA.!!!',
    'icono' => 'success',
    'exito' => true,
);

echo json_encode($info);