<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    $MOD_ADM_ID_ADMINISTRADOR = htmlspecialchars($_POST['MOD_ADM_ID_ADMINISTRADOR'],ENT_QUOTES,'UTF-8');
    $MOD_ADM_ESTADO = htmlspecialchars($_POST['MOD_ADM_ESTADO'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Modificar_Estado_Administrador($MOD_ADM_ID_ADMINISTRADOR,$MOD_ADM_ESTADO);
    echo $consulta;

?>