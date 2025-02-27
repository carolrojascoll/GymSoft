<?php

include("../conexion.php");

$stmt = $conexion->prepare("INSERT INTO cabecera_venta 
(id_venta, id_cliente, id_entrenador, num_factura, timbrado, condicion, fecha, total_iva0, total_iva5, total_iva10, total_venta, pagado, 
efectivo, transferencia, cheque, importe, vuelto) 
VALUES (:id_venta, :id_cliente, :id_entrenador, :num_factura, :timbrado, :condicion, :fecha, :total_iva0, :total_iva5, :total_iva10, 
:total_venta, :pagado, :efectivo, :transferencia, :cheque, :importe, :vuelto)");
$stmt->execute(array(
    ':id_venta'             => $_POST["id_venta"],
    ':id_cliente'           => $_POST["id_cliente"],
    ':id_entrenador'        => $_POST["id_entrenador"],
    ':num_factura'          => $_POST["num_fac"],
    ':timbrado'             => $_POST["timbrado"],
    ':condicion'            => $_POST["condicion"],
    ':fecha'                => $_POST["fecha"],
    ':total_iva0'           => $_POST["total_iva0"],
    ':total_iva5'           => $_POST["total_iva5"],
    ':total_iva10'          => $_POST["total_iva10"],
    ':total_venta'          => $_POST["total_venta"],
    ':pagado'               => $_POST["pagado"],
    ':efectivo'             => $_POST["efectivo"],
    ':transferencia'        => $_POST["transferencia"],
    ':cheque'               => $_POST["cheque"],
    ':importe'              => $_POST["importe"],
    ':vuelto'               => $_POST["vuelto"],
));

$info = array(
    'mensaje' => 'VENTA REGISTRADA.!!!',
    'icono' => 'success',
    'exito' => true,
);

echo json_encode($info);
