<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    $MOD_PRO_ID_PROMOTOR = htmlspecialchars($_POST['MOD_PRO_ID_PROMOTOR'],ENT_QUOTES,'UTF-8');
    $MOD_PRO_ESTADO = htmlspecialchars($_POST['MOD_PRO_ESTADO'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Modificar_Estado_Promotor($MOD_PRO_ID_PROMOTOR,$MOD_PRO_ESTADO);
    echo $consulta;

?>