<?php

include("../conexion.php");

$stmt = $conexion->prepare(
    "SELECT u.id_usuario , u.usuario, CONCAT(e.nombre, ' ', e.apellido) as nombre 
    FROM usuarios u join entrenadores e on u.id_entrenador = e.id_entrenador
    WHERE u.usuario = :usuario AND u.contrasena = md5(:contrasena)"
);
$stmt->execute(
    array(
        ':usuario'  => $_POST["user"],
        ':contrasena'  => $_POST["pass"]
    )
);
$resultado = $stmt->fetchAll();
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        $salida = array(
            'acceso'    => true,
            'usuario'   => $fila["usuario"],
            'nombre'    => $fila["nombre"]
        );
    }
} else {
    $salida = array(
        'acceso'    => false,
    );
}
echo json_encode($salida);
