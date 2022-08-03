<?php
    require '../../modelo/modelo_administrador.php';
    $MU = new Modelo_Administrador();
    $consulta = $MU->listar_opcion_administrador();
    echo json_encode($consulta);
?>