<?php

include("../conexion.php");

try {
    $stmt = $conexion->prepare("UPDATE cabecera_compra 
    SET pagado = 'Si', efectivo = :efectivo, transferencia = :transferencia,
    cheque = :cheque, importe = :importe, vuelto = :vuelto WHERE id_compra = :id_compra");
    $stmt->execute(
        array(
            ':efectivo'             => $_POST["efectivo"],
            ':transferencia'        => $_POST["transferencia"],
            ':cheque'               => $_POST["cheque"],
            ':importe'              => $_POST["importe"],
            ':vuelto'               => $_POST["vuelto"],
            ':id_compra'            => $_POST["id_compra"]
        )
    );
    $info = array(
        'mensaje'   => 'Pago realizado con éxito',
        'icono'     => 'success',
        'exito'     => true
    );
} catch (PDOException $e) {
    $info = array(
        'exito'     => false
    );
}

echo json_encode($info);
