<?php

include("../conexion.php");

$salida = array();
$stmt = $conexion->prepare("SELECT id_cliente, razon_social, sexo FROM clientes WHERE ruc = :ruc");
$stmt->execute(array(':ruc' => $_POST["ruc"]));
$resultado = $stmt->fetchAll();
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        $salida["id_cliente"] = $fila["id_cliente"];
        $salida["razon_social"] = $fila["razon_social"];
        $salida["sexo"] = $fila["sexo"];
        $salida["encontrado"] = true;
    }
} else {
    $salida["encontrado"] = false;
}
echo json_encode($salida);
