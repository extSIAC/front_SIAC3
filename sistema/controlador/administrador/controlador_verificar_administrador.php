<?php
    // Llama al modelo usuario
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
    //Inyección de datos
    $USUARIO_ADMINISTRADOR       = htmlspecialchars($_POST['DATO_ADM_USUARIO'],ENT_QUOTES,'UTF-8');
    $CONTRASENA_ADMINISTRADOR  = htmlspecialchars($_POST['DATO_ADM_CONTRASENA'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->VerificarAdministrador($USUARIO_ADMINISTRADOR,$CONTRASENA_ADMINISTRADOR);
    $data = json_encode($consulta);
    if(count($consulta)>0){
        echo $data;
    }else{
        echo 0;
    }

?>