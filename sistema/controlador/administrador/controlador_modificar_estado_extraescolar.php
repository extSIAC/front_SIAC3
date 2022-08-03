<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    $MOD_EXT_ID_EXTRAESCOLAR = htmlspecialchars($_POST['MOD_EXT_ID_EXTRAESCOLAR'],ENT_QUOTES,'UTF-8');
    $MOD_EXT_ESTADO = htmlspecialchars($_POST['MOD_EXT_ESTADO'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Modificar_Estado_Extraescolar($MOD_EXT_ID_EXTRAESCOLAR,$MOD_EXT_ESTADO);
    echo $consulta;

?>