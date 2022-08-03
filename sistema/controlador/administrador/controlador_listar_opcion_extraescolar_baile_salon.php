<?php
    require '../../modelo/modelo_administrador.php';
    $MU = new Modelo_Administrador();
    $consulta = $MU->listar_opcion_extraescolar_baile_salon();
    echo json_encode($consulta);
?>