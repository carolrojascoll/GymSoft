<?php

    include("../conexion.php");

    if(isset($_POST['id_ciudad'])) {
        $datos = array();
        $stmt = $conexion->prepare("SELECT * FROM ciudades WHERE id_ciudad = '".$_POST["id_ciudad"]."' LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $fila) {
            $datos["ciudad"] = $fila["ciudad"];
        }
        
        echo json_encode($datos);

    }