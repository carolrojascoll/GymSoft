<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT id_proveedor, razon_social FROM proveedores WHERE ruc = :ruc");
$stmt->execute(array(':ruc' => $_POST["ruc"]));
$resultado = $stmt->fetchAll();
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        $salida = array();
        $salida["id_proveedor"] = $fila["id_proveedor"];
        $salida["razon"] = $fila["razon_social"];
        $salida["exito"] = true;
    }
} else {
    $salida["exito"] = false;
}

echo json_encode($salida);
