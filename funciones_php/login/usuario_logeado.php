<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT u.id_usuario ,CONCAT(e.nombre, ' ',e.apellido) AS entrenador, 
c.ciudad, e.direccion, e.telefono,
TIMESTAMPDIFF(YEAR, e.fecha_nac, CURDATE()) as edad, r.rol, u.imagen, e.id_entrenador
FROM usuarios u INNER JOIN entrenadores e ON u.id_entrenador = e.id_entrenador 
INNER JOIN roles r ON u.id_rol = r.id_rol 
INNER JOIN ciudades c ON e.id_ciudad = c.id_ciudad 
WHERE u.usuario = :usuario");
$stmt->execute(array(':usuario' => $_POST["usuario"]));
$resultado = $stmt->fetchAll();
foreach ($resultado as $fila) {
    $datos = array(
        'id'                => $fila["id_usuario"],
        'imagen'            => $fila["imagen"],
        'id_usuario'        => $fila["id_usuario"],
        'entrenador'        => '<label class = "text-white">Nombre: ' . $fila["entrenador"] . '</label>',
        'ciudad'            => '<label class = "text-white">Ciudad: ' . $fila["ciudad"] . '</label>',
        'direccion'         => '<label class = "text-white">Dirección: ' . $fila["direccion"] . '</label>',
        'telefono'          => '<label class = "text-white">Teléfono: ' . $fila["telefono"] . '</label>',
        'edad'              => '<label class = "text-white">Edad: ' . $fila["edad"] . '</label>',
        'rol'               => '<label class = "text-white">Rol: ' . $fila["rol"] . '</label>',
        'id_entrenador'     => $fila["id_entrenador"]
    );
}

echo json_encode($datos);
