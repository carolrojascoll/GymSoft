    <?php

    include("../conexion.php");

    $salida = array();
    $stmt = $conexion->prepare(
        "SELECT a.id_asistencia, a.id_cliente, c.razon_social,
        DATE_FORMAT(a.`entrada`, '%H:%i') AS entrada,
        DATE_FORMAT(NOW(), '%H:%i') AS salida   
        FROM asistencia a INNER JOIN clientes c ON a.id_cliente = c.id_cliente
        WHERE c.ruc = :ruc AND a.salida is null"
    );
    $stmt->execute(array(':ruc' => $_POST["ruc"]));
    $resultado = $stmt->fetchAll();
    if (count($resultado) > 0) {
        foreach ($resultado as $datos) {
            $salida["id_asistencia"]        = $datos["id_asistencia"];
            $salida["id_cliente"]           = $datos["id_cliente"];
            $salida["razon_social"]         = $datos["razon_social"];
            $salida["entrada"]              = $datos["entrada"];
            $salida["salida"]               = $datos["salida"];
            $salida["reg"]                  = true;
            $salida["count"]                = $stmt->rowCount();
        }
    } else {
        $stmt = $conexion->prepare(
            "SELECT id_cliente, razon_social, DATE_FORMAT(NOW(),'%H:%i') as entrada 
        FROM clientes WHERE ruc = :ruc"
        );
        $stmt->execute(array(':ruc' => $_POST["ruc"]));
        $datos = $stmt->fetchAll();
        foreach ($datos as $fila) {
            $salida["id_cliente"]       = $fila["id_cliente"];
            $salida["razon_social"]     = $fila["razon_social"];
            $salida["entrada"]          = $fila["entrada"];
            $salida["reg"]              = false;
            $salida["count"]            = $stmt->rowCount();
        }
    }

    echo json_encode($salida);
