<?php

include("../conexion.php");

if (isset($_POST['id_articulo'])) {

    $datos = array();
    $stmt = $conexion->prepare(
        "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, a.id_iva,
        FORMAT(a.stock_actual, 0, 'de_DE') as stock_actual,
        FORMAT(a.precio_compra, 0, 'de_DE') as precio_compra,
        FORMAT(a.porcent_ganancia, 0, 'de_DE') as porcent_ganancia,
        FORMAT(a.precio_venta, 0, 'de_DE') as precio_venta
        FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
        INNER JOIN iva i ON a.id_iva = i.id_iva 
        WHERE id_articulo = '" . $_POST["id_articulo"] . "' LIMIT 1"
    );
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $datos["codigo"] = $fila["codigo"];
        $datos["descripcion"] = $fila["descripcion"];
        $datos["marca"] = $fila["id_marca"];
        $datos["iva"] = $fila["id_iva"];
        $datos["stock"] = $fila["stock_actual"];
        $datos["p_compra"] = $fila["precio_compra"];
        $datos["porcent"] = $fila["porcent_ganancia"];
        $datos["p_venta"] = $fila["precio_venta"];
    }
    echo json_encode($datos);
}
