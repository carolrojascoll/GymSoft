<?php

    include("../conexion.php");
    include("../funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT * FROM ejercicios ";

    if (isset($_POST["search"]["value"])) {
        $query .= 'WHERE ejercicio LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';
    } else {
        $query .= ' ORDER BY id_ejercicio';
    }

    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila) {
        $sub_array = array();
        $sub_array[] = $fila["id_ejercicio"];
        $sub_array[] = $fila["ejercicio"]; 
        $sub_array[] = '<button type="button" name="editar" id="'.$fila["id_ejercicio"].'" 
        class="btn btn-primary btn-xs editar"><i class="bi bi-pencil-square"></i></button>';
        $sub_array[] = '<button type="button" name="borrar" id="'.$fila["id_ejercicio"].'" 
        class="btn btn-danger btn-xs borrar"><i class="bi bi-trash3"></i></button>';
        $datos[] = $sub_array;  
    }

    $salida = array(
        "draw"              => intval($_POST["draw"]),
        "recordsTotal"      => $filtered_rows,
        "recordsFiltered"   => obtener_ejercicios(),
        "data"              => $datos
    );

    echo json_encode($salida);

