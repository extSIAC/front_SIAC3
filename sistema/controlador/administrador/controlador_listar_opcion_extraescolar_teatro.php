<?php
    require '../../modelo/modelo_administrador.php';
    $MU = new Modelo_Administrador();
    $consulta = $MU->listar_opcion_extraescolar_teatro();
    echo json_encode($consulta);
?>