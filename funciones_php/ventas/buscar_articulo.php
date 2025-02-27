<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT a.id_articulo, CONCAT(a.descripcion,' ',m.marca) as descripcion,
CONCAT(i.tipo_iva,' %') as iva, m.id_marca, i.id_iva, a.precio_venta, 
FORMAT(a.stock_actual, 0, 'de_DE') as stock_actual
FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca 
INNER JOIN iva i ON a.id_iva = i.id_iva 
WHERE a.codigo = :codigo");
$stmt->execute(array(':codigo' => $_POST["codigo"]));
$resultado = $stmt->fetchAll();
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        $salida = array();
        $salida["id_articulo"]          = $fila["id_articulo"];
        $salida["descripcion"]          = $fila["descripcion"];
        $salida["iva"]                  = $fila["iva"];
        $salida["id_marca"]             = $fila["id_marca"];
        $salida["id_iva"]               = $fila["id_iva"];
        $salida["precio_venta"]         = $fila["precio_venta"];
        $salida["stock_actual"]         = $fila["stock_actual"];
        $salida["exito"]                = true;
    }
} else {
    $salida["exito"] = false;
}

echo json_encode($salida);
