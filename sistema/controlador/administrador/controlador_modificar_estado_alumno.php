<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    $MOD_ALU_ID_ALUMNO = htmlspecialchars($_POST['MOD_ALU_ID_ALUMNO'],ENT_QUOTES,'UTF-8');
    $MOD_ALU_ESTADO = htmlspecialchars($_POST['MOD_ALU_ESTADO'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Modificar_Estado_Alumno($MOD_ALU_ID_ALUMNO,$MOD_ALU_ESTADO);
    echo $consulta;

?>