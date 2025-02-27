<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
    "SELECT m.`id_medida`, c.razon_social,
    FORMAT(m.espalda, 0, 'de_DE') AS espalda,
    FORMAT(m.pecho, 0, 'de_DE') AS pecho,
    CONCAT(FORMAT(m.bicep_izq, 0, 'de_DE'), ' - ', FORMAT(m.bicep_der, 0, 'de_DE')) AS biceps,
    FORMAT(m.cintura, 0, 'de_DE') AS cintura,
    FORMAT(m.nalga, 0, 'de_DE') AS nalga,
    CONCAT(FORMAT(m.muslo_izq, 0, 'de_DE'), ' - ', FORMAT(m.muslo_der, 0, 'de_DE')) AS muslos,
    CONCAT(FORMAT(m.panto_izq, 0, 'de_DE'), ' - ', FORMAT(m.panto_der, 0, 'de_DE')) AS pantorrillas,
    FORMAT(m.peso, 0, 'de_DE') AS peso,
    m.`observacion`,
    DATE_FORMAT(m.`fecha`,'%d/%m/%Y') AS fecha
    FROM medidas m INNER JOIN clientes c ON m.id_cliente = c.id_cliente 
    WHERE m.fecha BETWEEN :desde AND :hasta";

if (isset($_POST["search"]["value"])) {
    $query .= ' AND c.razon_social LIKE "%' . $_POST["search"]["value"] . '%"';
    $query .= ' AND m.peso LIKE "%' . $_POST["search"]["value"] . '%"';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST["order"]['0']["colum"] . ' ' . $_POST["order"][0]["dir"] . ' ';
} else {
    $query .= ' ORDER BY c.razon_social';
}

$stmt = $conexion->prepare($query);
$stmt->execute(
    array(
        ':desde' => $_POST["desde"],
        ':hasta' => $_POST["hasta"]
    )
);
$resultado = $stmt->fetchAll();
$filtered_rows = $stmt->rowCount();
$datos = array();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["id_medida"];
    $sub_array[] = $fila["razon_social"];
    $sub_array[] = $fila["espalda"];
    $sub_array[] = $fila["pecho"];
    $sub_array[] = $fila["biceps"];
    $sub_array[] = $fila["cintura"];
    $sub_array[] = $fila["nalga"];
    $sub_array[] = $fila["muslos"];
    $sub_array[] = $fila["pantorrillas"];
    $sub_array[] = $fila["peso"];
    $sub_array[] = $fila["observacion"];
    $sub_array[] = $fila["fecha"];
    $sub_array[] = '<button type="button" name="editar" id="' . $fila["id_medida"] . '" 
        class="btn btn-primary btn-xs editar"><i class="bi bi-pencil-square"></i></button>';
    $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_medida"] . '" 
        class="btn btn-danger btn-xs borrar"><i class="bi bi-trash3"></i></button>';
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => obtener_medidas(),
    "data"              => $datos
);

echo json_encode($salida);
