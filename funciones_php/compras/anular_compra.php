<?php

include("../conexion.php");
try {
    $stmt = $conexion->prepare("UPDATE cabecera_compra SET anulado = 'Si' WHERE id_compra = :id_compra");
    $stmt->execute(array(':id_compra' => $_POST["id_compra"]));
    $info = array(
        'mensaje'   => 'Compra anulada.!!!',
        'icono'     => 'success',
        'exito'     =>  true     
    );
} catch (PDOException $e) {
    $info = array(
        'mensaje'   => 'Ocurrio un error al tratar de anular la compra.!!!',
        'icono'     => 'error',
        'exito'     =>  false     
    );
}

echo json_encode($info);