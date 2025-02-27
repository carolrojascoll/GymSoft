<?php

header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

    include("../conexion.php");
    include("../funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT * FROM rutina_cabecera ";

    if (isset($_POST["search"]["value"])) {
        $query .= 'WHERE descripcion LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';
    } else {
        $query .= ' ORDER BY id_rutina';
    }

    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila) {
        $sub_array = array();
        $sub_array[] = $fila["id_rutina"];
        $sub_array[] = $fila["descripcion"]; 
        $sub_array[] = '<button type="button" name="eliminar" id="'.$fila["id_rutina"].'" 
        class="btn btn-danger btn-xs eliminar"><i class="bi bi-trash3"></i></button>';
        $sub_array[] = '<button type="button" name="detalle" id="'.$fila["id_rutina"].'" 
        class="btn btn-warning bg-gradient btn-xs detalle"><i class="bi bi-list-columns-reverse"></i></button>';
        $datos[] = $sub_array;  
    }

    $salida = array(
        "draw"              => intval($_POST["draw"]),
        "recordsTotal"      => $filtered_rows,
        "recordsFiltered"   => obtener_rutinas(),
        "data"              => $datos
    );

    echo json_encode($salida);

