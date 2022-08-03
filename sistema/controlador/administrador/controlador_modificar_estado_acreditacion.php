<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    $MOD_INS_ID_INSCRIPCION = htmlspecialchars($_POST['MOD_INS_ID_INSCRIPCION'],ENT_QUOTES,'UTF-8');
    $MOD_INS_ESTADO_ACREDITACION = htmlspecialchars($_POST['MOD_INS_ESTADO_ACREDITACION'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Modificar_Estado_Acreditacion($MOD_INS_ID_INSCRIPCION,$MOD_INS_ESTADO_ACREDITACION);
    echo $consulta;

?>