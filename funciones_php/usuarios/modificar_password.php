<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT contrasena FROM usuarios WHERE id_usuario = :id_usuario");
$stmt->execute(array(':id_usuario' => $_POST["id_usuario"]));
$resultado = $stmt->fetchAll();
foreach ($resultado as $fila) {
    $pass = $fila["contrasena"];
}

if ($_POST["anterior"] == $pass) {
    $info = array(
        'exito'    => false
    );
} else {
    $stmt = $conexion->prepare("UPDATE usuarios SET contrasena = md5(:contrasena) 
    WHERE id_usuario = :id_usuario");
    $stmt->execute(
        array(
            ':contrasena'   => $_POST["contrasena"],
            ':id_usuario'  => $_POST["id_usuario"]
        )
    );
    $info = array(
        'mensaje'   => "CONTRASEÑA MODIFICADA.\nPOR FAVOR VUELVA A INICIAR SESIÓN.!!!",
        'icono'     => "success",
        'exito'     => true
    );
}
echo json_encode($info);
