<?php
    require '../../modelo/modelo_administrador.php';

    $MU = new Modelo_Administrador();
            $CON_CON_ID_USUARIO = htmlspecialchars($_POST['CON_CON_ID_USUARIO'],ENT_QUOTES,'UTF-8');
            $CON_CON_ACTUAL_BD  = htmlspecialchars($_POST['CON_CON_ACTUAL_BD'],ENT_QUOTES,'UTF-8');
            $CON_CON_ACTUAL     = htmlspecialchars($_POST['CON_CON_ACTUAL'],ENT_QUOTES,'UTF-8');
            $CON_CON_NUEVA      = password_hash   ($_POST['CON_CON_NUEVA'],PASSWORD_DEFAULT,['cost']);

    if(password_verify($CON_CON_ACTUAL,$CON_CON_ACTUAL_BD)){
    $consulta = $MU->ConfigurarContrasenaUsuarioAdministrador($CON_CON_ID_USUARIO,$CON_CON_NUEVA);
    echo $consulta;
    }else{

        echo $CON_CON_ACTUAL;
            echo 2;
        }
?>