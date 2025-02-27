<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {

$stmt = $conexion->prepare("INSERT INTO medidas 
(id_cliente, espalda, pecho, bicep_izq, bicep_der, cintura, nalga,
muslo_izq, muslo_der, panto_izq, panto_der, peso, observacion, fecha) 
VALUES (:id_cliente, :espalda, :pecho, :bicep_izq, :bicep_der, :cintura, :nalga,
:muslo_izq, :muslo_der, :panto_izq, :panto_der, :peso, :observacion, :fecha)");
    $stmt->execute(
        array(
            ':id_cliente'        => $_POST["id_cliente"],
            ':espalda'           => $_POST["espalda"],
            ':pecho'             => $_POST["pecho"],
            ':bicep_izq'         => $_POST["bicep_izq"],
            ':bicep_der'         => $_POST["bicep_der"],
            ':cintura'           => $_POST["cintura"],
            ':nalga'             => $_POST["nalga"],
            ':muslo_izq'         => $_POST["muslo_izq"],
            ':muslo_der'         => $_POST["muslo_der"],
            ':panto_izq'         => $_POST["panto_izq"],
            ':panto_der'         => $_POST["panto_der"],
            ':peso'              => $_POST["peso"],
            ':fecha'              => $_POST["fecha"],
            ':observacion'       => $_POST["observacion"],
        )
    );

    $info = array(
        "mensaje"       => "REGISTRO INSERTADO",
        "icono"         => "success",
        "exito"         => true
    );
} else {
    $stmt = $conexion->prepare("UPDATE medidas SET
espalda = :espalda, pecho = :pecho, bicep_izq = :bicep_izq, bicep_der = :bicep_der, cintura = :cintura, nalga = :nalga,
muslo_izq = :muslo_izq, muslo_der = :muslo_der, panto_izq = :panto_izq, panto_der = :panto_der, peso = :peso,
observacion = :observacion, fecha = :fecha WHERE id_medida = :id_medida");
    $stmt->execute(
        array(
            ':espalda'           => $_POST["espalda"],
            ':pecho'             => $_POST["pecho"],
            ':bicep_izq'         => $_POST["bicep_izq"],
            ':bicep_der'         => $_POST["bicep_der"],
            ':cintura'           => $_POST["cintura"],
            ':nalga'             => $_POST["nalga"],
            ':muslo_izq'         => $_POST["muslo_izq"],
            ':muslo_der'         => $_POST["muslo_der"],
            ':panto_izq'         => $_POST["panto_izq"],
            ':panto_der'         => $_POST["panto_der"],
            ':peso'              => $_POST["peso"],
            ':observacion'       => $_POST["observacion"],
            ':fecha'       => $_POST["fecha"],
            ':id_medida'         => $_POST["id_medida"]
        )
    );
    $info = array(
        "mensaje"       => "REGISTRO MODIFICADO.!!!",
        "icono"         => "success",
        "exito"         => true
    );
}

echo json_encode($info);
