<?php

    include("../conexion.php");

    if(isset($_POST['id_marca'])) {
        $datos = array();
        $stmt = $conexion->prepare("SELECT * FROM marcas WHERE id_marca = '".$_POST["id_marca"]."' LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $fila) {
            $datos["marca"] = $fila["marca"];
        }
        
        echo json_encode($datos);

    }