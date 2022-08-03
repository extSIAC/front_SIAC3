<?php
    require '../../modelo/modelo_administrador.php';
    $MU = new Modelo_Administrador();
    $consulta = $MU->listar_opcion_lugar();
    echo json_encode($consulta);
?>