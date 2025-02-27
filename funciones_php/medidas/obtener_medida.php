<?php

include("../conexion.php");

$salida = array();
$stmt = $conexion->prepare("SELECT m.`id_medida`, c.razon_social, m.id_cliente, c.ruc,
FORMAT(m.espalda, 0, 'de_DE') AS espalda,
FORMAT(m.pecho, 0, 'de_DE') AS pecho,
FORMAT(m.bicep_izq, 0, 'de_DE') AS bicep_izq,
FORMAT(m.bicep_der, 0, 'de_DE') AS bicep_der,
FORMAT(m.cintura, 0, 'de_DE') AS cintura,
FORMAT(m.nalga, 0, 'de_DE') AS nalga,
FORMAT(m.muslo_izq, 0, 'de_DE') AS muslo_izq,
FORMAT(m.muslo_der, 0, 'de_DE') AS muslo_der,
FORMAT(m.panto_izq, 0, 'de_DE') AS panto_izq,
FORMAT(m.panto_der, 0, 'de_DE') AS panto_der,
FORMAT(m.peso, 0, 'de_DE') AS peso,
m.`observacion`, m.`fecha` 
FROM medidas m INNER JOIN clientes c ON m.id_cliente = c.id_cliente
WHERE id_medida = :id_medida");
$stmt->execute(array(':id_medida' => $_POST["id_medida"]));
$resultado = $stmt->fetchAll();
foreach ($resultado as $fila) {
    $salida["id_cliente"] = $fila["id_cliente"];
    $salida["razon_social"] = $fila["razon_social"];
    $salida["ruc"] = $fila["ruc"];
    $salida["espalda"] = $fila["espalda"];
    $salida["pecho"] = $fila["pecho"];
    $salida["bicep_izq"] = $fila["bicep_izq"];
    $salida["bicep_der"] = $fila["bicep_der"];
    $salida["cintura"] = $fila["cintura"];
    $salida["nalga"] = $fila["nalga"];
    $salida["muslo_izq"] = $fila["muslo_izq"];
    $salida["muslo_der"] = $fila["muslo_der"];
    $salida["panto_izq"] = $fila["panto_izq"];
    $salida["panto_der"] = $fila["panto_der"];
    $salida["peso"] = $fila["peso"];
    $salida["observacion"] = $fila["observacion"];
    $salida["fecha"] = $fila["fecha"];
}
echo json_encode($salida);
