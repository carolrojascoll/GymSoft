<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT MAX(id_venta)+ 1 FROM cabecera_venta");
$stmt->execute();
$resultado = $stmt->fetchAll();
foreach ($resultado as $fila) {
    if ($fila[0] == null) {
        $id_compra = 1;
    } else {
        $id_compra = $fila[0];
    }
}

$valor = array("result" => $id_compra);

echo json_encode($valor);
