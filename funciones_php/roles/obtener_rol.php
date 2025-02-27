<?php

    include("../conexion.php");

    if(isset($_POST['id_rol'])) {
        $datos = array();
        $stmt = $conexion->prepare("SELECT * FROM roles WHERE id_rol = '".$_POST["id_rol"]."' LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $fila) {
            $datos["rol"] = $fila["rol"];
        }
        
        echo json_encode($datos);

    }