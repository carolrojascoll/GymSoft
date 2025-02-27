<?php

include("../conexion.php");

if (isset($_POST['id_articulo'])) {
    $datos = array();
    $stmt = $conexion->prepare(
    "SELECT CONCAT(a.descripcion, ' ' , m.marca) as descripcion  
    FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
    WHERE a.id_articulo = '" . $_POST["id_articulo"] . "' LIMIT 1"
    );
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $datos["descripcion"] = $fila["descripcion"];
    }

    echo json_encode($datos);
}
